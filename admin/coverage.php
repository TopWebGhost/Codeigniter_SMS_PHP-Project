<?php
require 'initapp.php';
$self='coverage.php';
permission::permitted($self);
require ("views/$theme/coverage.tpl.php");
?>