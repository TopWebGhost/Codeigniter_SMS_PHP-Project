<?php
require 'initapp.php';
$self='edit-client-group.php';
$cmd=_get('_grpid');
$clgr=ORM::for_table('accgroups')->where('parent',$cid)->find_one($cmd);

require ("views/$theme/edit-client-group.tpl.php");
?>