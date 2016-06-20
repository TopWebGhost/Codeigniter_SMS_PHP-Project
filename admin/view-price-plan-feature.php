<?php
require 'initapp.php';
$self='view-price-plan-feature.php';
permission::permitted($self);
$pid=_get('_pid');


require ("views/$theme/view-price-plan-feature.tpl.php");
?>