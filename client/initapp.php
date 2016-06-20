<?php
ob_start();
session_start();
define("_APP_RUN", true);
require '../AppINIT.php';
_authenticate();
$slid = $_SESSION['lid'];
$ulid = $_COOKIE["_lid"];
if ($slid != $ulid) {
    conf('../login.php','e','Invalid Token Please Login Again');
}
$cid=$_SESSION['cid'];
$footerTxt = appconfig ('footerTxt');
$theme=  appconfig('theme');

?>
