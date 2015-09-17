<?php

class IndexController extends CrawlerController
{
    public function actionIndex() {
        $short_url = createShortUrl('http://www.cnet.com/how-to/prepare-iphone-ipad-ipod-touch-ios-9/');
        echo $short_url;
        $this->render('index');
    }
}
