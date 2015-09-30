<?php

class FontendController extends CController
{

    /**
     * meta tag
     * @var
     */
    protected $_meta;
    protected $_table;

    /**
     *
     * @var CDbConnection
     */
    protected $db;
    private $_list_category;

    public function init()
    {
        parent::init();

//        if ($_SERVER['HTTP_HOST'] == 'techz24.com' || $_SERVER['HTTP_HOST'] == 'www.techz24.com') {
//            $user = Yii::app()->session['user'];
//            $ip = ip_address();
//            if (empty($user) && $ip != '118.71.87.162') {
//                echo '<meta name="robots" content="noindex, nofollow">';
//                die('Comming soon...');
//            }
//        }

        $this->db = EduDataBase::getConnection();
    }

    public function getSource()
    {
        return getNewsSource();
    }

    public function getListCategory()
    {
        if (!empty($this->_list_category)) {
            return $this->_list_category;
        }
        $data = array();
        $query = "SELECT * FROM tbl_category ORDER BY weight";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data[$item['id']] = $item;
        }
        $this->_list_category = $data;
        return $this->_list_category;
    }

    protected function getListTags($list_tags_id)
    {
        $data = array();
        if (empty($list_tags_id)) {
            return $data;
        }
        $list_tags_id = array_unique(array_filter($list_tags_id));
        if(empty($list_tags_id)) {
            return $data;
        }
        $query = "SELECT id, name, alias FROM tbl_tags WHERE id IN (" . implode(',', $list_tags_id) . ")";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data[$item['id']] = $item;
        }
        return $data;
    }

    protected function getListVideoTags($list_tags_id)
    {
        $data = array();
        if (empty($list_tags_id)) {
            return $data;
        }
        $list_tags_id = array_unique(array_filter($list_tags_id));
        if(empty($list_tags_id)) {
            return $data;
        }
        $query = "SELECT id, name, alias FROM tbl_tags_youtube WHERE id IN (" . implode(',', $list_tags_id) . ")";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data[$item['id']] = $item;
        }
        return $data;
    }

}
