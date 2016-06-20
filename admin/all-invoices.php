<?php
require 'initapp.php';
$self='all-invoices.php';
permission::permitted($self);
require ("views/$theme/all-invoices.tpl.php");
?>