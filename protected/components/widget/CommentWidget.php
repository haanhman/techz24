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
class CommentWidget extends MyWidget
{

    public function run()
    {
        $data = array();
        $query = "SELECT * FROM tbl_latest_comment ORDER BY id";
        $data['listItem'] = $this->db->createCommand($query)->queryAll();
        $this->render('comment', array('data' => $data));
    }



}

