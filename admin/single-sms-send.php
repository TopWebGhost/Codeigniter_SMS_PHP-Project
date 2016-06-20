<?php
require 'initapp.php';
$self='client-manage.php';

$cmd=_get('_clid');

if (isset($_POST['submit'])){
    $sender_id=_post('sender_id');
    $message=$_POST['message'];
    $sip = $_SERVER['REMOTE_ADDR'];

    if($sender_id==''){
        conf($self.'?_clid='.$cmd,'e','Please Insert Sender ID/ Masking Name');
    }
    if($message==''){
        conf($self.'?_clid='.$cmd,'e','Please Insert Message');
    }

    $gateway=_post('gateway');

    $query = "SELECT id,name, phone FROM accounts WHERE id='$cmd'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $clquery = $stmt->fetch();

    $msgcount = strlen($message);
    $msgcount = $msgcount / 160;
    $msgcount = ceil($msgcount);

    if ($stmt->rowCount() > 0) {
              $clphone=$clquery['phone'];

        /*Api Integration Start Here*/

        /*For Twilio SMS Gateway*/




        if($gateway=='Twilio'){
            $twilio_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $twilio_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            $xstage=appconfig('appStage');

            if($xstage!='Demo'){

                if($twilio_count=='1'){
                    $sip = $_SERVER['REMOTE_ADDR'];
                    require_once('../lib/sms_gateway/twilio-php/Services/Twilio.php');
                    $account_sid=$twilio_info['username'];
                    $auth_token=$twilio_info['password'];
                    try{

                        $url = "https://api.twilio.com/2010-04-01/Accounts/$account_sid/SMS/Messages.json";
                        $data = array (
                            'From' => $sender_id,
                            'To' => $clphone,
                            'Body' => $message,

                        );
                        $post = http_build_query($data);
                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        curl_setopt($curl, CURLOPT_USERPWD, "$account_sid:$auth_token");
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
                        $response = curl_exec($curl);
                        curl_close($curl);

                        $result=explode(",",$response);

                        $get_sms_status=$result['1'];


                        $search=array("message",":",'"');

                        $get_sms_status=trim(str_replace($search,"",$get_sms_status));
                    }catch (Exception $e){
                        $get_sms_status="Unknown Error";
                    }
                }
                else{
                    conf($self,'e','Selected Gateway is Not Active');
                }
            }
            else{
                $get_sms_status='Not Send In demo Mode';
            }
        }


        if($gateway=='TelAPI'){
            $telapi_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $telapi_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            $xstage=appconfig('appStage');

            if($xstage!='Demo'){
                if($telapi_count=='1'){
                    $sip = $_SERVER['REMOTE_ADDR'];
                    $account_sid=$telapi_info['username'];
                    $auth_token=$telapi_info['password'];
                    $response_to_array = false;
                    require_once '../lib/sms_gateway/telapi/library/TelApi.php';
                    $telapi = TelApi::getInstance();
                    $telapi -> setOptions(array(
                        'account_sid'       => $account_sid,
                        'auth_token'        => $auth_token,
                        'response_to_array' => $response_to_array
                    ));

                    try {

                        # NOTICE: The code below will send a new SMS message.

                        # TelApi_Helpers::filter_e164 is a internal wrapper helper to help you work with phone numbers and their formatting
                        # For more information about E.164, please visit: http://en.wikipedia.org/wiki/E.164

                        $sms_message = $telapi->create('sms_messages', array(
                            'From' =>$sender_id,
                            'To'   => $clphone,
                            'Body' => $message
                        ));

                        $get_sms_status=$sms_message->sid;

                    } catch (TelApi_Exception $e) {
                        $get_sms_status=$e->getMessage() . "\n";
                    }
                }
                else{
                    conf($self.'?_clid='.$cmd,'e','Selected Gateway is Not Active');
                }
            }
            else{
                $get_sms_status='Not Send In demo Mode';
            }
        }

        /*For Clickatell SMS Gateway*/

        if($gateway=='Clickatell'){

            $sender_id=urlencode($sender_id);


            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();
            if($api_count=='1'){
                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];
                $api_id=$api_info['api_id'];

                $url = "$sms_url/http/auth?user=$user&password=$password&api_id=$api_id";

                $ret = file($url);

                $sess = explode(":",$ret[0]);
                if ($sess[0] == "OK") {
                    $sess = explode(":",$ret[0]);
                    $sess_id = trim($sess[1]); // remove any whitespace

                    $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
                    $clphone = str_replace('+', '', $clphone);

                    $url = "$sms_url/http/sendmsg?session_id=$sess_id&to=$clphone&mo=1&text=".urlencode($message);
                    // do sendmsg call
                    $ret = file($url);
                    $send = explode(":",$ret[0]);
                    if ($send[0] == "ID") {
                        $msg_id=$send[1];
                        $get_sms_status="Success";
                    } else {
                        $get_sms_status="Failed";
                    }
                } else {
                    $get_sms_status=$ret[0];
                }

                $sip = $_SERVER['REMOTE_ADDR'];


            }else{
                conf($self,'e','Selected Gateway is Not Active');
            }
        }

        /*For SMSKaufen SMS Gateway*/
        if($gateway=='SMSKaufen'){

            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            if($api_count=='1'){
                $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
                $clphone = str_replace('+', '', $clphone);

                $sender_id=urlencode($sender_id);
                $message=urlencode($message);

                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];
                $api_id=$api_info['api_id'];

                $sms_sent_to_user = "$sms_url" . "?type=4" . "&id=$user" . "&apikey=$password" ."&empfaenger=$clphone" . "&absender=$sender_id" . "&text=$message";
                $get_sms_status=file_get_contents($sms_sent_to_user);


                $sip = $_SERVER['REMOTE_ADDR'];
                $get_sms_status = str_replace("100", "Success", $get_sms_status);
                $get_sms_status = str_replace("101", "Success", $get_sms_status);
                $get_sms_status = str_replace("111", "What IP blocked", $get_sms_status);
                $get_sms_status = str_replace("112", "Incorrect login data", $get_sms_status);
                $get_sms_status = str_replace("120", "Sender field is empty", $get_sms_status);
                $get_sms_status = str_replace("121", "Gateway field is empty", $get_sms_status);
                $get_sms_status = str_replace("122", "Text is empty", $get_sms_status);
                $get_sms_status = str_replace("123", "Recipient field is empty", $get_sms_status);
                $get_sms_status = str_replace("129", "Wrong sender", $get_sms_status);
                $get_sms_status = str_replace("130", "Gateway Error", $get_sms_status);
                $get_sms_status = str_replace("131", "Wrong number", $get_sms_status);
                $get_sms_status = str_replace("132", "Mobile phone is off", $get_sms_status);
                $get_sms_status = str_replace("133", "Query not possible", $get_sms_status);
                $get_sms_status = str_replace("134", "Number invalid", $get_sms_status);
                $get_sms_status = str_replace("140", "No credit", $get_sms_status);
                $get_sms_status = str_replace("150", "SMS blocked", $get_sms_status);
                $get_sms_status = str_replace("170", "Date wrong", $get_sms_status);
                $get_sms_status = str_replace("171", "Date too old", $get_sms_status);
                $get_sms_status = str_replace("172", "Too many numbers", $get_sms_status);
                $get_sms_status = str_replace("173", "Format wrong", $get_sms_status);
                $get_sms_status = str_replace(",", " ", $get_sms_status);
            }
            else{
                conf($self,'e','Selected Gateway is Not Active');
            }


        }

        /*For Route SMS Gateway*/
        if($gateway=='Route SMS'){

            $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
            $clphone = str_replace('+', '', $clphone);

            $sender_id=urlencode($sender_id);
            $message=urlencode($message);
            $clphone=urlencode($clphone);

            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            if($api_count=='1'){
                $xstage=appconfig('appStage');

                if($xstage!='Demo'){

                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];

                $sms_sent_to_user = "$sms_url" . "?type=0" . "&username=$user" . "&password=$password" ."&destination=$clphone" . "&source=$sender_id" . "&message=$message" . "&dlr=1";
                $get_sms_status=file_get_contents($sms_sent_to_user);
                $sip = $_SERVER['REMOTE_ADDR'];
                $get_sms_status = str_replace("1701", "Success", $get_sms_status);
                $get_sms_status = str_replace("1709", "User Validation Failed", $get_sms_status);
                $get_sms_status = str_replace("1025", "Insufficient Credit", $get_sms_status);
                $get_sms_status = str_replace("1710", "Internal Error", $get_sms_status);
                $get_sms_status = str_replace("1706", "Invalid receiver", $get_sms_status);
                $get_sms_status = str_replace("1705", "Invalid SMS", $get_sms_status);
                $get_sms_status = str_replace("1707", "Invalid sender", $get_sms_status);
                $get_sms_status = str_replace(",", " ", $get_sms_status);

                }
                else{
                    $get_sms_status='Not Send In demo Mode';
                }


            }
            else{
                conf($self,'e','Selected Gateway is Not Active');
            }

        }

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

                $sms_sent_to_user = "$sms_url" . "?action=sendsms" . "&user=$user" . "&password=$password" ."&from=$sender_id" . "&to=$clphone" . "&text=$message" . "&api=1";

                $get_sms_status=file_get_contents($sms_sent_to_user);
                $get_sms_status = preg_replace("/[^0-9]/", '', $get_sms_status);

                $sip = $_SERVER['REMOTE_ADDR'];
                $get_sms_status = str_replace("88", "Not enough credits", $get_sms_status);
                $get_sms_status = str_replace("99", "Unknown error", $get_sms_status);
                $get_sms_status = str_replace("100", "Incorrect username/password", $get_sms_status);
                $get_sms_status = str_replace("300", "Missing MSISDN", $get_sms_status);
                $get_sms_status = str_replace("750", "Invalid MSISDN", $get_sms_status);
            }
            else{
                conf($self,'e','Selected Gateway is Not Active');
            }

        }

        /*For Nexmo SMS Gateway*/
        if($gateway=='Nexmo'){

            $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
            $clphone = str_replace('+', '', $clphone);

            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            if($api_count=='1'){


                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];

                $sender_id=urlencode($sender_id);
                $sms_sent_to_user = "$sms_url" . "?api_key=$user" . "&api_secret=$password" ."&from=$sender_id" . "&to=$clphone" . "&text=".urlencode($message);

                $get_sms_status=file_get_contents($sms_sent_to_user);

                if (strpos($get_sms_status,'<status>0</status>') !== false) {
                    $get_sms_status='Success';
                }elseif(strpos($get_sms_status,'<status>1</status>') !== false){
                    $get_sms_status='Throttled';
                }elseif(strpos($get_sms_status,'<status>2</status>') !== false){
                    $get_sms_status='Missing params';
                }elseif(strpos($get_sms_status,'<status>3</status>') !== false){
                    $get_sms_status='Invalid params';
                }elseif(strpos($get_sms_status,'<status>4</status>') !== false){
                    $get_sms_status='Invalid credentials';
                }elseif(strpos($get_sms_status,'<status>5</status>') !== false){
                    $get_sms_status='Internal error';
                }elseif(strpos($get_sms_status,'<status>6</status>') !== false){
                    $get_sms_status='Invalid message';
                }elseif(strpos($get_sms_status,'<status>7</status>') !== false){
                    $get_sms_status='Number barred';
                }elseif(strpos($get_sms_status,'<status>8</status>') !== false){
                    $get_sms_status='Partner account barred';
                }elseif(strpos($get_sms_status,'<status>9</status>') !== false){
                    $get_sms_status='Partner quota exceeded';
                }elseif(strpos($get_sms_status,'<status>11</status>') !== false){
                    $get_sms_status='Account not enabled for REST';
                }elseif(strpos($get_sms_status,'<status>12</status>') !== false){
                    $get_sms_status='Message too long';
                }elseif(strpos($get_sms_status,'<status>13</status>') !== false){
                    $get_sms_status='Communication Failed';
                }elseif(strpos($get_sms_status,'<status>14</status>') !== false){
                    $get_sms_status='Invalid Signature';
                }elseif(strpos($get_sms_status,'<status>15</status>') !== false){
                    $get_sms_status='Invalid sender address';
                }elseif(strpos($get_sms_status,'<status>16</status>') !== false){
                    $get_sms_status='Invalid TTL';
                }elseif(strpos($get_sms_status,'<status>19</status>') !== false){
                    $get_sms_status='Facility not allowed';
                }elseif(strpos($get_sms_status,'<status>20</status>') !== false){
                    $get_sms_status='Invalid Message class';
                }else{
                    $get_sms_status='Unknown Error';
                }

                $sip = $_SERVER['REMOTE_ADDR'];
            }else{
                conf($self,'e','Selected Gateway is Not Active');
            }
        }

        /*For Kapow SMS Gateway*/

        if($gateway=='Kapow'){

            $sender_id=urlencode($sender_id);
            $message=urlencode($message);
            $clphone=urlencode($clphone);

            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            if($api_count=='1'){
                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];

                $posturl = "$sms_url" . "?username=$user" . "&password=$password" ."&mobile=$clphone" . "&sms=$message";

                // check if non-compulsory items are in use, add to string if so
                if($sender_id!=''){
                    $posturl.='&from_id='.$sender_id;
                }


                // attempt to post message
                $handle=fopen($posturl,'r') or die('Unable to open URL');
                $response=stream_get_contents($handle);

                // return reponse
                if(strstr($response,'OK')){
                    $get_sms_status="Success";
                }
                if($response=='USERPASS'){
                    $get_sms_status="Your credentials are incorrect";
                }

                if($response=='ERROR'){
                    $get_sms_status="Error";
                }
                if($response=='NOCREDIT')
                    $get_sms_status="You have no credits remaining";
            }else{
                conf($self,'e','Selected Gateway is Not Active');
            }

            $sip = $_SERVER['REMOTE_ADDR'];

        }

        if($gateway=='NibsSMS'){

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



        if($gateway=='InfoBip'){
            $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
            $clphone = str_replace('+', '', $clphone);

            $infobip_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $infobip_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            $xstage=appconfig('appStage');

            if($infobip_count=='1'){
                $sip = $_SERVER['REMOTE_ADDR'];
                $sms_url=$infobip_info['api_link'];
                $username=$infobip_info['username'];
                $password=$infobip_info['password'];

                $clphone=urlencode($clphone);
                $message=urlencode($message);
                $sms_sent_to_user = "$sms_url" . "?user=$username" . "&password=$password" ."&sender=$sender_id" . "&GSM=$clphone" . "&SMSText=$message"."&type=longSMS"."&datacoding=8";
                $get_sms_status=file_get_contents($sms_sent_to_user);

                if (strpos($get_sms_status,'<status>0</status>') !== false) {
                    $get_sms_status='Success';
                }elseif(strpos($get_sms_status,'<status>-1</status>') !== false){
                    $get_sms_status='Error in processing the request';
                }elseif(strpos($get_sms_status,'<status>-2</status>') !== false){
                    $get_sms_status='Not enough credits on a specific account';
                }elseif(strpos($get_sms_status,'<status>-3</status>') !== false){
                    $get_sms_status='Targeted network is not covered on specific account';
                }elseif(strpos($get_sms_status,'<status>-5</status>') !== false){
                    $get_sms_status='Username or password is invalid';
                }elseif(strpos($get_sms_status,'<status>-6</status>') !== false){
                    $get_sms_status='Destination address is missing in the request';
                }elseif(strpos($get_sms_status,'<status>-10</status>') !== false){
                    $get_sms_status='Username is missing in the request';
                }elseif(strpos($get_sms_status,'<status>-11</status>') !== false){
                    $get_sms_status='Password is missing in the request';
                }elseif(strpos($get_sms_status,'<status>-13</status>') !== false){
                    $get_sms_status='Number is not recognized by Infobip platform';
                }elseif(strpos($get_sms_status,'<status>-22</status>') !== false){
                    $get_sms_status='Incorrect XML format, caused by syntax error';
                }elseif(strpos($get_sms_status,'<status>-23</status>') !== false){
                    $get_sms_status='General error, reasons may vary';
                }elseif(strpos($get_sms_status,'<status>-26</status>') !== false){
                    $get_sms_status='General API error, reasons may vary';
                }elseif(strpos($get_sms_status,'<status>-27</status>') !== false){
                    $get_sms_status='Invalid scheduling parametar';
                }elseif(strpos($get_sms_status,'<status>-28</status>') !== false){
                    $get_sms_status='Invalid PushURL in the request';
                }elseif(strpos($get_sms_status,'<status>-30</status>') !== false){
                    $get_sms_status='Invalid APPID in the request';
                }elseif(strpos($get_sms_status,'<status>-33</status>') !== false){
                    $get_sms_status='Duplicated MessageID in the request';
                }elseif(strpos($get_sms_status,'<status>-34</status>') !== false){
                    $get_sms_status='Sender name is not allowed';
                }elseif(strpos($get_sms_status,'<status>-99</status>') !== false){
                    $get_sms_status='Error in processing request, reasons may vary';
                }else{
                    $get_sms_status='Unknown Error';
                }
            }
                else{
                    conf($self.'?_clid='.$cmd,'e','Selected Gateway is Not Active');
                }

        }




        /*For RANNH SMS Gateway*/
        if($gateway=='RANNH'){

            $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
            $clphone = str_replace('+', '', $clphone);

            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            if($api_count=='1'){
                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];

                $sender_id=urlencode($sender_id);
                $sms_sent_to_user = "$sms_url" . "?user=$user" . "&password=$password" ."&numbers=$clphone" . "&sender=$sender_id" . "&message=".urlencode($message) . "&lang=en";

                $get_sms_status=file_get_contents($sms_sent_to_user);


                $tr_err='0:'.$clphone;
                $success='1:'.$clphone;

                if($get_sms_status==$success){
                    $get_sms_status='Sent Successfully';
                }elseif($get_sms_status==$tr_err){
                    $get_sms_status='Transmission error';
                }else{
                }
                $sip = $_SERVER['REMOTE_ADDR'];
            }else{
                conf($self,'e','Selected Gateway is Not Active');
            }
        }


        /*For CS Networks*/
        if($gateway=='CsNetworks'){

            $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
            $clphone = str_replace('+', '', $clphone);

            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            if($api_count=='1'){
                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];

                $sender_id=urlencode($sender_id);
                $url = "$sms_url" . ":9011/bin/send?USERNAME=$user" . "&PASSWORD=$password" ."&DESTADDR=$clphone" ."&MESSAGE=".urlencode($message);

                $ret = file($url);
                $send = explode(":",$ret[0]);

                if ($send[0]) {
                   $get_sms_status= $send[0];
                }
                else{
                    $get_sms_status='Failed';
                }


                $sip = $_SERVER['REMOTE_ADDR'];
            }else{
                conf($self,'e','Selected Gateway is Not Active');
            }


        }

      /*For Bulk SMS*/
        if($gateway=='Bulk SMS'){

            $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
            $clphone = str_replace('+', '', $clphone);

            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            if($api_count=='1'){
                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];

                $sender_id=urlencode($sender_id);
                $url = "$sms_url" . "/eapi/submission/send_sms/2/2.0?username=$user" . "&password=$password" ."&msisdn=$clphone" ."&message=".urlencode($message);
                $ret = file_get_contents($url);


                $send = explode("|",$ret);

                if ($send[0]=='0') {
                   $get_sms_status= 'In progress';
                }elseif($send[0]=='1'){
                    $get_sms_status= 'Scheduled ';
                }elseif($send[0]=='22'){
                    $get_sms_status= 'Internal fatal error ';
                }elseif($send[0]=='23'){
                    $get_sms_status= 'Authentication failure';
                }elseif($send[0]=='24'){
                    $get_sms_status= 'Data validation failed';
                }elseif($send[0]=='25'){
                    $get_sms_status= 'You do not have sufficient credits';
                }elseif($send[0]=='26'){
                    $get_sms_status= 'Upstream credits not available';
                }elseif($send[0]=='27'){
                    $get_sms_status= 'You have exceeded your daily quota';
                }elseif($send[0]=='28'){
                    $get_sms_status= 'Upstream quota exceeded';
                }elseif($send[0]=='40'){
                    $get_sms_status= 'Temporarily unavailable';
                }elseif($send[0]=='201'){
                    $get_sms_status= 'Maximum batch size exceeded';
                }elseif($send[0]=='200'){
                    $get_sms_status= 'Success';
                }
                else{
                    $get_sms_status='Failed';
                }


                $sip = $_SERVER['REMOTE_ADDR'];
            }else{
                conf($self,'e','Selected Gateway is Not Active');
            }


        }


      /*For SMSC*/
        if($gateway=='SMSC'){

            $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
            $clphone = str_replace('+', '', $clphone);

            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            if($api_count=='1'){
                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];

                $sender_id=urlencode($sender_id);
                $url = "$sms_url" . "/smsgw/sendunicode.php?user=$user" . "&password=$password". "&sender=$sender_id" ."&recipients=$clphone" ."&message=".urlencode($message). "&dlr=1";
                $get_sms_status = file_get_contents($url);

                $sip = $_SERVER['REMOTE_ADDR'];
            }else{
                conf($self,'e','Selected Gateway is Not Active');
            }


        }


      /*For Telenorcsms*/
        if($gateway=='Telenorcsms'){

            $clphone = str_replace(" ", "", $clphone); #Remove any whitespace
            $clphone = str_replace('+', '', $clphone);

            $api_info=ORM::for_table('sms_gateway')->where('name',$gateway)->find_one();
            $api_count=ORM::for_table('sms_gateway')->where('name',$gateway)->where('status','Active')->count();

            if($api_count=='1'){
                $sms_url=$api_info['api_link'];
                $user=$api_info['username'];
                $password=$api_info['password'];

                $sender_id=urlencode($sender_id);

                $get_session=$sms_url.":27677/corporate_sms2/api/auth.jsp?msisdn=".$user."&password=".$password;
                $get_sms_status = file_get_contents($get_session);

                $xml = simplexml_load_string($get_sms_status);
                $json = json_encode($xml);
                $array = json_decode($json,TRUE);


                if (strpos($get_sms_status,'<data>Error 200</data>') !== false) {
                    $get_sms_status='Username and password do not match';
                }elseif(strpos($get_sms_status,'<data>201</data>') !== false){
                    $get_sms_status='Unknown MSISDN';
                }elseif(strpos($get_sms_status,'<data>100</data>') !== false){
                    $get_sms_status='Out of credit.';
                }elseif(strpos($get_sms_status,'<data>101</data>') !== false){
                    $get_sms_status='Field or input parameter missing';
                }elseif(strpos($get_sms_status,'<data>102</data>') !== false){
                    $get_sms_status='Invalid credentials';
                }elseif(strpos($get_sms_status,'<data>103</data>') !== false){
                    $get_sms_status='Invalid Mask';
                }elseif(strpos($get_sms_status,'<data>211</data>') !== false){
                    $get_sms_status='Unknown Message ID';
                }elseif(strpos($get_sms_status,'<data>300</data>') !== false){
                    $get_sms_status='Account has been blocked';
                }elseif(strpos($get_sms_status,'<data>400</data>') !== false){
                    $get_sms_status='Duplicate list name';
                }elseif(strpos($get_sms_status,'<data>502</data>') !== false){
                    $get_sms_status='SMS text is missing';
                }elseif(strpos($get_sms_status,'<data>702<datas>') !== false){
                    $get_sms_status='Invalid value for max retries';
                }elseif(strpos($get_sms_status,'<data>703<datas>') !== false){
                    $get_sms_status='Invalid value for Call Id';
                }elseif($array['response']!='Error'){
                    $get_sms_status='Success';
                }else{
                    $get_sms_status='Unknown Error';
                }


                if($get_sms_status=='Success'){
                    $session_id=$array['data'];
                    $url = "$sms_url" . ":27677/corporate_sms2/api/sendsms.jsp?session_id=$session_id" . "&to=$clphone". "&mask=$sender_id" ."&text=".urlencode($message);

                    $output=file_get_contents($url);

                    $fxml = simplexml_load_string($output);
                    $fjson = json_encode($fxml);
                    $farray = json_decode($fjson,TRUE);
                    if($farray['command']=='Submit_SM' AND $farray['response']=='OK'){
                        $get_sms_status=$farray['data'];
                    }

                }

                $sip = $_SERVER['REMOTE_ADDR'];
            }else{
                conf($self,'e','Selected Gateway is Not Active');
            }


        }




        $isms=ORM::for_table('sms_history')->create();
        $isms->userid=$cmd;
        $isms->sender=$sender_id;
        $isms->receiver=$clphone;
        $isms->amount=$msgcount;
        $isms->sms=$message;
        $isms->ip=$sip;
        $isms->report=$get_sms_status;
        $isms->send_by='0';
        $isms->save();

    }

    conf($self.'?_clid='.$cmd,'s','Please Check SMS History');
    }


else{
          conf($self.'?_clid='.$cmd,'e','Please Enter Information Again');

}


?>