<?php
//phpinfo();
$str = 'Now on Tap, Google&#039;s handy new contextual assistant feature for Android 6.0 Marshmallow, is now working once again for those on the developer preview.';
//echo html_entity_decode($str);
echo htmlentities($str, ENT_QUOTES, "UTF-8");