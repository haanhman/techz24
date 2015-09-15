<?php
/**
 * Created by PhpStorm.
 * User: anhmantk
 * Date: 9/16/15
 * Time: 6:12 AM
 */

class MyWidget extends CWidget {
    /**
     *
     * @var CDbConnection
     */
    protected $db;

    protected $_controller;

    public function init()
    {
        parent::init();
        $this->db = EduDataBase::getConnection();
        $this->_controller = Yii::app()->getController();
    }
}