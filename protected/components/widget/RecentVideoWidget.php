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
class RecentVideoWidget extends MyWidget {

    public function run() {
        $data = array();
        //danh sach feature video
        $query = "SELECT * FROM tbl_youtube WHERE is_feature = 0 ORDER BY created DESC LIMIT 10";
        $data['featureVideo'] = $this->db->createCommand($query)->queryAll();
        $this->render('recentvideo', array('data' => $data));
    }

}

