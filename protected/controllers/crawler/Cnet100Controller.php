<?php

class Cnet100Controller extends CrawlerController
{


    public function init()
    {
        parent::init();
        $this->_source_id = 1;
        $this->_domain = 'http://www.cnet.com';
    }

    public function actionCategory()
    {
        $cate_id = urlGETParams('cate_id', VARIABLE_NUMBER);
        $query = "SELECT * FROM tbl_category WHERE id = " . $cate_id;
        $category = $this->db->createCommand($query)->queryRow();


        $category_url = $category['cnet_url'];


        echo "<pre>" . print_r($category, true) . "</pre>";
        echo $category_url . '<br />';
        $response = fectchContent($category_url);
        $html = str_get_html($response);
        $data = array();
        for ($i = 1; $i <= 100; $i++) {
            $item = $html->find('div[section="prod' . $i . '"]', 0);
            if (!empty($item)) {
                $a = $item->find('a', 0);
                $link_url = $this->_domain . trim($a->href);
                $dek = $item->find('.dek', 0);
                if (!empty($dek)) {
                    $data[$link_url] = trim($dek->innertext());
                }
            }
        }


        if (empty($data)) {
            echo 'Khong co du lieu vui long kiem tra lai';
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
        $url = $row['url'];

        $response = fectchContent($url);
        $html = str_get_html($response);

        $title = trim($html->find('title', 0)->innertext());
        $title = str_replace(' - CNET', '', $title);

        $thumbnail = trim($html->find('meta[property="og:image"]', 0)->content);

        $meta_keywords = $html->find('meta[itemprop="keywords"]', 0);
        if (!empty($meta_keywords)) {
            $meta_keywords = trim($meta_keywords->content);
        }
        $meta_description = $html->find('meta[name="description"]', 0);
        if (!empty($meta_description)) {
            $meta_description = trim($meta_description->content);
        }

        //page 1
        $content1 = $html->find('#editorReview', 0);
        $this->processContent($title, $content1);


        //page 2
        $url .= '2/';
        $html = file_get_html($url);
        $content2 = $html->find('#editorReview', 0);
        $this->processContent($title, $content2);

        $content = $content1 . $content2;

        $tags = array();
        $list_images = array();

        $values = array(
            'parent_id' => $row['parent_id'],
            'cate_id' => $row['cate_id'],
            'title' => str_replace(' - CNET', '', $title),
            'thumbnail' => $thumbnail,
            'gallery' => json_encode($list_images),
            'tags' => json_encode($tags),
            'content' => $content,
            'source_id' => $this->_source_id,
            'source_url' => $row['url'],
            'short_text' => $row['short_text'],
            'meta_keywords' => $meta_keywords,
            'meta_description' => $meta_description,
            'created' => time()
        );
        yii_insert_row('archive', $values, 'db_crawler');
        $this->crawlerSuccess($row);
    }

    private function processContent($title, &$content)
    {
        $images = $content->find('figure.image');
        foreach ($images as $item) {
            $img = $item->find('img', 0);
            $item->outertext = $img;
        }

        $imgs = $content->find('img');
        if (!empty($imgs)) {
            $attr = 'data-original';
            foreach ($imgs as $item) {
                $src = trim($item->src);
                if (empty($src)) {
                    $item->src = trim($item->$attr);
                    $item->$attr = '';
                }
                $item->alt = CHtml::encode($title);

                $src = trim($item->src);
                if(strpos($src, '/') === 0) {
                    $item->src = $this->_domain . $src;
                }

            }
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
            '.ad-replay-wide-top',
            'script'
        );

        foreach ($content->find(implode(', ', $remove_elements)) as $item) {
            $item->outertext = '';
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
        $content = $content->innertext();
    }

}
