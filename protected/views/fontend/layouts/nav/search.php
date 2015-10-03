<?php
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
$keyword = isset($_GET['keyword']) ? urlGETParams('keyword') : '';
$url_search = $this->createUrl('search/index');
if($controller == 'video' | ($controller == 'search' && $action == 'video')) {
    $url_search = $this->createUrl('search/video');
}
?>

<div class="nav-buttons">
                    <span class="nav-button nav-search">
                        <i class="fa-icon-search"></i>
                    </span>

    <div class="nb-inner-wrap search-wrap border-box">
        <div class="nb-inner sw-inner">
            <div class="search-form mom-search-form">
                <form action="<?php echo $url_search ?>" method="GET">
                    <input class="sf" type="text" placeholder="Search ..." value="<?php echo CHtml::encode($keyword) ?>" name="keyword">
                    <button class="button" type="submit"><i class="fa-icon-search"></i></button>
                </form>
            </div>
            <!--ajax search results-->
        </div>
        <!--sw inner-->
    </div>
    <!--search wrap-->

</div>
<!--nav-buttons-->