<div id="share-buttons">
    <?php
    $url = 'http://www.' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $text = $data['row']['title'];
    ?>
    <!-- Facebook -->
    <a href="http://www.facebook.com/sharer.php?u=<?php echo $url ?>" target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/facebook.png" alt="Facebook"/>
    </a>

    <!-- Google+ -->
    <a href="https://plus.google.com/share?url=<?php echo $url ?>" target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/google.png" alt="Google"/>
    </a>

    <!-- Twitter -->
    <a href="https://twitter.com/share?url=<?php echo $url ?>&amp;text=<?php echo CHtml::encode($text) ?>&amp;hashtags=techz24"
       target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/twitter.png" alt="Twitter"/>
    </a>

    <!-- LinkedIn -->
    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url ?>" target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/linkedin.png" alt="LinkedIn"/>
    </a>


    <!-- Buffer -->
    <a href="https://bufferapp.com/add?url=<?php echo $url ?>&amp;text=<?php echo CHtml::encode($text) ?>"
       target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/buffer.png" alt="Buffer"/>
    </a>

    <!-- Digg -->
    <a href="http://www.digg.com/submit?url=<?php echo $url ?>" target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/diggit.png" alt="Digg"/>
    </a>

    <!-- Email -->
    <a href="mailto:?Subject=<?php echo CHtml::encode($text) ?>&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo $url ?>">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/email.png" alt="Email"/>
    </a>

    <!-- Pinterest -->
    <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/pinterest.png" alt="Pinterest"/>
    </a>

    <!-- Reddit -->
    <a href="http://reddit.com/submit?url=<?php echo $url ?>&amp;title=<?php echo CHtml::encode($text) ?>"
       target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/reddit.png" alt="Reddit"/>
    </a>

    <!-- StumbleUpon-->
    <a href="http://www.stumbleupon.com/submit?url=<?php echo $url ?>&amp;title=<?php echo CHtml::encode($text) ?>"
       target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/stumbleupon.png" alt="StumbleUpon"/>
    </a>

    <!-- Tumblr-->
    <a href="http://www.tumblr.com/share/link?url=<?php echo $url ?>&amp;title=<?php echo CHtml::encode($text) ?>"
       target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/tumblr.png" alt="Tumblr"/>
    </a>



    <!-- VK -->
    <a href="http://vkontakte.ru/share.php?url=<?php echo $url ?>" target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/vk.png" alt="VK"/>
    </a>

    <!-- Yummly -->
    <a href="http://www.yummly.com/urb/verify?url=<?php echo $url ?>&amp;title=<?php echo CHtml::encode($text) ?>"
       target="_blank">
        <img src="<?php echo base_url() ?>/public/assets/fontend/img/social/yummly.png" alt="Yummly"/>
    </a>

</div>