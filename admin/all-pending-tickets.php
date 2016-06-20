<?php
require 'initapp.php';
$self='all-pending-tickets.php';
permission::permitted($self);
require ("views/$theme/all-pending-tickets.tpl.php");
?>