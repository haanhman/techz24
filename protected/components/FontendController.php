<?php

class FontendController extends CController
{

    protected $_table;

    /**
     *
     * @var CDbConnection
     */
    protected $db;

    public function init()
    {
        parent::init();

        $this->db = EduDataBase::getConnection();
    }

}
