<?php
require 'initapp.php';
$self='create-new-invoice.php';
permission::permitted($self);



require ("views/$theme/create-new-invoice.tpl.php");

?>