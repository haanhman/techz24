<?php

class CategoryController extends FontendController
{
    public function actionIndex()
    {
        $data = array();
        $alias = urlGETParams('alias');
        $categories = $this->getListCategory();
        $category_feature = array();
        $cate = array();

        foreach ($categories as $item) {
            if ($item['alias'] == $alias) {
                $cate = $item;
                break;
            }
        }

        if(empty($cate)) {
            $this->redirect($this->createUrl('index/index'));
        }
        $cate_id = $cate['id'];
        $data['cur_cate'] = $cate;
        $data['category'] = $categories;



        $where = " AND cate_id = " . $cate_id;
        $query_count = "SELECT COUNT(id) FROM tbl_archive WHERE 1 " . $where;
        $item_count = $this->db->createCommand($query_count)->queryScalar();

        $pages = new CPagination($item_count);
        $perPage = 20;
        if($cate_id == 20) {
            $perPage = 100;
        }
        $pages->setPageSize($perPage);

        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
        if ($page <= 0) {
            $page = 1;
        }
        $offset = ($page - 1) * $perPage;


        $query = "SELECT id, cate_id, title, alias, thumbnail,short_text,created,tags FROM tbl_archive WHERE 1 " . $where . " "
            . " ORDER BY id DESC "
            . "LIMIT " . $offset . "," . $perPage;

        $data['newpost'] = $this->db->createCommand($query)->queryAll();

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
        $title = $cate['meta_title'];
        if($page > 1) {
            $title .= ' - page ' . $page;
        }
        $this->_meta = array(
            'title' => $title . ' | Techz24',
            'description' => $cate['meta_description'],
            'keywords' => $cate['meta_keywords']
        );
//        echo "<pre>" . print_r($data, true) . "</pre>";
//        die;
        if($cate_id == 20) {
            $this->_style_class = 'page right-sidebar singular fade-imgs-in-appear one-side-wide both-sidebars review-page';
            $this->render('review', array('data' => $data));
            return;
        }

        $this->_style_class = 'page right-sidebar singular fade-imgs-in-appear one-side-wide both-sidebars archive-page';
        $this->render('index', array(
            'data' => $data,
            'item_count' => $item_count,
            'page_size' => $perPage,
            'pages' => $pages,
        ));
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
}
