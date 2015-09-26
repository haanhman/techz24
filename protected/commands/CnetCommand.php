<?php

class CnetCommand extends BaseCommand {

    public function run($args) {
        $time = date('d/m/Y H:i:s');
        $values = array('created' => $time);
        yii_insert_row('test_crawler', $values, 'db_crawler');
    }

}
