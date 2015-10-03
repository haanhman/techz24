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

        $this->getCategoryFeatureContent($category_feature, $data);
        $data['catebox'] = $this->getCategoryContentBox($category_feature);

        $data['social']['category'] = $data['category'][18];
        $data['social']['post'] = $this->getListPost(18);

        $data['game']['category'] = $data['category'][19];
        $data['game']['post'] = $this->getListPost(19);



        $data['recent_post'] = $this->getNewPostNormal($category_feature);
        $tags = array();
        if (!empty($data['newpost'])) {
            foreach ($data['newpost'] as $item) {
                $arr = explode(',', trim($item['tags'], ','));
                if (!empty($arr)) {
                    foreach ($arr as $t) {
                        $tags[] = $t;
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
        $query = "SELECT alias, name FROM tbl_tags_youtube WHERE is_feature = 1 ORDER BY total_video DESC LIMIT 5";
        $data['video_tags'] = $this->db->createCommand($query)->queryAll();

        $this->_style_class = 'home-page page-template-default fullwidth time_in_twelve_format both-sidebars fade-imgs-in-appear time_in_twelve_format  both-sidebars both-sides-true';
        $this->render('index', array('data' => $data));
    }

    private function getListPost($cate_id, $limit = 4) {
        $query = "SELECT id, cate_id, title, alias, thumbnail,short_text FROM tbl_archive WHERE cate_id = " . $cate_id . " ORDER BY id DESC LIMIT " . $limit;
        return $this->db->createCommand($query)->queryAll();
    }

    private function staticCategory()
    {
        $data = array();
        $query = "SELECT cate_id, COUNT(id) AS total FROM tbl_archive GROUP BY cate_id";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data[$item['cate_id']] = $item['total'];
        }
        return $data;
    }

    private function getNewPostNormal($category_feature)
    {
        $data = array();
        $category_feature[] = 20;
        $query = "SELECT id, cate_id, title, alias, thumbnail,short_text,created,tags FROM tbl_archive WHERE cate_id NOT IN (" . implode(',', $category_feature) . ") ORDER BY id DESC LIMIT 10";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data[] = $item;
        }
        return $data;
    }

    private function getCategoryContentBox($category_feature)
    {
        $querys = $data = array();
        $category_feature[] = 11;
        foreach ($category_feature as $cate_id) {
            $querys[] = "(SELECT id, cate_id, title, alias, thumbnail,short_text FROM tbl_archive WHERE cate_id = " . $cate_id . " ORDER BY id DESC LIMIT 5)";
        }

        $query = implode(' UNION ', $querys);
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data[$item['cate_id']][] = $item;
        }
        return $data;
    }

    private function getCategoryFeatureContent($category_feature, &$data)
    {
        $querys = array();

        foreach ($category_feature as $cate_id) {
            $querys[] = "(SELECT id, cate_id, title, alias, thumbnail,short_text FROM tbl_archive WHERE cate_id = " . $cate_id . " ORDER BY id DESC LIMIT 6)";
        }

        $query = implode(' UNION ', $querys);
        $result = $this->db->createCommand($query)->queryAll();
        $lists = array();
        foreach ($result as $item) {
            $lists[$item['cate_id']][] = $item;
        }

        foreach ($lists as $rows) {
            $parts = array_chunk($rows, 3);
            foreach ($parts[0] as $item) {
                $data['catslide'][] = $item;
            }
            foreach ($parts[1] as $item) {
                $data['slide2'][] = $item;
            }
        }
    }

}
