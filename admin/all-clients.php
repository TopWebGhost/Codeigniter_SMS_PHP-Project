<?php
require 'initapp.php';
$self='all-clients.php';
permission::permitted($self);
require ("views/$theme/all-clients.tpl.php");
?>