<?php 
require 'initapp.php';
$self='sender-id-update.php';
//permission::permitted($self);

$cmd=_get('_sid');

$d=ORM::for_table('manage_sender')->find_one($cmd);

require ("views/$theme/sender-id-update.tpl.php");


?>