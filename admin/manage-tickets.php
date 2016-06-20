<?php
require 'initapp.php';
$self='support-ticket-manage.php';
$aself='all-support-tickets.php';

$action = _get('action');
if ($action=='delete') {
$tid = _get('_tid');

  if ($xstage=='Demo'){
conf($self.'?_stid=$tid','e','Deleteing Tickets is disabled in the demo mode');
}
else{
    $ticquery= ORM::for_table('tickets')->find_one($tid);
    $ticquery->delete();
    $ticquery = ORM::for_table('ticketreplies')->where_equal('tid', $tid)->delete_many();
    conf($aself,'s','Ticket deleted Successfully');
    }
}
elseif ($action=='close') {
$tid = _get('_tid');
$ticquery= ORM::for_table('tickets')->find_one($tid);
$ticquery->status='Closed';
$ticquery->save();
    conf($self.'?_stid='.$tid,'s','Ticket Marked as Closed');
    
}
else {
  $tid = _get('_tid');
  conf($self.'?_stid='.$tid,'e','No Action Performed');
}


    ?>