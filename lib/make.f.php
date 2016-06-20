<?php
if (!defined("_APP_RUN"))
    die('Direct access to this location is not allowed.');
function make_csv ($query,$filename=''){
    global $dbh;
    if($filename==''){
        $filename=date('Y-m-d-H-i-s').'.csv';
    }
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result){

        header( 'Content-Type: text/csv' );
        header( 'Content-Disposition: attachment;filename='.$filename);

        if ($stmt->rowCount() > 0) {
            $fp = fopen('php://output', 'w');
            fputcsv($fp, array('id','First Name', 'Last Name', 'Company','Website','Email','Address','Address 2','State','City/Town','Zip Code','Country','Phone','Created Date','Default Email Gateway','Default Sms Gateway'));
            foreach($result as $value) {
                fputcsv($fp, $value);
            }
            return true;
        }
        else {

            return false;
        }
        fclose($fp);

    }
    else {
        return false;
    }
}

function make_pdf($title,$hstring,$style,$html){

$html = <<<EOT
$style
$html
EOT;


}