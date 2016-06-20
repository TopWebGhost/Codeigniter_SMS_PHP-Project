<?php 
require 'initapp.php';
$self='coverage-manage.php';
//permission::permitted($self);

$cmd=_get('_coid');
$d=ORM::for_table('int_country_codes')->find_one($cmd);

require ("views/$theme/coverage-manage.tpl.php");
?>