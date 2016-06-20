<?php
require 'initapp.php';
$self='sender-id-manage.php';
permission::permitted($self);
require ("views/$theme/sender-id-manage.tpl.php");
?>