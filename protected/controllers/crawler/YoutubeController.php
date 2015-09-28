<?php

/**
 * Class YoutubeController
 * lay theo page
https://www.googleapis.com/youtube/v3/activities?part=contentDetails&channelId=UCCjyq_K1Xwfg8Lndy7lKMpA&maxResults=50&pageToken=CGQQAA&key=AIzaSyAN_HfFGZ_yViypHGkHpPNSjUzDaiR-KaQ

chi tiet video
https://www.googleapis.com/youtube/v3/videos?part=snippet&id=jUB1DcRvLOg&key=AIzaSyAN_HfFGZ_yViypHGkHpPNSjUzDaiR-KaQ

title
description
thumbnails
tags
 */

class YoutubeController extends CrawlerController
{

    private $_channel;
    private $_channel_name;
    private $_key;

    public function init()
    {
        parent::init();
        $this->_channel = array(
            1 => 'UCOmcA3f_RrH6b9NmcNa4tdg', //cnet
            2 => 'UCCjyq_K1Xwfg8Lndy7lKMpA',
            3 => 'UC-6OW5aJYBFM33zXQlBKPNA',
            4 => 'UCL8Nxsa1LB9DrMTHtt3IKiw'
        );
        $this->_channel_name = array(
            1 => 'Cnet',
            2 => 'Techcrunch',
            3 => 'Engadget',
            4 => 'Mashable'
        );
        $this->_key = 'AIzaSyAN_HfFGZ_yViypHGkHpPNSjUzDaiR-KaQ';
    }

    public function actionChannel()
    {
        $id = $_GET['id'];
        $channel_id = $this->_channel[$id];
        $channel_name = $this->_channel_name[$id];
        $pageToken = $_GET['pageToken'];
        $url = 'https://www.googleapis.com/youtube/v3/activities?part=contentDetails&channelId=' . $channel_id . '&maxResults=50&pageToken=' . $pageToken . '&key=' . $this->_key;
        $data = $this->fectchGoogleData($url);
        if (!empty($data['error'])) {
            echo "<pre>" . print_r($data, true) . "</pre>";
            die;
        }
        $nextPageToken = $data['nextPageToken'];
        $result = $data['items'];

        $list_video = array();
        foreach ($result as $item) {
            if(empty($item['contentDetails']['upload']['videoId'])) {
                continue;
            }
            $list_video[] = array(
                'video_id' => $item['contentDetails']['upload']['videoId'],
                'channel_name' => $channel_name
            );
        }
        $ok = yii_insert_multiple('youtube', $list_video, 'db_crawler');
        var_dump($ok);
        echo '<hr />';
        echo count($list_video) . ' - videos<br />';
        echo '&pageToken=' . $nextPageToken;
    }

    public function actionDetail()
    {
        $query = "SELECT * FROM tbl_youtube WHERE status = 0 LIMIT 1";
        $row = $this->db_crawler->createCommand($query)->queryRow();
        if(empty($row)) {
            echo 'het roi';
            die;
        }
        $video_id = $row['video_id'];
        $url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' . $video_id . '&key=' . $this->_key;
        $data = $this->fectchGoogleData($url);
        if (!empty($data['error'])) {
            echo "<pre>" . print_r($data, true) . "</pre>";
            die;
        }
        $video = $data['items'][0]['snippet'];
        $values = array();
        $values['title'] = trim($video['title']);
        $values['description'] = trim($video['description']);
        $values['thumbnails'] = json_encode($video['thumbnails']);
        $values['tags'] = json_encode($video['tags']);
        $values['publishedAt'] = json_encode($video['publishedAt']);
        if (!empty($video['channelTitle'])) {
            $values['channel_name'] = $video['channelTitle'];
        }
        $values['status'] = 1;
        yii_update_row('youtube', $values, 'id = ' . $row['id'], 'db_crawler');
        echo "<pre>" . print_r($values, true) . "</pre>";

        $query = "SELECT COUNT(id) FROM tbl_youtube WHERE status = 0";
        $count = $this->db_crawler->createCommand($query)->queryScalar();
        echo '<h1>Count: ' . $count . '</h1>';
        echo '<meta http-equiv="refresh" content="1">';
    }

    function fectchGoogleData($url)
    {
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
        return json_decode($response, true);
    }


}
