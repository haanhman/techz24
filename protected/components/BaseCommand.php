<?php

class BaseCommand extends CConsoleCommand {

    /**
     *
     * @var CDbConnection
     */
    protected $db;

    /**
     *
     * @var CDbConnection
     */
    protected $db_crawler;

    public function init() {
        parent::init();
        $this->db = EduDataBase::getConnection();
        $this->db_crawler = EduDataBase::getConnection('db_crawler');
    }

}
