<?php
require 'initapp.php';
$self='add-new-support-department.php';
permission::permitted($self);
require ("views/$theme/add-new-support-department.tpl.php");
?>