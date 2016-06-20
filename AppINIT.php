<?php
if (!defined("_APP_RUN"))
    die('Direct access to this location is not allowed.');
define("BASEPATH", dirname(__FILE__));

$configFile = BASEPATH .DIRECTORY_SEPARATOR. "AppConfig.php";

if (file_exists($configFile)) {
    include($configFile);
} else {
    header("Location: ../install/");
}
try {
    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

$stmt = $dbh->prepare("select * from appconfig");
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $value)
{
    $config[$value['setting']]=$value['value'];
}


function prf(){
       return true;
}
function validation($value){
    $value = trim($value);
    $value=htmlentities($value, ENT_QUOTES, 'utf-8');
    return $value;
}


function _post($param,$defvalue = '') {
    if(!isset($_POST[$param])) 	{
        return $defvalue;
    }
    else {
        return validation($_POST[$param]);
    }
}


function _get($param,$defvalue = '')
{
    if(!isset($_GET[$param])) {
        return $defvalue;
    }
    else {
        return validation($_GET[$param]);
    }
}

function appconfig($v){
    global $config;
    $c = $config[$v];
    return $c;
}


function conf($to,$ntype='e',$msg=''){
    if($msg==''){
        header("location: $to"); exit;
    }
    $_SESSION['ntype']=$ntype ; $_SESSION['notify']=$msg ; header("location: $to"); exit;
}


function notify(){
    if(isset($_SESSION['notify'])) {
        $notify = $_SESSION['notify'];
        $ntype = $_SESSION['ntype'];
        if ($ntype=='s') {

            echo "<div class=\"alert alert-success alert-white rounded\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
		  <div class=\"icon\"><i class=\"fa fa-check\"></i></div>
		  <strong>Success!</strong> $notify
	</div>";
        }
        else {
            echo "<div class=\"alert alert-danger alert-white rounded\">
								<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
								<div class=\"icon\"><i class=\"fa fa-times-circle\"></i></div>
								<strong>Error!</strong> $notify
							 </div>";

        }
        unset($_SESSION['notify']);
        unset($_SESSION['ntype']);
    }
}

function _authenticate() {
    if(!isset($_SESSION['cid'])) {
        conf('../login.php');
    }
}


function curPageName() {
    return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}



function _log($type,$details,$userid='0') {
    global $dbh;
    $ip=$_SERVER['REMOTE_ADDR'];
    $stmt = $dbh->prepare("INSERT INTO  logs (date ,type ,description ,userid ,ip)
    VALUES (now(),  ?,  ?,  ?,  ?);");
    $stmt->execute(array($type,$details,$userid,$ip));
    return true;
}
//uid
function _raid($l){
    $r=  substr(str_shuffle(str_repeat('0123456789',$l)),0,$l);
    return $r;

}
//
//simple template engine
function _render($template,$data)
{

    foreach($data as $key => $value)
    {
        $template = str_replace('{{'.$key.'}}', $value, $template);
    }

    return $template;
}
function _encode ($string){
    $encoded = base64_encode(uniqid().$string);
    echo $encoded;

}
function _decode ($string){
    $decoded = base64_decode($string);
    $orig = substr($decoded, 13);
    return $orig;
}
//
$xstage = appconfig('appStage');
require 'lib/d.f.php';
//$xdatetime = date('Y-m-d H:i:s');
function emailLog($userid,$email,$subject,$message){
    $date = date('Y-m-d H:i:s');
    $d = ORM::for_table('email_logs')->create();
    $d->userid = $userid;
    $d->email = $email;
    $d->subject = $subject;
    $d->message = $message;
    $d->date = $date;
    $d->save();
    $id = $d->id();
    return $id;
}

//
$xheader='';
$xfooter='';
$url=curPageName();


$language=appconfig('adminlanguage');
$logo=appconfig('logo');
$bardname=appconfig('BrandName');
$WebsiteTitle=appconfig('WebsiteTitle');
$CompanyName=appconfig('CompanyName');
$Email_module=appconfig('email_perm');
$SMS_module=appconfig('sms_perm');



$language_file = 'language/'.appconfig('adminlanguage').'.php';
require ($language_file);

?>


