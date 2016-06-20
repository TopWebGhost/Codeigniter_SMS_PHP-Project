<?php
require 'initapp.php';
$self='create-new-ticket.php';
permission::permitted($self);

require ("views/$theme/create-new-ticket.tpl.php");

?>