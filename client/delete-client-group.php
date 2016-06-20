<?php
require 'initapp.php';
$self='all-groups.php';

$cmd=_get('_grpid');
$clgr=ORM::for_table('accgroups')->find_one($cmd);
$clgr->delete();

conf($self,'s','Client Group Delete Successfully');
?>