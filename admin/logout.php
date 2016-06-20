<?php
ob_start();
require 'initapp.php';
session_destroy();
session_start();
conf('login.php','s','Logged Out Successful, You can Login Again');

?>