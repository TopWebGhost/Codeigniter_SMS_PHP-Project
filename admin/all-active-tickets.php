<?php
require 'initapp.php';
$self='all-active-tickets.php';
permission::permitted($self);
require ("views/$theme/all-active-tickets.tpl.php");
?>