<?php
require 'initapp.php';
$self='index.php';
permission::permitted($self);


$alltic = ORM::for_table('tickets')->count();
$allclient=ORM::for_table('accounts')->find_many();
$allclientcount=$allclient->count();

$allgroup=ORM::for_table('accgroups')->find_many();
$allgroupcount=$allgroup->count();

$allactivetic = ORM::for_table('tickets')->where('status','In Progress')->find_many()->count();
$allpendingtic = ORM::for_table('tickets')->where('status','Pending')->find_many()->count();

$el = ORM::for_table('email_logs')->find_many()->count();
$sh = ORM::for_table('sms_history')->find_many()->count();



$day=date('l');
$date=date('j');

$ltickets = ORM::for_table('tickets')->limit(4)->find_many();

require ("views/$theme/index.tpl.php");

?>
