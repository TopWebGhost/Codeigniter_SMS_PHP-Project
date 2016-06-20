<?php
require 'initapp.php';
$self='all-answerd-tickets.php';
permission::permitted($self);
require ("views/$theme/all-answered-tickets.tpl.php");
?>