<?php

class IndexController extends FontendController
{
    public function actionIndex()
    {
        $data = array();
        $categories = $this->getListCategory();
        $category_feature = array();
        foreach ($categories as $item) {
            if ($item['is_feature'] == 1) {
                $category_feature[] = $item['id'];
            }
        }
        $data['category'] = $this->getListCategory();
        $data['catslide'] = $this->getCategoryFeatureContent($category_feature);
        $data['catebox'] = $this->getCategoryContentBox($category_feature);
        $data['newpost'] = $this->getNewPostNormal($category_feature);
        $tags = array();
        if(!empty($data['newpost'])) {
            foreach($data['newpost'] as $item) {
                $arr = explode(',', trim($item['tags'], ','));
                if(!empty($arr)) {
                    foreach ($arr as $t) {
                        $tags[] =$t;
                    }
                }
            }
            $tags = array_unique($tags);
            $data['tags'] = $this->getListTags($tags);
        }

        //lay danh sach tag noi bat
        $query = "SELECT name FROM tbl_tags WHERE is_feature = 1";
        $tags = $this->db->createCommand($query)->queryColumn();

        $this->_meta = array(
            'title' => 'Product reviews and prices, and tech news - Techz24',
            'description' => 'Techz24 is the world\'s leader in tech product reviews, news, prices, videos, forums, how to\'s and more.',
            'keywords' => implode(', ', $tags)
        );


        //danh sach feature video
        $query = "SELECT * FROM tbl_youtube WHERE is_feature = 1 ORDER BY created DESC LIMIT 10";
        $data['featureVideo'] = $this->db->createCommand($query)->queryAll();

        //danh sach tag video

        $data['video_tags'] = array(
            array(
                'alias' => 'ios',
                'name' => 'iOS'
            ),
            array(
                'alias' => 'iphone',
                'name' => 'iPhone'
            ),
            array(
                'alias' => 'apple',
                'name' => 'Apple'
            ),
            array(
                'alias' => 'android',
                'name' => 'Android'
            ),
            array(
                'alias' => 'google',
                'name' => 'Google'
            )
        );

        $this->render('index', array('data' => $data));
    }

    private function staticCategory() {
        $data = array();
        $query = "SELECT cate_id, COUNT(id) AS total FROM tbl_archive GROUP BY cate_id";
        $result = $this->db->createCommand($query)->queryAll();
        foreach($result as $item) {
            $data[$item['cate_id']] = $item['total'];
        }
        return $data;
    }

    private function getNewPostNormal($category_feature) {
        $data = array();
        $category_feature[] = 20;
        $query = "SELECT id, cate_id, title, alias, thumbnail,short_text,created,tags FROM tbl_archive WHERE cate_id NOT IN (". implode(',', $category_feature) .") ORDER BY id DESC LIMIT 10";
        $result = $this->db->createCommand($query)->queryAll();
        foreach($result as $item) {
            $data[] = $item;
        }
        return $data;
    }

    private function getCategoryContentBox($category_feature)
    {
        $querys = $data = array();
        $category_feature[] = 11;
        foreach ($category_feature as $cate_id) {
            $querys[] = "(SELECT id, cate_id, title, alias, thumbnail,short_text FROM tbl_archive WHERE cate_id = " . $cate_id . " ORDER BY id DESC LIMIT 4)";
        }

        $query = implode(' UNION ', $querys);
        $result = $this->db->createCommand($query)->queryAll();
        foreach($result as $item) {
            $data[$item['cate_id']][] = $item;
        }
        return $data;
    }

    private function getCategoryFeatureContent($category_feature)
    {
        $querys = $data = array();

        foreach ($category_feature as $cate_id) {
            $querys[] = "(SELECT id, cate_id, title, alias, thumbnail FROM tbl_archive WHERE cate_id = " . $cate_id . " ORDER BY id DESC LIMIT 8)";
        }

        $query = implode(' UNION ', $querys);
        $result = $this->db->createCommand($query)->queryAll();
        foreach($result as $item) {
            $data[$item['cate_id']][] = $item;
        }
        return $data;
    }

}
