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
class FooterTagVideoWidget extends MyWidget
{

    public function run()
    {
        $data = array();
        $query = "SELECT alias, name FROM tbl_tags_youtube WHERE is_feature = 1 ORDER BY total_video DESC LIMIT 10";
        $data['listItem'] = $this->db->createCommand($query)->queryAll();
        $this->render('footer/tagvideo', array('data' => $data));
    }



}

