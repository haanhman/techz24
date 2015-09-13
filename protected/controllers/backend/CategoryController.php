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
        $query = "SELECT * FROM {{" . $this->_table . "}} ORDER BY id DESC";
        $data['listItem'] = $this->db->createCommand($query)->queryAll();


        $query = "SELECT cate_id, COUNT(id) AS total FROM tbl_archive GROUP BY cate_id";
        $result = $this->db_crawler->createCommand($query)->queryAll();

        foreach($result as $item) {
            $data['static'][$item['cate_id']] = $item['total'];
        }

        $query = "SELECT cate_id, COUNT(id) AS total FROM tbl_archive WHERE is_use = 1 GROUP BY cate_id";
        $result = $this->db_crawler->createCommand($query)->queryAll();

        foreach($result as $item) {
            $data['use'][$item['cate_id']] = $item['total'];
        }



        $this->render('index', array('data' => $data));
    }

    public function actionAdd()
    {
        $data = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //`parent_id`, `name`, `alias`, `meta_keywords`, `meta_description`, `meta_title`, `status`
            $params = array(
                'parent_id' => formPostParams('parent_id',VARIABLE_NUMBER),
                'name' => formPostParams('name'),
                'alias' => change_url_seo(formPostParams('name')),
                'meta_keywords' => formPostParams('meta_keywords'),
                'meta_description' => formPostParams('meta_description'),
                'meta_title' => formPostParams('meta_title'),
                'status' => formPostParams('status',VARIABLE_NUMBER),
            );
            yii_insert_row($this->_table, $params);
            createMessage('Thêm mới danh mục thành công');
            $this->redirect($this->createUrl('index'));
        }
        $this->render('add', array('data' => $data));
    }

    public function actionEdit()
    {
        $data = array();
        $rule_id = urlGETParams('id', VARIABLE_NUMBER);
        $record = $this->getRow($rule_id);
        if (empty($record)) {
            createMessage('Nội dung bạn yêu cầu không tồn tại');
            $this->redirect($this->createUrl('index'));
        }


        $form = new RuleForm('edit');
        $form->id = $record['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $form->attributes = $_POST['RuleForm'];
            if ($form->validate()) {
                $values = array('rule' => trim($form->rule));
                yii_update_row($this->_table, $values, 'id = ' . $rule_id);
                createMessage('Cập nhật nhóm người dùng thành công');
                $this->redirect($this->createUrl('index'));
            }
        } else {
            $form->attributes = $record;
            $form->id = $record['id'];
        }
        $data['form'] = $form;
        $this->render('add', array('data' => $data));
    }

}
