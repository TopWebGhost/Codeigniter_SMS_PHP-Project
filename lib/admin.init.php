<?php
if (!defined("_APP_RUN"))
    die('Direct access to this location is not allowed.');
function _isadmin() {
    if(!isset($_SESSION['aid'])) {
        conf('login.php');
    }

}

?>
