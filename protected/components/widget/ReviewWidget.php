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
class ReviewWidget extends MyWidget {

    public function run() {
        $query = "SELECT id, alias, title, thumbnail, short_text, cate_id, created FROM tbl_archive WHERE cate_id = 20 ORDER BY id DESC LIMIT 10";
        $data =  $this->db->createCommand($query)->queryAll();
        $this->render('review', array('data' => $data));
    }

}

