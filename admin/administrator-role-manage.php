<?php
require 'initapp.php';
$self='administrator-role-manage.php';
permission::permitted($self);
$roleid=_get('_rid');
$amq=ORM::for_table('adminroles')->find_one($roleid);
$rname=$amq['name'];

function permission ($roleid,$permid) {

    $permcheck = ORM::for_table('adminperms')->where('roleid', $roleid)->where('permid', $permid)->find_one();
    if (!$permcheck['permid']>0){
        return false;
    }
    return true;
}
require ("views/$theme/administrator-role-manage.tpl.php");

?>