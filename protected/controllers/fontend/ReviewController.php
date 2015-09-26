<?php

class ReviewController extends FontendController
{
    public function actionIndex()
    {
        $data = array();
        $alias = urlGETParams('alias');
        $query = "SELECT * FROM tbl_archive WHERE alias = :alias";
        $values = array('alias' => $alias);
        $data['row'] = $this->db->createCommand($query)->bindValues($values)->queryRow();
        if(empty($data['row'])) {
            $this->redirect($this->createUrl('index/index'));
        }
        $data['source'] = $this->getSource();

        if(!empty($data['row']['tags'])) {
            $str_tag = trim($data['row']['tags'], ',');
            $data['tags'] = $this->getListTags(explode(',', $str_tag));
        }

        //lay thong tin danh muc cua bai viet
        $query = "SELECT * FROM tbl_category WHERE id = " . $data['row']['cate_id'];
        $data['category'] = $this->db->createCommand($query)->queryRow();

        $data['relate_post'] = $this->getRelatedPost($data['row']);


        $this->_meta = array(
            'title' => $data['row']['title'] . ' - Techz24',
            'description' => $data['row']['meta_description'],
            'keywords' => $data['row']['meta_keywords'],
            'image' => $data['row']['thumbnail']
        );

        $this->render('index', array(
            'data' => $data
        ));
    }

    private function getRelatedPost($row) {
        $query = "SELECT id, alias, title, thumbnail, short_text FROM tbl_archive WHERE cate_id = :cate_id AND id <> :id ORDER BY id DESC LIMIT 10";
        $values = array(':cate_id' => $row['cate_id'], ':id' => $row['id']);
        return $this->db->createCommand($query)->bindValues($values)->queryAll();
    }
}
