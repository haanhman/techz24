<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 * @desc Phân quyền
 * @author anhmantk
 */
class ArchiveController extends BackendController
{

    public function init()
    {
        parent::init();
        $this->_table = 'tbl_archive';
    }


    private function getCategory()
    {
        $data = array();
        $query = "SELECT * FROM tbl_category";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data[$item['id']] = $item['name'];
        }
        return $data;
    }

    //put your code here
    public function actionIndex()
    {
        $data = array();
        $where = "";
        $query_count = "SELECT COUNT(id) FROM " . $this->_table . " WHERE 1 " . $where;

        $item_count = $this->db->createCommand($query_count)->queryScalar();

        $pages = new CPagination($item_count);
        $perPage = 10;
        $pages->setPageSize($perPage);

        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
        if ($page <= 0) {
            $page = 1;
        }

        $offset = ($page - 1) * $perPage;

        $query = "SELECT id, cate_id, short_text, title, thumbnail FROM " . $this->_table . " WHERE 1 " . $where . " "
            . "LIMIT " . $offset . "," . $perPage;
        $data['listItem'] = $this->db->createCommand($query)->queryAll();


        $data['category'] = $this->getCategory();

        $this->render('index', array(
            'data' => $data,
            'item_count' => $item_count,
            'page_size' => $perPage,
            'pages' => $pages,
        ));
    }


}
