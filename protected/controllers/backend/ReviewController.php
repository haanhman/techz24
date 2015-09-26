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
class ReviewController extends BackendController
{

    public function init()
    {
        parent::init();
    }


    private function getCategory()
    {
        $data = array();
        $query = "SELECT * FROM tbl_category";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $data[$item['id']] = $item['name'];
        }
        return $data;
    }

    //put your code here
    public function actionIndex()
    {
        $data = array();
        $source = isset($_GET['source']) ? intval($_GET['source']) : 1;
        $where = " AND is_delete = 0 AND source_id = " . $source;
        $query_count = "SELECT COUNT(id) FROM tbl_archive WHERE 1 " . $where;
        $item_count = $this->db_crawler->createCommand($query_count)->queryScalar();

        $pages = new CPagination($item_count);
        $perPage = 10;
        $pages->setPageSize($perPage);

        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
        if ($page <= 0) {
            $page = 1;
        }

        $offset = ($page - 1) * $perPage;

        $query = "SELECT id, cate_id, short_text, title, thumbnail FROM tbl_archive WHERE 1 " . $where . " "
            . " ORDER BY id "
            . "LIMIT " . $offset . "," . $perPage;
        $data['listItem'] = $this->db_crawler->createCommand($query)->queryAll();


        $data['category'] = $this->getCategory();

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
        $query = "SELECT * FROM tbl_archive WHERE id = " . $id;
        $data = $this->db_crawler->createCommand($query)->queryRow();
        $this->render('detail', array('data' => $data));
    }

    public function actionEdit()
    {
        $data = array();
        $id = urlGETParams('id', VARIABLE_NUMBER);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $remove_gallery = intval($_POST['remove_gallery']);
            $params = $_POST;
            unset($params['remove_gallery']);
            if ($remove_gallery == 1) {
                $params['gallery'] = '';
            }
            if (!empty($params['tags'])) {
                $tags = explode(', ', $params['tags']);
                trim_array($tags);
                $params['tags'] = json_encode($tags);
            }

            yii_update_row('archive', $params, 'id = ' . $id, 'db_crawler');
            createMessage('Cập nhật thành công');
            $this->redirect($this->createUrl('detail', array('id' => $id)));
        }


        $query = "SELECT * FROM tbl_archive WHERE id = " . $id;
        $data = $this->db_crawler->createCommand($query)->queryRow();
        $this->render('edit', array('data' => $data));
    }

    public function actionDelete()
    {

        $id = urlGETParams('id', VARIABLE_NUMBER);

        $query = "SELECT * FROM tbl_archive WHERE id = " . $id;
        $row = $this->db_crawler->createCommand($query)->queryRow();

        $query = "DELETE FROM tbl_archive WHERE id = " . $id;
        $data = $this->db_crawler->createCommand($query)->execute();
        createMessage('Xoá nội dung: ' . $row['title'] . ' thành công');
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    private function createTags($tags)
    {
        $list_tags = array();
        $query = "SELECT id FROM tbl_tags WHERE alias = :alias";
        foreach ($tags as $item) {
            $alias = change_url_seo($item);
            $values = array(':alias' => $alias);
            $id = $this->db->createCommand($query)->bindValues($values)->queryScalar();
            if ($id <= 0) {
                $values = array(
                    'name' => $item,
                    'alias' => $alias
                );
                yii_insert_row('tags', $values);
                $id = $this->db->lastInsertID;
            }
            $list_tags[] = $id;
        }
        return ',' . implode(',', $list_tags) . ',';
    }

    public function actionApprove()
    {
        $id = urlGETParams('id', VARIABLE_NUMBER);

        $query = "SELECT * FROM tbl_archive WHERE id = " . $id;
        $row = $this->db_crawler->createCommand($query)->queryRow();
        if (!empty($row['tags'])) {
            $tags = json_decode($row['tags'], true);
            trim_array($tags);
            $tags = $this->createTags($tags);
        }
        //`tags`, `meta_keywords`, `meta_description`, `gallery`, `source_id`, `source_url`, `status`
        $values = array(
            'cate_id' => $row['cate_id'],
            'title' => $row['title'],
            'alias' => change_url_seo($row['title']),
            'thumbnail' => $row['thumbnail'],
            'short_text' => $row['short_text'],
            'content' => $row['content'],
            'gallery' => $row['gallery'],
            'meta_keywords' => $row['meta_keywords'],
            'meta_description' => $row['meta_description'],
            'source_id' => $row['source_id'],
            'source_url' => $row['source_url'],
            'status' => 1,
            'tags' => $tags,
            'created' => time()
        );
        yii_insert_row('archive', $values);
        createMessage('Approve noi dung: ' . $row['title'] . ' thành công');

        $query = "DELETE FROM tbl_archive WHERE id = " . $id;
        $this->db_crawler->createCommand($query)->execute();

        $this->redirect($this->createUrl('review/index', array('source' => $row['source_id'])));
    }

    public function actionApproveAll()
    {
        $query = "SELECT * FROM tbl_archive WHERE is_delete = 0";
        $result = $this->db_crawler->createCommand($query)->queryAll();
        if (empty($result)) {
            die('khong co du lieu');
        }
        foreach ($result as $row) {
            if (!empty($row['tags'])) {
                $tags = json_decode($row['tags'], true);
                trim_array($tags);
                $tags = $this->createTags($tags);
            }
            //`tags`, `meta_keywords`, `meta_description`, `gallery`, `source_id`, `source_url`, `status`
            $values = array(
                'parent_id' => $row['parent_id'],
                'cate_id' => $row['cate_id'],
                'title' => $row['title'],
                'alias' => change_url_seo($row['title']),
                'thumbnail' => $row['thumbnail'],
                'short_text' => $row['short_text'],
                'content' => $row['content'],
                'gallery' => $row['gallery'],
                'meta_keywords' => $row['meta_keywords'],
                'meta_description' => $row['meta_description'],
                'source_id' => $row['source_id'],
                'source_url' => $row['source_url'],
                'status' => 1,
                'tags' => $tags,
                'created' => time()
            );
            yii_insert_row('archive', $values);
            createMessage('Approve noi dung: ' . $row['title'] . ' thành công');
        }

        $query = "DELETE FROM tbl_archive";
        $this->db_crawler->createCommand($query)->execute();
        $this->redirect($this->createUrl('review/index'));
    }

}
