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
class ArchiveController extends BackendController
{

    public function init()
    {
        parent::init();
        $this->_table = 'tbl_archive';
    }


    private function getCategory($child = false)
    {
        $data = array();
        $query = "SELECT * FROM tbl_category";
        if($child == true) {
            $query .= " WHERE parent_id <> 0 ORDER BY name";
        }
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
        $where = "";
        $query_count = "SELECT COUNT(id) FROM " . $this->_table . " WHERE 1 " . $where;

        $item_count = $this->db->createCommand($query_count)->queryScalar();

        $pages = new CPagination($item_count);
        $perPage = 10;
        $pages->setPageSize($perPage);

        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
        if ($page <= 0) {
            $page = 1;
        }

        $offset = ($page - 1) * $perPage;

        $query = "SELECT id, cate_id, short_text, title, thumbnail, created, alias FROM " . $this->_table . " WHERE 1 " . $where . " "
            . " ORDER BY id DESC "
            . "LIMIT " . $offset . "," . $perPage;
        $data['listItem'] = $this->db->createCommand($query)->queryAll();


        $data['category'] = $this->getCategory();

        $this->render('index', array(
            'data' => $data,
            'item_count' => $item_count,
            'page_size' => $perPage,
            'pages' => $pages,
        ));
    }

    public function actionShortUrl()
    {
        $query = "SELECT id, source_url FROM " . $this->_table . " WHERE short_url = '' LIMIT 10";
        $result = $this->db->createCommand($query)->queryAll();
        if (empty($result)) {
            die('Het roi');
        }
        $query = "UPDATE " . $this->_table . " SET short_url = :short_url WHERE id = :id";
        $urls = array();
        foreach ($result as $item) {
            $short_url = createShortUrl($item['source_url']);
            if(!empty($short_url)) {
                $urls[] = $short_url;
                $values = array(
                    ':id' => $item['id'],
                    ':short_url' => $short_url,
                );
                $this->db->createCommand($query)->bindValues($values)->execute();
            }
        }
        echo "<pre>" . print_r($urls, true) . "</pre>";
        echo '<meta http-equiv="refresh" content="1">';
        die;
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

            yii_update_row('archive', $params, 'id = ' . $id);
            createMessage('Cập nhật thành công');
            $this->redirect($this->createUrl('index'));
        }


        $data['category'] = $this->getCategory(true);


        $query = "SELECT * FROM tbl_archive WHERE id = " . $id;
        $data['row'] = $this->db->createCommand($query)->queryRow();
        $this->render('edit', array('data' => $data));
    }

}
