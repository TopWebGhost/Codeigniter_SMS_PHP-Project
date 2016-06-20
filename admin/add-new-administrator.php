<?php
require 'initapp.php';
$self='add-new-administrator.php';
permission::permitted($self);

require ("views/$theme/add-new-administrator.tpl.php");
?>