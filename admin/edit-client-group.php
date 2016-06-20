<?php
require 'initapp.php';
$self='edit-client-group.php';
permission::permitted($self);

$cmd=_get('_grpid');

$clgr=ORM::for_table('accgroups')->find_one($cmd);

require ("views/$theme/edit-client-group.tpl.php");
?>