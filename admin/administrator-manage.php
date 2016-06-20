<?php
require 'initapp.php';
$self='administrator-manage.php';
permission::permitted($self);
$adid=_get('_id');
$amq=ORM::for_table('admins')->find_one($adid);
require ("views/$theme/administrator-manage.tpl.php");
?>