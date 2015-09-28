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
class CategoryWidget extends MyWidget {

    public function run() {
        $data = array();
        //danh sach feature video
        $query = "SELECT * FROM tbl_youtube WHERE is_feature = 1 ORDER BY created DESC LIMIT 10";
        $data['featureVideo'] = $this->db->createCommand($query)->queryAll();

        $list_video_id = array();

        foreach($data['featureVideo'] as $item) {
            $list_video_id[] =$item['id'];
        }

        $query = "SELECT * FROM tbl_youtube WHERE id NOT IN (". implode(',', $list_video_id) .") AND is_feature = 0 ORDER BY created DESC LIMIT 10";
        $data['recentVideo'] = $this->db->createCommand($query)->queryAll();

        $this->render('category', array('data' => $data));
    }

}

