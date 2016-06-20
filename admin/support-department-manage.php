<?php
require 'initapp.php';
$sid=_get('_sid');
$self='support-department-manage.php';
permission::permitted($self);

$sdepart=ORM::for_table('supportdepartments')->find_one($sid);
$sdname=$sdepart['name'];
$email=$sdepart['email'];
$showportal=$sdepart['show'];

require ("views/$theme/support-department-manage.tpl.php");

?>