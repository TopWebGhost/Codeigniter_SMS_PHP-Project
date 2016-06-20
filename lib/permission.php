<?php
$perms = array(
    1 => 'index.php',
    2 => 'all-clients.php',
    3 => 'add-new-client.php',
    4 => 'client-manage.php',
    5 => 'all-groups.php',
    6 => 'add-new-group.php',
    7 => 'edit-client-group.php',
    8 => 'send-bulk-email.php',
    9 => 'send-email-from-file.php',
    10 => 'email-history.php',
    11 => 'view-email.php',
    12 => 'send-bulk-sms.php',
    13 => 'send-sms-from-file.php',
    14 => 'sms-history.php',
    15 => 'view-sms.php',
    16 => 'sms-api-setup.php',
    17 => 'all-active-tickets.php',
    18 => 'all-pending-tickets.php',
    19 => 'all-answerd-tickets.php',
    20 => 'all-closed-tickets.php',
    21 => 'all-support-tickets.php',
    22 => 'create-new-ticket.php',
    23 => 'support-ticket-manage.php',
    24 => 'support-departments.php',
    25 => 'add-new-support-department.php',
    26 => 'support-department-manage.php',
    27 => 'administrators.php',
    28 => 'add-new-administrator.php',
    29 => 'administrator-manage.php',
    30 => 'administrators-role.php',
    31 => 'add-new-administrator-role.php',
    32 => 'administrator-role-manage.php',
    33 => 'system-settings.php',
    34 => 'email-templates.php',
    35 => 'email-templates-manage.php',
    36 => 'email-providers.php',
    37 => 'email-providers-manage.php',
    38 => 'sms-gateway.php',
    39 => 'sms-gateway-manage.php',
    40 => 'all-invoices.php',
    41 => 'create-new-invoice.php',
    42 => 'invoice-manage.php',
    43 => 'sms-price-plan.php',
    44 => 'add-sms-price-plan.php',
    45 => 'manage-price-plan.php',
    46 => 'add-price-plan-feature.php',
    47 => 'manage-sms-plan-feature.php',
    48 => 'view-price-plan-feature.php',
    49 => 'payment-gateways.php',
    50 => 'payment-gateway-manage.php',
    51 => 'send-schedule-sms.php',
    52 => 'send-schedule-sms-from-file.php',
    53 => 'coverage.php',
    54 => 'sender-id-manage.php'
);

Class permission {
    public static function permitted ($page) {
        global $perms;
        global $aid;
        $permid = array_search($page, $perms);

        $d = ORM::for_table('admins')->find_one($aid);
        $role = $d['roleid'];
        $permcheck = ORM::for_table('adminperms')->where('roleid', $role)->where('permid', $permid)->find_one();
        if (!$permcheck['permid']>0){
            conf('permission-notice.php','e','You do not have permission to view this page');
        }


    }

}

?>