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
class RecentVideoAndTagWidget extends MyWidget {

    public function run() {
        $data = array();
        //danh sach feature video
        $video_home = false;
        if($this->_controller->id == 'video' && $this->_controller->action->id == 'index') {
            $video_home = true;
        }

        if(!$video_home) {
            $query = "SELECT id FROM tbl_youtube WHERE is_feature = 1 ORDER BY created DESC LIMIT 5";
            $list_video_id = $this->db->createCommand($query)->queryColumn();

            $query = "SELECT * FROM tbl_youtube WHERE id NOT IN (". implode(',', $list_video_id) .") AND is_feature = 0 ORDER BY created DESC LIMIT 10";
            $data['recentVideo'] = $this->db->createCommand($query)->queryAll();
        }




        $query = "SELECT alias, name FROM tbl_tags_youtube WHERE is_feature = 1 ORDER BY total_video DESC LIMIT 20";
        $data['listTag'] = $this->db->createCommand($query)->queryAll();

        $this->render('video_tag', array('data' => $data, 'video_home' => $video_home));
    }

}

