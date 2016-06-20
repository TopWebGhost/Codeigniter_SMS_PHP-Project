<?php
require 'initapp.php';
$self='support-ticket-manage.php';
$cmd=_get('_stid');


$stm=ORM::for_table('tickets')->find_one($cmd);
$tic_id=$stm['id'];
$user_id=$stm['userid'];

$stadmin=ORM::for_table('admins')->find_one($aid);
$add_by=$stadmin['username'];


if (isset($_POST['submit'])){

$basefile=dirname('../assets/ticket_file/ticket_file/').'/';


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

 if($success) 
 {
         $pathname=$basefile.$name;
         $date= date('Y-m-d');
         $stmfile = ORM::for_table('ticket_file')->create();
         $stmfile->userid=$user_id;
         $stmfile->ticid=$tic_id;
         $stmfile->filename=$name;
         $stmfile->path=$pathname;
         $stmfile->addby=$add_by;
         $stmfile->date=$date;
         $stmfile->save(); 
         $stmid = $stmfile->id();

        conf("support-ticket-manage.php?_stid=$cmd",'s','File Add Successfully');
    }

 }
}
else{
          conf("support-ticket-manage.php?_stid=$cmd",'e','Please Upload File Again');

}


?>