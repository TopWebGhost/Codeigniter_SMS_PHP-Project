<?php
require 'initapp.php';
$self='email-templates-manage.php';
permission::permitted($self);

$eid=_get('_eid');

$eres=ORM::for_table('email_templates')->find_one($eid);
$showportal=$eres['core'];

require ("views/$theme/email-templates-manage.tpl.php");

?>