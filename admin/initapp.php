<?php
ob_start();
session_start();
define("_APP_RUN", true);
require ('../AppINIT.php');
require ('../lib/admin.init.php');
require ('../lib/permission.php');

_isadmin();
$slid = $_SESSION['lid'];
$ulid = $_COOKIE["_lid"];
if ($slid != $ulid) {
    conf('login.php','e','Invalid Token Please Login Again');
}
$aid=$_SESSION['aid'];
$theme=  appconfig('admintheme');
$xbrand = appconfig('BrandName');
?>
