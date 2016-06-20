<?php
require 'initapp.php';
$self='add-new-client.php';
permission::permitted($self);

require ("views/$theme/add-new-client.tpl.php");
?>