<?php

class AndroidcentralController extends CrawlerController
{

    /**
     * http://www.androidcentral.com/content/visor-blog-view/recent?callback=abc&page=0 => n
     */
    public function init()
    {
        parent::init();
        $this->_source_id = 4;
        $this->_domain = 'http://www.androidcentral.com';
    }

    public function actionAll()
    {
        $query = "SELECT id FROM tbl_category WHERE android_center_url <> '' ORDER BY id";
        $result = $this->db->createCommand($query)->queryColumn();
        $index = isset($_GET['index']) ? intval($_GET['index']) : 0;
        if ($index >= count($result)) {
            die('xong roi');
        }
        $_GET['cate_id'] = $result[$index];
        $this->actionCategory();
        $index++;
        $url = $this->createAbsoluteUrl('all', array('index' => $index));
        echo '<meta http-equiv="refresh" content="0;URL='.$url.'" />';
    }


    function fectchDataFromUrl($url)
    {
        $ch = curl_init($url);

//    curl_setopt($ch, CURLOPT_PROXY, '84.253.120.4');
//    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);

        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:13.0) Gecko/20100101 Firefox/13.0.1');
        $response = curl_exec($ch);
        $response = str_replace('({"', '{"', $response);
        $response = str_replace('"});', '"}', $response);
        $response = json_decode($response, true);
        return $response['markup'];
    }

    public function actionCategory()
    {

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($page < 0) {
            $page = 0;
        }
        $cate_id = urlGETParams('cate_id', VARIABLE_NUMBER);
        $query = "SELECT * FROM tbl_category WHERE id = " . $cate_id;
        $category = $this->db->createCommand($query)->queryRow();


        $category_url = $category['android_center_url'];

        $category_url .= $page;
//        echo $category_url . '<br />';

        $response = $this->fectchDataFromUrl($category_url);
        if(empty($response)) {
            die('Error Khong lay duoc noi dung');
        }

//        $response = file_get_contents(ROOT_PATH. '/abc.txt');
//        $response = str_replace('({"', '{"', $response);
//        $response = str_replace('"});', '"}', $response);
//        $response = json_decode($response, true);


        $html = str_get_html($response);
        $items = $html->find('.grid_item');


        $data = array();
        foreach($items as $item) {
            $a = $item->find('.grid_title a', 0);
            $link_url = $this->_domain . trim($a->href);
            if(strpos($link_url, 'forums.androidcentral.com') !== false) {
                continue;
            }
            $dek = $item->find('.grid_summary', 0);
            if (!empty($dek)) {
                $str_desc = $dek->innertext();
                $str_desc = strip_tags($str_desc);
                $data[$link_url] = trim($str_desc);
            }
        }

        if (empty($data)) {
            echo 'Khong co du lieu vui long kiem tra lai';
            die;
        }

        $params = array();

        foreach ($data as $link_url => $dek) {
            $params[] = array(
                'cate_id' => $cate_id,
                'url' => $link_url,
                'md5url' => md5($link_url),
                'source_id' => $this->_source_id,
                'short_text' => $dek,
                'parent_id' => $category['parent_id']
            );
        }
        $params = array_reverse($params);
        yii_insert_multiple('link', $params, 'db_crawler');

        echo "<pre>" . print_r($params, true) . "</pre>";
    }


    public function actionDetail()
    {
        $query = "SELECT * FROM tbl_link WHERE source_id = " . $this->_source_id . " AND status = 0 ORDER BY id LIMIT 1";
        $row = $this->db_crawler->createCommand($query)->queryRow();
        if (empty($row)) {
            die('het roi');
        }
        echo "<pre>" . print_r($row, true) . "</pre>";
//        die;
        $url = $row['url'];
//        $url = 'http://techz24.vn/abc.html';

        $html = file_get_html($url);
        if(empty($html)) {
            echo 'Error';
            $this->crawlerSuccess($row, 2);
            die;
        }

        //div.article-main-body:first
        //.col-8:first

        //thumbnail
        $thumbnail = trim($html->find('meta[property="og:image"]', 0)->content);

        $content = $html->find('.article-body', 0);
        if(empty($content)) {
            echo 'Error';
            $this->crawlerSuccess($row, 2);
            die;
        }

        $list_images = array();
        //lay thong tin anh neu co
        $media = $content->find('.media-gallery', 0);
        if(!empty($media)) {
            $attr ='data-big';
            $imgs = $media->find('img');
            $list_images['title'] = '';
            foreach($imgs as $img) {
                $list_images['images'][] = $this->_domain .  trim($img->$attr);
            }
        }

        $remove_elements = array(
            'script',
            'noscript',
            '.media-gallery',
            '.devicebox',
            'style'
        );
        if(!empty($remove_elements)) {
            foreach ($content->find(implode(', ', $remove_elements)) as $item) {
                $item->outertext = '';
            }
        }

        $links = $content->find('a');
        foreach ($links as $item) {
            $href = trim($item->href);
            if (empty($href) | strpos($href, '#') === 0) {
                $item->outertext = '';
            } else {
                $inner_text = trim($item->innertext());
                $item->outertext = '<strong class="txt-bold">' . $inner_text . '</strong>';
            }
        }

        //lay danh sach tags
        $tags = array();

        $title = trim($html->find('title', 0)->innertext());

        //meta_keywords
        //meta itemprop="keywords"
        $meta_keywords = $html->find('meta[itemprop="keywords"]', 0);
        if (!empty($meta_keywords)) {
            $meta_keywords = trim($meta_keywords->content);
        }
        $meta_description = $html->find('meta[name="description"]', 0);
        if (!empty($meta_description)) {
            $meta_description = trim($meta_description->content);
        }

        $values = array(
            'parent_id' => $row['parent_id'],
            'cate_id' => $row['cate_id'],
            'title' => str_replace(' | Windows Central', '', $title),
            'thumbnail' => $thumbnail,
            'gallery' => json_encode($list_images),
            'tags' => json_encode($tags),
            'content' => $content->outertext,
            'source_id' => $this->_source_id,
            'source_url' => $url,
            'short_text' => $row['short_text'],
            'meta_keywords' => $meta_keywords,
            'meta_description' => $meta_description,
            'created' => time()
        );
        yii_insert_row('archive', $values, 'db_crawler');
        $this->crawlerSuccess($row);
    }
}
