<?php
require 'initapp.php';
$self='all-closed-tickets.php';
permission::permitted($self);
require ("views/$theme/all-closed-tickets.tpl.php");
?>