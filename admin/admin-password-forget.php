<?php
ob_start();
session_start();
define("_APP_RUN", true);
require "../AppINIT.php";
$theme=  appconfig('admintheme');
require ("views/$theme/admin-password-forget.tpl.php");
?>