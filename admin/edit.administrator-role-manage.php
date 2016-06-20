<?php
require 'initapp.php';
$self='administrator-role-manage.php';
$cmd = _get('_rid');


if(isset($_POST['edit'])){

    $rname=_post('rname');

    if ($cmd=='1'){
        conf($self."?_rid=$cmd",'e','You can\'t edit this role. This role is used for Super Admin');
    }

    if($rname==''){
         conf($self,'e','Please Insert Role Name');
    }

    $d = ORM::for_table('adminroles')->find_one($cmd);
    $d->name = $rname;
    $d->save();

    $perms = $_POST['perms'];

    $d = ORM::for_table('adminperms')->where_equal('roleid', $cmd)->delete_many();
    foreach ($perms as $perm){
        $d = ORM::for_table('adminperms')->create();
        $d->roleid = $cmd;
        $d->permid = $perm;
        $d->save();
    }

    conf($self."?_rid=$cmd",'s','Role Edited Successfully');
}

?>