<?php
require 'initapp.php';
$self='add-new-administrator-role.php';
if (isset($_POST['submit'])){

    $role_name = _post('r_name');
    if ($role_name==''){
        conf($self,'e','Role Name is Required.');
    }


    $d = ORM::for_table('adminroles')->create();
    $d->name= $role_name;
    $d->save();


    conf("administrators-role.php",'s','Administrator Role Add Successfully');
}
conf($self,'e','Please Try Again');

?>

