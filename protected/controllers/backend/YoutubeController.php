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
class YoutubeController extends BackendController
{

    public function init()
    {
        parent::init();
    }


    //put your code here
    public function actionIndex()
    {
        $data = array();
        $where = "";
        $query_count = "SELECT COUNT(id) FROM tbl_youtube WHERE 1 " . $where;
        $item_count = $this->db->createCommand($query_count)->queryScalar();

        $pages = new CPagination($item_count);
        $perPage = 10;
        $pages->setPageSize($perPage);

        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
        if ($page <= 0) {
            $page = 1;
        }

        $offset = ($page - 1) * $perPage;
        $order = 'id';
        if (isset($_GET['order'])) {
            $order = 'created';
        }

        $query = "SELECT * FROM tbl_youtube WHERE 1 " . $where . " "
            . " ORDER BY " . $order . " DESC "
            . "LIMIT " . $offset . "," . $perPage;
        $data['listItem'] = $this->db->createCommand($query)->queryAll();

        $this->render('index', array(
            'data' => $data,
            'item_count' => $item_count,
            'page_size' => $perPage,
            'pages' => $pages,
        ));
    }


    public function actionDetail()
    {
        $data = array();
        $id = urlGETParams('id', VARIABLE_NUMBER);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $params = $_POST;
            yii_update_row('youtube', $params, 'id = ' . $id);
            createMessage('Cập nhật thành công');
            $this->redirect($this->createUrl('detail', array('id' => $id)));
        }

        $query = "SELECT * FROM tbl_youtube WHERE id = " . $id;
        $data = $this->db->createCommand($query)->queryRow();
        $this->render('detail', array('data' => $data));
    }


}
