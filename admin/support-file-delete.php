<?php
require 'initapp.php';
$cmd = _get('_sfid');
$mbid= ORM::for_table('ticket_file')->find_one($cmd);
?>

<form  method="post" action="delete-support-file.php?_sfid=<?php echo $cmd; ?>">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Delete File</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <h2>Are You Want to Delete This File?</h2>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary"><i class="icon-remove"></i> No </button>
        <button type="submit" name="delete" class="btn btn-danger"><i class="icon-ok"></i> Yes</button>
    </div>
</form>