<?php
ob_start();
require 'initapp.php';
$login=ORM::for_table('accounts')->find_one($cid);
$login->online='0';
$login->save();

session_destroy();
session_start();
conf('login.php','s','Logged Out Successfully, You can Login Again');

?>