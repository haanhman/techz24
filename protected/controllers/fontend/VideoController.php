<?php

class VideoController extends FontendController
{
    public function actionIndex()
    {
        $data = array();

        //danh sach feature video
        $query = "SELECT * FROM tbl_youtube WHERE is_feature = 1 ORDER BY created DESC LIMIT 10";
        $data['featureVideo'] = $this->db->createCommand($query)->queryAll();

        $list_id = array();
        foreach ($data['featureVideo'] as $item) {
            $list_id[] = $item['id'];
        }


        $query = "SELECT * FROM tbl_youtube WHERE id NOT IN (" . implode(',', $list_id) . ") ORDER BY created DESC LIMIT 18";
        $data['listVideo'] = $this->db->createCommand($query)->queryAll();

        //danh sach video xem nhieu 7 ngay qua
        $starttime = strtotime('-7 days');
        $endtime = time();
        $query = "SELECT * FROM tbl_youtube WHERE created BETWEEN " . $starttime . " AND " . $endtime . " ORDER BY viewer DESC LIMIT 12";
        $data['videoXemNhieu'] = $this->db->createCommand($query)->queryAll();

        $this->_meta = array(
            'title' => 'Videos - Techz24',
            'description' => 'Techz24 videos include HD streaming and downloadable content, the latest tech news, video reviews, Techz24 shows and more.',
            'keywords' => '',
        );

        $this->render('index', array(
            'data' => $data
        ));
    }

    public function actionDetail()
    {
        $data = array();
        $alias = urlGETParams('alias');
        $query = "SELECT * FROM tbl_youtube WHERE alias = :alias";
        $values = array(':alias' => $alias);
        $row = $this->db->createCommand($query)->bindValues($values)->queryRow();
        if (empty($row)) {
            $this->redirect($this->createUrl('video/index'));
        }

        //update so luot view
        $query = "UPDATE tbl_youtube SET view_real = (view_real + 1), viewer = (viewer+1) WHERE id = " . $row['id'];
        $this->db->createCommand($query)->execute();

        $str_tags = trim($row['tags'], ',');
        $arr_tags = explode(',', $str_tags);
        $data['tags'] = $this->getListVideoTags($arr_tags);
        $keywords = '';
        if (!empty($data['tags'])) {
            $tags = array();
            foreach ($data['tags'] as $item) {
                $tags[] = $item['name'];
                if (count($tags) == 8) {
                    break;
                }
            }
            $keywords = implode(',', $tags);
        }

        $this->_meta = array(
            'title' => $row['title'] . ' - Techz24',
            'description' => short_text($row['description'], 160),
            'keywords' => short_text($keywords, 85),
            'image' => getYoutubeThumbnail($row['thumbnails'], 'standard')
        );


        $query = "SELECT * FROM tbl_youtube ORDER BY created DESC LIMIT 18";
        $data['listVideo'] = $this->db->createCommand($query)->queryAll();


        $data['row'] = $row;
        $this->render('detail', array(
            'data' => $data
        ));
    }

    public function actionTag()
    {

        $data = array();
        $alias = urlGETParams('alias');
        $query = "SELECT * FROM tbl_tags_youtube WHERE alias = :alias";
        $values = array(':alias' => $alias);
        $row = $this->db->createCommand($query)->bindValues($values)->queryRow();

        if (empty($row)) {
            $this->redirect($this->createUrl('video/index'));
        }


        $data['row'] = $row;
        $tag_id = $row['id'];
        $where = " AND tags LIKE '%," . $tag_id . ",%' ";
        $query_count = "SELECT COUNT(id) FROM tbl_youtube WHERE 1 " . $where;
        $item_count = $this->db->createCommand($query_count)->queryScalar();

        $pages = new CPagination($item_count);
        $perPage = 15;
        $pages->setPageSize($perPage);

        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
        if ($page <= 0) {
            $page = 1;
        }

        $offset = ($page - 1) * $perPage;

        $query = "SELECT * FROM tbl_youtube WHERE 1 " . $where . " "
            . " ORDER BY id DESC "
            . "LIMIT " . $offset . "," . $perPage;
        $data['listVideo'] = $this->db->createCommand($query)->queryAll();


        $title = $data['row']['name'] . ' videos';
        if ($page > 1) {
            $title .= ' - page ' . $page;
        }

        $this->_meta = array(
            'title' => $title . ' - Techz24',
            'description' => 'All videos in topic . ' . $data['row']['name'] . ' on Techz24'
        );

        $this->render('tag', array(
            'data' => $data,
            'item_count' => $item_count,
            'page_size' => $perPage,
            'pages' => $pages,
        ));

    }

}
