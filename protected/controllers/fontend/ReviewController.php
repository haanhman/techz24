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

        if($data['row']['cate_id'] != 20) {
            $redirect_url = $this->createUrl('detail/index', $data['row']);
            $this->redirect($redirect_url);
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
        $meta_description = $data['row']['meta_description'];
        $meta_description = str_replace(' - Page 1', '', $meta_description);
        $this->_meta = array(
            'title' => $data['row']['title'] . ' - Techz24',
            'description' => $meta_description,
            'keywords' => $data['row']['meta_keywords'],
            'image' => $data['row']['thumbnail']
        );
        $this->_style_class = 'page right-sidebar singular fade-imgs-in-appear one-side-wide both-sidebars archive-page';
        $this->render('//detail/index', array(
            'data' => $data
        ));
    }

    private function getRelatedPost($row) {
        $query = "SELECT id, alias, title, thumbnail, short_text, cate_id FROM tbl_archive ORDER BY id DESC LIMIT 8";
        return $this->db->createCommand($query)->queryAll();
    }
}
