<?php
require 'initapp.php';
$self='add-new-administrator-role.php';
permission::permitted($self);

require ("views/$theme/add-new-administrator-role.tpl.php");

?>