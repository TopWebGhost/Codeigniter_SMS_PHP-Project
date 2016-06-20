<?php
require ('initapp.php');
$self = 'system-settings.php#logo';
if ($xstage=='Demo'){
conf($self,'e','Changing Settings is disabled in the Demo Mode');
}


if (isset($_POST['submit'])){


 $basefile=dirname('../assets/uploads/uploads/').'/';


define("UPLOAD_DIR", "$basefile");

if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];


    if ($myFile["error"] !== UPLOAD_ERR_OK) {
    conf($self,'e',"An Error Occured");
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
    conf($self,'e',"Unable to Save File");
        exit;
    }
    if ($success) {
            $pathname=$basefile.$name;
            $conf = ORM::for_table('appconfig')->where('setting', 'logo')->find_one();
            $conf->set('value', $pathname);
            $conf->save();  

    conf($self,'s',"Logo Change Successfully");
    }
 
    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
}else{
     conf($self,'e',"Please Submit your Information Again");
}
}
?>