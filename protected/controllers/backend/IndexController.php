<?php

class IndexController extends BackendController
{
    public function actionIndex() {
        $data = array();
        $query = "SELECT COUNT(id) FROM tbl_latest_comment";
        $data['total_comment'] = $this->db->createCommand($query)->queryScalar();

        $query = "SELECT COUNT(*) FROM tbl_archive";
        $data['total_review'] = $this->db_crawler->createCommand($query)->queryScalar();

        $query = "SELECT COUNT(*) FROM tbl_link WHERE status = 0";
        $data['total_crawler'] = $this->db_crawler->createCommand($query)->queryScalar();

        $this->render('index', array('data' => $data));
    }

    public function actionLatestComment() {
        $data = $this->getCommentFromDisqus();
        if(!empty($data)) {
            $query = "TRUNCATE TABLE tbl_latest_comment";
            $this->db->createCommand($query)->execute();
            yii_insert_multiple('latest_comment', $data);
        }
        createMessage('Lấy comment từ Disqus thành công');
        $this->redirect($this->createUrl('index'));
    }

    private function getCommentFromDisqus()
    {
        $api_key = '4R8aqtBD9vkG4a1BLnzMRpIa12jvWnRtvkRoMqxDFKYkXoJAuX9bcQR7Sj0Nog3w';
//        $api_secret = '9xbewWKzTuIWM9G8a3q6PNF4M1t4zN6MXylPcUprZVpjCwVWgH9LA47vlFCEDGNe';
        $url = "https://disqus.com/api/3.0/forums/listPosts.json?forum=techz24&api_key=" . $api_key;

        $ch = curl_init($url);

//    curl_setopt($ch, CURLOPT_PROXY, '84.253.120.4');
//    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);

        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:13.0) Gecko/20100101 Firefox/13.0.1');
        $response = curl_exec($ch);
        if(empty($response)) {
            return array();
        }
        $response = json_decode($response, true);
        $data =array();
        $i = 1;
        foreach($response['response'] as $item) {
            $data[] = array(
                'author' => $item['author']['name'],
                'profileUrl' => $item['author']['profileUrl'],
                'raw_message' => $item['raw_message'],
                'avatar' => $item['author']['avatar']['small']['permalink']
            );
            $i++;
            if($i == 3) {
                break;
            }
        }
        return $data;
    }

}
