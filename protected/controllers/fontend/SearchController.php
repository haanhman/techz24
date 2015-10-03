<?php

class SearchController extends FontendController
{
    public function actionIndex()
    {
        $data = array();
        $keyword = urlGETParams('keyword');



        $where = " AND title LIKE '%" . addslashes($keyword) . "%' ";
        $query_count = "SELECT COUNT(id) FROM tbl_archive WHERE 1 " . $where;
        $item_count = $this->db->createCommand($query_count)->queryScalar();

        $pages = new CPagination($item_count);
        $perPage = 20;
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

        $data['category'] = $this->getListCategory();

        $title = $keyword . ' search results';
        if($page > 1) {
            $title .= ' - page ' . $page;
        }

        $this->_meta = array(
            'title' => $title . ' - Techz24'
        );
        $this->_style_class = 'page right-sidebar singular fade-imgs-in-appear one-side-wide both-sidebars archive-page';
        $this->render('index', array(
            'data' => $data,
            'item_count' => $item_count,
            'page_size' => $perPage,
            'pages' => $pages,
        ));
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


    public function actionVideo()
    {
        $data = array();
        $keyword = urlGETParams('keyword');



        $where = " AND title LIKE '%" . addslashes($keyword) . "%' ";
        $query_count = "SELECT COUNT(id) FROM tbl_youtube WHERE 1 " . $where;
        $item_count = $this->db->createCommand($query_count)->queryScalar();

        $pages = new CPagination($item_count);
        $perPage = 30;
        $pages->setPageSize($perPage);

        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
        if ($page <= 0) {
            $page = 1;
        }

        $offset = ($page - 1) * $perPage;

        $query = "SELECT * FROM tbl_youtube WHERE 1 " . $where . " "
            . " ORDER BY created DESC "
            . "LIMIT " . $offset . "," . $perPage;
        $data['listVideo'] = $this->db->createCommand($query)->queryAll();

        $tags = array();
        if (!empty($data['listVideo'])) {
            foreach ($data['listVideo'] as $item) {
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

        $title = $keyword . ' search results';
        if($page > 1) {
            $title .= ' - page ' . $page;
        }

        $this->_meta = array(
            'title' => $title . ' - Techz24'
        );
        $this->_style_class = 'page right-sidebar singular fade-imgs-in-appear one-side-wide both-sidebars archive-page';
        $this->render('video', array(
            'data' => $data,
            'item_count' => $item_count,
            'page_size' => $perPage,
            'pages' => $pages,
        ));
    }

}
