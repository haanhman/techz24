<?php

class FontendUrlManager extends CUrlManager {

    public function createUrl($route, $params = array(), $ampersand = '&') {
        if ($route == 'detail/index') {
            if($params['cate_id'] == 20) {
                $route = 'review/index';
                $all_params['alias'] =$params['alias'];
            } else {
                $all_params['alias'] =$params['alias'];
            }
            $params = $all_params;
        }
        return parent::createUrl($route, $params, $ampersand);
    }
}