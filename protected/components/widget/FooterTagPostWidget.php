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
class FooterTagPostWidget extends MyWidget
{

    public function run()
    {
        $data = array();
        $query = "SELECT * FROM tbl_tags WHERE is_feature = 1";
        $data['listItem'] = $this->db->createCommand($query)->queryAll();
        $this->render('footer/tagpost', array('data' => $data));
    }



}

