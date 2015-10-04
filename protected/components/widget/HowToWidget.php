<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryWidget
 *
 * @author anhmantk
 */
class HowToWidget extends MyWidget {

    public function run() {
        $data = $this->getListPost(22, 10);
        $this->render('how_to', array('data' => $data));
    }

    private function getListPost($cate_id, $limit = 4) {
        $query = "SELECT id, cate_id, title, alias, thumbnail,short_text FROM tbl_archive WHERE cate_id = " . $cate_id . " ORDER BY id DESC LIMIT " . $limit;
        return $this->db->createCommand($query)->queryAll();
    }
}

