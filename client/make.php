<?php
require 'initapp.php';

conf('index.php','s','Client Import Will be available From next Version');

exit;
require ('../lib/make.f.php');
$what = _get('_what');
$query = _get('__use__');
$query = _decode($query);
if ($what=='csv'){
    make_csv($query);
}

/*
 * blank page, as we do not know what to make
 */
else {
    return;
}