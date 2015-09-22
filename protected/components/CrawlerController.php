<?php
require_once LIB_PATH . '/simple_html_dom.php';

class CrawlerController extends CController
{
    protected $_domain;
    protected $_source_id;
    protected $_table;

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

    public function init()
    {
        parent::init();

        $this->db = EduDataBase::getConnection();
        $this->db_crawler = EduDataBase::getConnection('db_crawler');
    }

    protected function crawlerSuccess($row, $status = 1)
    {
        $query = "UPDATE tbl_link SET status = " . $status . " WHERE id = " . $row['id'];
        $this->db_crawler->createCommand($query)->execute();
        echo '<meta http-equiv="refresh" content="1">';
    }

}
