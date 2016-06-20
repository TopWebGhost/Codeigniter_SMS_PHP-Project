<?php
require 'initapp.php';

$alltic = ORM::for_table('tickets')->count();

$allactivetic = ORM::for_table('tickets')->where('status','In Progress')->where('userid',$cid)->find_many()->count();
$allpendingtic = ORM::for_table('tickets')->where('status','Pending')->where('userid',$cid)->find_many()->count();

$el = ORM::for_table('email_logs')->where_raw('(`userid` = ? OR `send_by` = ?)', array($cid, $cid))->find_many()->count();
$sh = ORM::for_table('sms_history')->where('userid',$cid)->find_many()->count();

$day=date('l');
$date=date('j');

$ltickets = ORM::for_table('tickets')->where('userid',$cid)->limit(4)->find_many();

require ("views/$theme/index.tpl.php");
?>