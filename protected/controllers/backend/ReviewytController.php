<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 * @desc Phân quyền
 * @author anhmantk
 */
class ReviewytController extends BackendController
{

    public function init()
    {
        parent::init();
    }


    //put your code here
    public function actionIndex()
    {
        $data = array();
        $where = " AND is_approve = 0 ";
        $query_count = "SELECT COUNT(id) FROM tbl_youtube WHERE 1 " . $where;
        $item_count = $this->db_crawler->createCommand($query_count)->queryScalar();

        $pages = new CPagination($item_count);
        $perPage = 10;
        $pages->setPageSize($perPage);

        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
        if ($page <= 0) {
            $page = 1;
        }

        $offset = ($page - 1) * $perPage;

        $query = "SELECT * FROM tbl_youtube WHERE 1 " . $where . " "
            . " ORDER BY id DESC "
            . "LIMIT " . $offset . "," . $perPage;
        $data['listItem'] = $this->db_crawler->createCommand($query)->queryAll();

        $this->render('index', array(
            'data' => $data,
            'item_count' => $item_count,
            'page_size' => $perPage,
            'pages' => $pages,
        ));
    }


    public function actionDetail()
    {
        $data = array();
        $id = urlGETParams('id', VARIABLE_NUMBER);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $params = $_POST;
            yii_update_row('youtube', $params, 'id = ' . $id, 'db_crawler');
            createMessage('Cập nhật thành công');
            $this->redirect($this->createUrl('detail', array('id' => $id)));
        }

        $query = "SELECT * FROM tbl_youtube WHERE id = " . $id;
        $data = $this->db_crawler->createCommand($query)->queryRow();
        $this->render('detail', array('data' => $data));
    }

    public function actionDelete()
    {

        $id = urlGETParams('id', VARIABLE_NUMBER);

        $query = "SELECT * FROM tbl_youtube WHERE id = " . $id;
        $row = $this->db_crawler->createCommand($query)->queryRow();

        $query = "DELETE FROM tbl_youtube WHERE id = " . $id;
        $data = $this->db_crawler->createCommand($query)->execute();
        createMessage('Xoá nội dung: ' . $row['title'] . ' thành công');
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    private function createTags($tags)
    {
        $list_tags = array();
        $query = "SELECT id FROM tbl_tags_youtube WHERE alias = :alias";
        foreach ($tags as $item) {
            $alias = change_url_seo($item);
            $values = array(':alias' => $alias);
            $id = $this->db->createCommand($query)->bindValues($values)->queryScalar();
            if ($id <= 0) {
                $values = array(
                    'name' => $item,
                    'alias' => $alias
                );
                yii_insert_row('tags_youtube', $values);
                $id = $this->db->lastInsertID;
            }
            $list_tags[] = $id;
        }
        return ',' . implode(',', $list_tags) . ',';
    }

    private function checkAlias($alias) {
        $query = "SELECT id FROM tbl_youtube WHERE alias = :alias";
        $values = array(':alias' => $alias);
        $id = $this->db->createCommand($query)->bindValues($values)->queryScalar();
        if($id > 0) {
            return $this->checkAlias($alias . '-2');
        }
        return $alias;
    }

    public function actionApprove()
    {
        $id = urlGETParams('id', VARIABLE_NUMBER);

        $query = "SELECT * FROM tbl_youtube WHERE id = " . $id;
        $row = $this->db_crawler->createCommand($query)->queryRow();
        if (!empty($row['tags'])) {
            $tags = json_decode($row['tags'], true);
            trim_array($tags);
            $tags = $this->createTags($tags);
        }
        unset($row['id']);
        unset($row['is_approve']);
        $row['alias'] = $this->checkAlias(change_url_seo($row['title']));
        $row['tags'] = $tags;
        $row['viewer'] = rand(123, 5000);

        $publishedAt = trim($row['publishedAt'], '"');
        $row['created'] = strtotime($publishedAt);

        yii_insert_row('youtube', $row);
        createMessage('Approve video: ' . $row['title'] . ' thành công');

        $query = "UPDATE tbl_youtube SET is_approve = 1 WHERE id = " . $id;
        $this->db_crawler->createCommand($query)->execute();

        $this->redirect($this->createUrl('reviewyt/index'));
    }


//    public function actionUpdate() {
//        $query = "SELECT id, publishedAt FROM tbl_youtube";
//        $result = $this->db->createCommand($query)->queryAll();
//        $query = "UPDATE tbl_youtube SET created = :created WHERE id = :id";
//        foreach($result as $item) {
//            $publishedAt = trim($item['publishedAt'], '"');
//            $values = array(':id' => $item['id'], ':created' => strtotime($publishedAt));
//            $this->db->createCommand($query)->bindValues($values)->execute();
//        }
//    }


}
