<?php
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$text = $data['row']['title'];
?>


<div class="mom-social-share ss-horizontal border-box php-share" data-id="198">
    <div class="ss-icon facebook">
        <a href="http://www.facebook.com/sharer.php?u=<?php echo $url ?>" target="_blank"><span class="icon"><i
                    class="fa-icon-facebook"></i>Share</span></a>

    </div>
    <!--icon-->

    <div class="ss-icon twitter">
        <a target="_blank" href="https://twitter.com/share?url=<?php echo $url ?>&amp;text=<?php echo CHtml::encode($text) ?>&amp;hashtags=techz24"><span
                class="icon"><i class="fa-icon-twitter"></i>Tweet</span></a>

    </div>
    <!--icon-->

    <div class="ss-icon googleplus">
        <a target="_blank" href="https://plus.google.com/share?url=<?php echo $url ?>"><span class="icon"><i
                    class="fa-icon-google-plus"></i>Share</span></a>
    </div>
    <!--icon-->
    <div class="ss-icon linkedin">
        <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url ?>"><span class="icon"><i
                    class="fa-icon-linkedin"></i>Share</span></a>
    </div>
    <!--icon-->
    <div class="ss-icon pinterest">
        <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><span
                class="icon"><i class="fa-icon-pinterest"></i>Share</span></a>

    </div>
    <!--icon-->
    <div class="ss-icon vk vk-198">
        <a target="_blank" href="http://vkontakte.ru/share.php?url=<?php echo $url ?>"><span class="icon"><i class="fa-icon-vk"></i>Share</span></a>
    </div>
    <!--icon-->

    <div class="clear"></div>
</div>