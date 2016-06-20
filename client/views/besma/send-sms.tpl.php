<?php

$xheader='

';
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>

        <script type="text/javascript">

        $(document).ready(function(){
    var $remaining = $(\'#remaining\'),
        $messages = $remaining.next();

    $(\'#message\').keyup(function(){
        var chars = this.value.length,
            messages = Math.ceil(chars / 160),
            remaining = messages * 160 - (chars % (messages * 160) || messages * 160);

        $remaining.text(remaining + \' characters\');
        $messages.text(messages + \' message(s)\');
    });
});


  </script>

';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Send_SMS']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Send_SMS']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Send_SMS']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="single-sms-send.php" method="post" accept-charset="UTF-8">


                                <div class="form-group">
                                    <label for="esubject" class="col-sm-3 control-label"><?php echo $Lan['Sender_ID']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control"  placeholder="<?php echo $Lan['Sender_ID']; ?>" name="sender_id" id="sender_id">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="esubject" class="col-sm-3 control-label"><?php echo $Lan['Receiver']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control"  placeholder="<?php echo $Lan['Receiver']; ?>" name="receiver" id="receiver">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $Lan['Message']; ?></label>
                                    <div class="col-sm-7">
                                        <textarea style="height:150px;" class="form-control" id="message" name="message"></textarea>
                                        <p><strong><span id="remaining"></span>
                                                <span id="messages"></span></strong></p>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="submit" ><?php echo $Lan['Send_SMS']; ?></button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

<?php  require ('theme/footer.tpl.php'); ?>