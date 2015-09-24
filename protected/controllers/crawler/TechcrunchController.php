<?php

class TechcrunchController extends CrawlerController
{


    public function init()
    {
        parent::init();
        $this->_source_id = 2;
        $this->_domain = 'http://techcrunch.com/';
    }


    public function actionAll()
    {
        $query = "SELECT id FROM tbl_category WHERE techcrunch_url <> '' ORDER BY id";
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

    public function actionCategory()
    {

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($page < 1) {
            $page = 1;
        }
        $cate_id = urlGETParams('cate_id', VARIABLE_NUMBER);
        $query = "SELECT * FROM tbl_category WHERE id = " . $cate_id;
        $category = $this->db->createCommand($query)->queryRow();


        $category_url = $category['techcrunch_url'];


        if ($page > 1) {
            $category_url .= 'page/' . $page . '/';
            //http://techcrunch.com/mobile/page/5/
        }

        echo "<pre>" . print_r($_GET, true) . "</pre>";
        echo $category_url . '<br />';

        $html = file_get_html($category_url);
        $contents = $html->find('.block-content');
        $data = array();
        foreach($contents as $item) {
            $a = $item->find('.post-title a', 0);
            $excerpt = $item->find('.excerpt', 0);
            $excerpt->find('a', 0)->outertext = '';
            $link_url = trim($a->href);
            $data[$link_url] = trim($excerpt->innertext());
        }

        if (empty($data)) {
            echo 'Khong co du lieu vui long kiem tra lai';
        }


        $params = array();
        $remove_link = array(
//            'pictures'
        );

        foreach ($data as $link_url => $dek) {
            $break = false;
            foreach ($remove_link as $prefix) {
                if (strpos($link_url, $prefix) !== false) {
                    $break = true;
                    unset($data[$link_url]);
                    break;
                }
            }
            if ($break) {
                continue;
            }
            $params[] = array(
                'cate_id' => $cate_id,
                'url' => $link_url,
                'md5url' => md5($link_url),
                'source_id' => $this->_source_id,
                'short_text' => $dek,
                'parent_id' => $category['parent_id']
            );
            echo $link_url . '<br />';
        }
        $params = array_reverse($params);
        yii_insert_multiple('link', $params, 'db_crawler');



//        echo "<pre>" . print_r($params, true) . "</pre>";
    }


    public function actionDetail()
    {
        $query = "SELECT * FROM tbl_link WHERE source_id = " . $this->_source_id . " AND status = 0 ORDER BY id LIMIT 1";
        $row = $this->db_crawler->createCommand($query)->queryRow();
        if (empty($row)) {
            die('het roi');
        }

        $url = $row['url'];
        $html = file_get_html($url);
        //div.article-main-body:first
        //.col-8:first

        //thumbnail
        $thumbnail = trim($html->find('meta[property="og:image"]', 0)->content);

        //lay thong tin gallery
        $gallery = array();
        $html_gallery = $html->find('.slideshowify', 0);
        if(!empty($html_gallery)) {
            $imgs = $html_gallery->find('img');
            foreach($imgs as $img) {
                $attr = 'data-full-size-image';
                $gallery['images'][] = trim($img->$attr);
            }
        }

        //content
        $content = $html->find('div.article-entry', 0);
        if(empty($content)) {
            echo '<h1>Error</h1>';
            $this->crawlerSuccess($row, 2);
            die;
        }
        $remove_elements = array(
            '.byline',
            '.inset-ad',
            '.inset-sm',
            '.social-share',
            '.slideshowify',
            '.aside-related-articles',
            '.native-ad-mobile',
            'script',
            'small'
        );

        foreach ($content->find(implode(', ', $remove_elements)) as $item) {
            $item->outertext = '';
        }
        //cancel link in content
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
        $html_tags = $html->find('div.accordion a');
        if (!empty($html_tags)) {
            foreach ($html_tags as $item) {
                $tags[] = trim($item->innertext());
            }
        } else {
            $html_tags = $html->find('.article-header .tag-item');
            if(!empty($html_tags)) {
                foreach ($html_tags as $item) {
                    $obj = $item->find('a', 0);
                    $tags[] = trim($obj->innertext());
                }
            }
        }
        $title = trim($html->find('title', 0)->innertext());
        $parent = "/\s+/ims";
        $title = preg_replace($parent, ' ', $title);

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
        $content = str_replace('<!-- Begin: Wordpress Article Content -->', '', $content->outertext);
        $content = str_replace('<!-- End: Wordpress Article Content -->', '', $content);

        $values = array(
            'parent_id' => $row['parent_id'],
            'cate_id' => $row['cate_id'],
            'title' => str_replace(' | TechCrunch', '', $title),
            'thumbnail' => $thumbnail,
            'tags' => json_encode($tags),
            'content' => $content,
            'source_id' => $this->_source_id,
            'source_url' => $url,
            'short_text' => $row['short_text'],
            'meta_keywords' => $meta_keywords,
            'meta_description' => $meta_description,
            'gallery' => json_encode($gallery),
            'created' => time()
        );
        echo "<pre>" . print_r($row, true) . "</pre>";
        yii_insert_row('archive', $values, 'db_crawler');
        $this->crawlerSuccess($row);
    }


}
