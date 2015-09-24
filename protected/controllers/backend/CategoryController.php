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
class CategoryController extends BackendController
{

    public function init()
    {
        $this->_table = 'category';
        parent::init();
    }

    //put your code here
    public function actionIndex()
    {
        $data = array();
        $query = "SELECT * FROM {{" . $this->_table . "}} ORDER BY weight";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            if ($item['parent_id'] == 0) {
                foreach ($result as $sub) {
                    if ($sub['parent_id'] == $item['id']) {
                        $item['sub'][] = $sub;
                    }
                }
                $data['listItem'][] = $item;
            }
        }

        $query = "SELECT cate_id, COUNT(id) AS total FROM tbl_archive GROUP BY cate_id";
        $result = $this->db->createCommand($query)->queryAll();

        foreach ($result as $item) {
            $data['static'][$item['cate_id']] = $item['total'];
        }

        $this->render('index', array('data' => $data));
    }

    public function actionAdd()
    {
        $data = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //`parent_id`, `name`, `alias`, `meta_keywords`, `meta_description`, `meta_title`, `status`
            $params = array(
                'parent_id' => formPostParams('parent_id', VARIABLE_NUMBER),
                'name' => formPostParams('name'),
                'alias' => change_url_seo(formPostParams('name')),
                'meta_keywords' => formPostParams('meta_keywords'),
                'meta_description' => formPostParams('meta_description'),
                'meta_title' => formPostParams('meta_title'),
                'status' => formPostParams('status', VARIABLE_NUMBER),
                'is_feature' => formPostParams('is_feature', VARIABLE_NUMBER),
                'weight' => formPostParams('weight', VARIABLE_NUMBER),
                'cnet_url' => formPostParams('cnet_url'),
                'techcrunch_url' => formPostParams('techcrunch_url'),
                'wpcentral_url' => formPostParams('wpcentral_url'),
            );
            yii_insert_row($this->_table, $params);
            createMessage('Thêm mới danh mục thành công');
            $this->redirect($this->createUrl('index'));
        }

        $query = "SELECT id, name FROM tbl_category WHERE parent_id = 0";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data['category'][$item['id']] = $item['name'];
        }

        $this->render('add', array('data' => $data));
    }

    public function actionEdit()
    {
        $data = array();
        $id = urlGETParams('id', VARIABLE_NUMBER);
        $query = "SELECT * FROM tbl_category WHERE id = " . $id;
        $row = $this->db->createCommand($query)->queryRow();
        if (empty($row)) {
            $this->redirect($this->createUrl('index'));
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //`parent_id`, `name`, `alias`, `meta_keywords`, `meta_description`, `meta_title`, `status`
            $params = array(
                'parent_id' => formPostParams('parent_id', VARIABLE_NUMBER),
                'name' => formPostParams('name'),
                'alias' => change_url_seo(formPostParams('name')),
                'meta_keywords' => formPostParams('meta_keywords'),
                'meta_description' => formPostParams('meta_description'),
                'meta_title' => formPostParams('meta_title'),
                'status' => formPostParams('status', VARIABLE_NUMBER),
                'is_feature' => formPostParams('is_feature', VARIABLE_NUMBER),
                'weight' => formPostParams('weight', VARIABLE_NUMBER),
                'cnet_url' => formPostParams('cnet_url'),
                'techcrunch_url' => formPostParams('techcrunch_url'),
                'wpcentral_url' => formPostParams('wpcentral_url'),
            );
            yii_update_row($this->_table, $params, 'id = ' . $id);
            createMessage('Sửa danh mục thành công');
            $this->redirect($this->createUrl('index'));
        }


        $query = "SELECT id, name FROM tbl_category WHERE parent_id = 0";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data['category'][$item['id']] = $item['name'];
        }
        $data['row'] = $row;
        $this->render('add', array('data' => $data));
    }

}
