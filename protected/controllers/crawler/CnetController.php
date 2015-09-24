<?php

class CnetController extends CrawlerController
{


    public function init()
    {
        parent::init();
        $this->_source_id = 1;
        $this->_domain = 'http://www.cnet.com';
    }

    public function actionAll()
    {
        $query = "SELECT id FROM tbl_category WHERE cnet_url <> '' ORDER BY id";
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
//        $cate_id = 1;
//        $category_url = 'http://www.cnet.com/apple/';
//        $cate_id = 2;
//        $category_url = 'http://www.cnet.com/tags/google/';
//        $cate_id = 3;
//        $category_url = 'http://www.cnet.com/tags/microsoft/';
        $cate_id = urlGETParams('cate_id', VARIABLE_NUMBER);
        $query = "SELECT * FROM tbl_category WHERE id = " . $cate_id;
        $category = $this->db->createCommand($query)->queryRow();


        $category_url = $category['cnet_url'];


        if ($page > 1) {
            $category_url .= $page;
        }
        echo "<pre>" . print_r($_GET, true) . "</pre>";
        echo $category_url . '<br />';
        $html = file_get_html($category_url);
        $content = $html->find('.col-8', 0);


        $remove_elements = array(
            '.latestGalleries',
            '.curated-hero'
        );

        foreach ($content->find(implode(', ', $remove_elements)) as $item) {
            $item->outertext = '';
        }

        $data = array();
        $assets = $content->find('.asset');
        foreach ($assets as $item) {
            $a = $item->find('.assetThumb a', 0);
            $link_url = $this->_domain . trim($a->href);
            $dek = $item->find('p.dek', 0);
            if (!empty($dek)) {
                $data[$link_url] = trim($dek->innertext());
            }
        }


        if (empty($data)) {
            echo 'Khong co du lieu vui long kiem tra lai';
        }


        $params = array();
        $remove_link = array(
            'products',
            'videos',
            'pictures'
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

        $url = $row['url'];
        $html = file_get_html($url);
        //div.article-main-body:first
        //.col-8:first

        //thumbnail
        $thumbnail = trim($html->find('meta[property="og:image"]', 0)->content);

        $content_wapper = $html->find('div.article-main-body', 0);
        $content = $content_wapper->find('.col-8', 0);

        $gallery = $content->find('div.gallery', 0);
        $list_images = array();
        if (!empty($gallery)) {
            $gallery_href = trim($gallery->find('.imageLinkWrapper', 0)->href);
            $list_images = $this->getImages($gallery_href);
        }

        $remove_elements = array(
            '.ad-mpu-plus-top',
            '.ad-mpu-bottom',
            '.gallery',
            '.related-links',
            '.ad-inpage-video-top',
            '.cnetVideoPlayer',
            '.enlargeImage',
            'noscript',
            '.ad-replay-wide-top'
        );

        foreach ($content->find(implode(', ', $remove_elements)) as $item) {
            $item->outertext = '';
        }

        $attr = 'data-original';
        $imgs = $content->find('.originalImage img, .imageContainer img');
        if (!empty($imgs)) {
            foreach ($imgs as $item) {
                $src = trim($item->src);
                if (empty($src)) {
                    $item->src = trim($item->$attr);
                    $item->$attr = '';
                }
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
        $html_tags = $html->find('div.collections-topics-and-tags a');
        if (!empty($html_tags)) {
            foreach ($html_tags as $item) {
                $tags[] = trim($item->innertext());
            }
        }

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
            'title' => str_replace(' - CNET', '', $title),
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


    private function getImages($gallery_href)
    {
        $data = array();
        $html = file_get_html($this->_domain . '/' . $gallery_href);
        $images = $html->find('ul.images img');
        if (empty($images)) {
            return;
        }
        $list_images = array();
        foreach ($images as $img) {
            $src = trim($img->src);
            if (strpos($src, 'data:image') === 0) {
                $attr = 'data-src';
                $src = trim($img->$attr);
            }
            $list_images[] = $src;
        }
        $data['images'] = $list_images;

        //ten album
        $title = trim($html->find('title', 0)->innertext());
        $title = str_replace(' - CNET', '', $title);
        $data['title'] = trim($title);
        return $data;
    }
}
