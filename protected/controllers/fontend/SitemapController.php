<?php
require_once LIB_PATH . '/SitemapGenerator.php';

class SitemapController extends FontendController
{
    public function actionIndex()
    {

        $domain = 'http://' . $_SERVER['SERVER_NAME'];

        $time = explode(" ", microtime());
        $time = $time[1];

        // create object
        $sitemap = new SitemapGenerator($domain . '/', ROOT_PATH);
        // will create also compressed (gzipped) sitemap
        $sitemap->createGZipFile = true;

        $urls = array();
        $urls[] = array($domain, date('c'), 'daily', '1');
        $urls[] = array($this->createAbsoluteUrl('video/index'), date('c'), 'daily', '1');
        //danh muc
        $query = "SELECT id, alias FROM tbl_category";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $url = $this->createAbsoluteUrl('category/index', array('alias' => $item['alias']));
            if ($item['id'] == 20) {
                $url = $domain . '/reviews.html';
            }
            $urls[] = array($url, date('c'), 'daily', '0.9');
        }
        //topic tag
        $query = "SELECT id, alias FROM tbl_tags";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $url = $this->createAbsoluteUrl('tag/index', array('alias' => $item['alias']));
            $urls[] = array($url, date('c'), 'daily', '0.7');
        }

        //danh sach bai viet
        $query = "SELECT id, alias, cate_id FROM tbl_archive ORDER BY id DESC";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $url = $this->createAbsoluteUrl('detail/index', $item);
            $urls[] = array($url);
        }

        //danh sach bai viet
        $query = "SELECT id, alias FROM tbl_youtube ORDER BY id DESC";
        $result = $this->db->createCommand($query)->queryAll();
        foreach ($result as $item) {
            $url = $this->createAbsoluteUrl('video/detail', array('alias' => $item['alias']));
            $urls[] = array($url);
        }

        if ($_GET['test'] == 1) {
            echo count($urls);
            die;
        }

        header('Content-type: application/xml');
        // add many URLs at one time
        $sitemap->addUrls($urls);

        try {
            // create sitemap
            $sitemap->createSitemap();

            // write sitemap as file
            $sitemap->writeSitemap();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
