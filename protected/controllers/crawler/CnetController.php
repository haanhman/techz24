<?php

class CnetController extends CrawlerController
{


    public function init()
    {
        parent::init();
        $this->_source_id = 1;
        $this->_domain = 'http://www.cnet.com';
    }


    public function actionCategory()
    {

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if($page < 1) {
            $page = 1;
        }
//        $cate_id = 1;
//        $category_url = 'http://www.cnet.com/apple';
//        $cate_id = 2;
//        $category_url = 'http://www.cnet.com/tags/google/';
        $cate_id = 3;
        $category_url = 'http://www.cnet.com/tags/microsoft/';
        if ($page > 1) {
            $category_url .= $page;
        }

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
        $links = $content->find('.assetThumb a');
        foreach ($links as $item) {
            $data[] = $this->_domain . trim($item->href);
        }

        if (empty($data)) {
            echo 'Khong co du lieu vui long kiem tra lai';
        }

        $data = array_unique($data);
        $params = array();
        $remove_link = array(
            'products',
            'videos',
            'pictures'
        );

        foreach ($data as $index => $item) {
            $break = false;
            foreach($remove_link as $prefix) {
                if(strpos($item, $prefix) !== false) {
                    $break = true;
                    unset($data[$index]);
                    break;
                }
            }
            if($break) {
                continue;
            }
            $params[] = array(
                'cate_id' => $cate_id,
                'url' => $item,
                'md5url' => md5($item),
                'source_id' => $this->_source_id
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
        if(empty($row)) {
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
            'noscript'
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

        //`title`, `content`, `tags`, `gallery`, `source_id`, `source_url`
        $values = array(
            'cate_id' => $row['cate_id'],
            'title' => $title,
            'thumbnail' => $thumbnail,
            'gallery' => json_encode($list_images),
            'tags' => json_encode($tags),
            'content' => $content->outertext,
            'source_id' => $this->_source_id,
            'source_url' => $url
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
