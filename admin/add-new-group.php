<?php
require 'initapp.php';
$self='add-new-group.php';
permission::permitted($self);

require ("views/$theme/add-new-group.tpl.php");
?>