<?php

class FontendController extends CController
{

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
        $this->db = EduDataBase::getConnection();
    }

    public function getSource() {
        return array(
            1 => 'cnet.com'
        );
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
        $query = "SELECT id, name, alias FROM tbl_tags WHERE id IN (" . implode(',', $list_tags_id) . ")";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data[$item['id']] = $item;
        }
        return $data;
    }

}
