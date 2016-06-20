<?php
require 'initapp.php';
$self='client-manage.php';
$cmd=_get('_id');
if ($xstage=='Demo'){
     conf("client-manage.php?_clid=$cmd",'e','Change Avatar is disabled in the demo mode');
}

if (isset($_POST['avatar'])){

 $basefile=dirname('../assets/profile/profile/').'/';

define("UPLOAD_DIR", "$basefile");

if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];


    if ($myFile["error"] !== UPLOAD_ERR_OK) {
    conf($self.'?_clid='.$cmd,'e',"An Error Occured");
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
    conf($self.'?_clid='.$cmd,'e',"Unable to Save File");
        exit;
    }
    if ($success) {
            $pathname=$basefile.$name;

            $aclient=ORM::for_table('accounts')->find_one($cmd);

            $aclient->image=$pathname;
            $aclient->save(); 
            $did = $aclient->id();

    conf($self.'?_clid='.$did,'s',"Avatar Change Successfully");
    }
 
    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
}else{
     conf($self.'?_clid='.$cmd,'e',"Please Submit your Information Again");
}
}
?>