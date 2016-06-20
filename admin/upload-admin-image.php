<?php
require 'initapp.php';
$self='administrator-manage.php';
$cmd=_get('_id');

if ($xstage=='Demo'){
     conf("administrator-manage.php?_id=$cmd",'e','Change Avater is disabled in the demo mode');
}

if (isset($_POST['avatar'])){

$basefile=dirname('../assets/admin/admin/').'/';


define("UPLOAD_DIR", "$basefile");

if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];


    if ($myFile["error"] !== UPLOAD_ERR_OK) {
    conf($self.'?_id='.$cmd,'e',"An Error Occured");
        exit;
    }
 
    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    $i = 0;
    $parts = pathinfo($name);


    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];

    }
 
    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],UPLOAD_DIR . $name);

    if (!$success) { 
    conf($self.'?_id='.$cmd,'e',"Unable to Save File");
        exit;
    }
    if ($success) {
            $pathname=$basefile.$name;

            $aclient=ORM::for_table('admins')->find_one($cmd);
            $aclient->image=$pathname;
            $aclient->save(); 
            $did = $aclient->id();

    conf($self.'?_id='.$did.'#avatar','s',"Avatar Change Successfully");
    }
 
    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
}else{
     conf($self.'?_id='.$cmd.'#avatar/','e',"Please Submit your Information Again");
}
}
?>