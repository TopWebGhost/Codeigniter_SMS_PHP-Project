<?php
require 'initapp.php';
$self='schedule-sms-send-from-file.php';

if (isset($_POST['submit'])){
    $sender_id=_post('sender_id');
    $message=_post('message');
    $sip = $_SERVER['REMOTE_ADDR'];
    $gateway=_post('gateway');
    $schedule=_post('schedule_time');

    if($sender_id==''){
        conf($self,'e','Please Insert Sender ID/ Masking Name');
    }
    if($message==''){
        conf($self,'e','Please Insert Message');
    }

    if($schedule==''){
        conf($self,'e','Please Insert Schedule Time');
    }

    $msgcount = strlen($message);
    $msgcount = $msgcount / 160;
    $msgcount = ceil($msgcount);

    if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
        $filename = basename($_FILES['uploaded_file']['name']);
        $ext = substr($filename, strrpos($filename, '.') + 1);
        if (($ext == "txt") &&  ($_FILES["uploaded_file"]["size"] < 1000000)) {
            $newname=_raid('10')."-".$filename;
            $newname = BASEPATH .DIRECTORY_SEPARATOR."assets/sms_file/".$newname;

            if (!file_exists($newname)) {

                if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {

                    $sms = file_get_contents($newname);

                    $file_sms = str_replace(" ", "", $sms);
                    #Remove any whitespace
                    $sms_result= trim($file_sms, "\r\n") ;
                    unlink($newname);
                } else {
                    exit ("An Error Occured");
                }
            } else {
                unlink($newname);
                exit ("File already exist with the same name");
            }

        }
        else { exit ("Invalid file type, Please go back and try again");}

    }
    $list = preg_split('/\r\n|\n|\r/', $sms_result);

    $listscount= count ($list) ;

    if ($listscount> 0) {

        if($gateway=='NibsSMS'){

            for($i = 0; $i < $listscount; $i++){
                @$clphone.=$list[$i].';' ;
            }

            $clphone=substr($clphone,0,-1);

            $nibtime=strtotime($schedule);

            $nibdate=date('Y-m-d');
            $nibhour=date('H:m:s');

            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            if($api_count=='1'){
                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];
                $country_code=$api_info['api_id'];


                $sip = $_SERVER['REMOTE_ADDR'];

                $api_request="<REQUEST>
		                                <RETURNTYPE>json</RETURNTYPE>
			                                    <USER>
				                                        <LOGIN>$user</LOGIN>
				                                        <APIKEY>$password</APIKEY>
			                                    </USER>

			                                     <REQUESTPARAM>
				                                        <METHOD>sendOrScheduleSMS</METHOD>
                                                                <PARAMS>
                                                                    <MESSAGE>$message</MESSAGE>
                                                                    <COUNTRY_ID>$country_code</COUNTRY_ID>
                                                                    <SENDER_NAME>$sender_id</SENDER_NAME>
                                                                    <DATA_TYPE>numbers</DATA_TYPE>

                                                                    <PHONE_NUMBERS>
                                                                        <NUMBER>$clphone</NUMBER>
                                                                    </PHONE_NUMBERS>



                                                                    <SCHEDULE>
			                                                                <NAME>$sender_id</NAME>
			                                                                <TIME>$nibhour</TIME>
			                                                                <DATES>
				                                                                    <DATE>$nibdate</DATE>
			                                                                </DATES>
			                                                         </SCHEDULE>

                                                                </PARAMS>
                                       			 </REQUESTPARAM>
		                                </REQUEST>";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $sms_url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml;charset=utf-8', 'Content-length: '.strlen($api_request)));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $api_request);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $return = curl_exec($ch);
                curl_close($ch);

                $result=explode(",",$return);


                $get_sms_status=$result['1'];

                $search=array("DESCRIPTION",":",'}','"');
                $get_sms_status=trim(str_replace($search,"",$get_sms_status));
            }else{
                conf($self,'e','Selected Gateway is Not Active');
            }
        }




            for($i = 0; $i < $listscount; $i++){
                $clphone = $list[$i] ;
                /*Api Integration Start Here*/

                /*For SMSGlobal SMS Gateway*/
                if($gateway=='SMSGlobal'){

                    $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
                    $clphone = str_replace('+', '', $clphone);

                    $sender_id=urlencode($sender_id);
                    $message=urlencode($message);

                    $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();

                    $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

                    if($api_count=='1'){
                        $sms_url=$api_info['api_link'];
                        $user=$api_info['username'];
                        $password=$api_info['password'];
                        $schedule_time=urlencode($schedule);
                        $sms_sent_to_user = "$sms_url" . "?action=sendsms" . "&user=$user" . "&password=$password" ."&from=$sender_id" . "&to=$clphone" . "&text=$message" . "&api=1"."&scheduledatetime=$schedule_time";

                        $get_sms_status=file_get_contents($sms_sent_to_user);
                        $get_sms_status = preg_replace("/[^0-9]/", '', $get_sms_status);

                        $find_status=strlen($get_sms_status);

                        $sip = $_SERVER['REMOTE_ADDR'];
                        $get_sms_status = str_replace("88", "Not enough credits", $get_sms_status);
                        $get_sms_status = str_replace("99", "Unknown error", $get_sms_status);
                        $get_sms_status = str_replace("100", "Incorrect username/password", $get_sms_status);
                        $get_sms_status = str_replace("300", "Missing MSISDN", $get_sms_status);
                        $get_sms_status = str_replace("750", "Invalid MSISDN", $get_sms_status);

                        if($find_status>8){
                            $get_sms_status=file_get_contents($sms_sent_to_user);
                        }
                    }
                    else{
                        conf($self,'e','Selected Gateway is Not Active');
                    }

                }


            }


        }


    for($i = 0; $i < $listscount; $i++){
        $client_phone = $list[$i] ;
        $sip = $_SERVER['REMOTE_ADDR'];
        $isms=ORM::for_table('sms_history')->create();
        $isms->userid='0';
        $isms->sender=$sender_id;
        $isms->receiver=$client_phone;
        $isms->amount=$msgcount;
        $isms->sms=$message;
        $isms->ip=$sip;
        $isms->send_by='0';
        $isms->save();
    }
    conf('sms-history.php','s','SMS Send Successfully');

    }


else{
          conf($self,'e','Please Enter Information Again');

}


?>