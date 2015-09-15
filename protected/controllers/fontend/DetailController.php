<?php

class DetailController extends FontendController
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
        $this->render('index', array(
            'data' => $data
        ));
    }
}
