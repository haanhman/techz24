<?php

class IndexController extends CrawlerController
{
    public function actionIndex() {
        $time = date('d/m/Y H:i:s');
        $values = array('created' => $time);
        yii_insert_row('test_crawler', $values, 'db_crawler');
    }
}
