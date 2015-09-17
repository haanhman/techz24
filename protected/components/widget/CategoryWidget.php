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
        $query = "SELECT * FROM tbl_category ORDER BY weight";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data['category'][$item['id']] = $item;
        }
        $data['cate_static'] = $this->staticCategory();
        $this->render('category', array('data' => $data));
    }

    private function staticCategory() {
        $data = array();
        $query = "SELECT cate_id, COUNT(id) AS total FROM tbl_archive GROUP BY cate_id";
        $result = $this->db->createCommand($query)->queryAll();
        foreach($result as $item) {
            $data[$item['cate_id']] = $item['total'];
        }
        return $data;
    }

}

