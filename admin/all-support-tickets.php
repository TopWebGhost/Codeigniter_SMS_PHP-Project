<?php
require 'initapp.php';
$self='all-support-tickets.php';
permission::permitted($self);
require ("views/$theme/all-support-tickets.tpl.php");
?>