<?php
require ('AppConfig.php');
$msg = 'Running SQL Update.... <br>';
$dbh = null;
$v = '1.0.4';
$latest = '1.0.5';
try {
    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$stmt = $dbh->prepare("select * from appconfig where setting='SoftwareVersion'");
$stmt->execute();
$result = $stmt->fetch();

$find=$result['value'];



if ($find=='1.0.5') {

    $v = '1.0.5';
    $msg .= 'It seems, your version is up to date for version 1.0.5 <br>';
} else {

    $msg .= 'Running update for Version 1.0.5 ..... <br>';

   $sql = <<<EOF

INSERT INTO `sms_gateway` (`id`, `name`, `api_link`, `username`, `password`, `api_id`, `schedule`, `status`) VALUES (NULL, 'CsNetworks', 'http://api.csnetworks.net', 'user', 'password', NULL, 'No', 'Active');
INSERT INTO `sms_gateway` (`id`, `name`, `api_link`, `username`, `password`, `api_id`, `schedule`, `status`) VALUES (NULL, 'Bulk SMS', 'http://bulksms.2way.co.za', 'john', 'abcd1234', NULL, 'No', 'Active');
INSERT INTO `sms_gateway` (`id`, `name`, `api_link`, `username`, `password`, `api_id`, `schedule`, `status`) VALUES (NULL, 'SMSC', 'http://smsc.i-digital-m.com', 'user', 'password', NULL, 'No', 'Active');
INSERT INTO `sms_gateway` (`id`, `name`, `api_link`, `username`, `password`, `api_id`, `schedule`, `status`) VALUES (NULL, 'Telenorcsms', 'https://telenorcsms.com.pk', 'xxxx', 'xxx', NULL, 'No', 'Active');
INSERT INTO `appconfig` (`id`, `setting`, `value`) VALUES (NULL, 'Client_Registration', '1');

UPDATE `appconfig` SET `value` = '1.0.5' WHERE `appconfig`.`id` = 6;

EOF;

$msg .= 'Importing SQL Data....... <br>';

// Execute SQL QUERY
$qr = $dbh->exec($sql);

$msg .= 'Data import Completed....... <br>';
$msg .= '===== Update Complete ======" <br>';
$msg .= 'If you refresh this page now, you should see this message- "Your Version is Up to Date!" <br>';

}

if ($v == $latest){
    echo 'Your Version is Up to Date!';
}

else{

    echo $msg;
}

?>