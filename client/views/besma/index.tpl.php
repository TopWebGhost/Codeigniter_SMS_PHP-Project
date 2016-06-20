<?php
 $xheader="";
 $xfooter="";
 require ('theme/header.tpl.php');
?>

<div class="container-fluid" id="pcont">

    <div class="page-head">
        <h2><?php echo $Lan['DASHBOARD']; ?></h2>
    </div>

    <div class="cl-mcont">


        <div class="row dash-cols">
            <?php
            if($client['parent']=='0') {
                ?>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="block">
                        <div class="header">
                            <h2><i class="fa fa-ticket"></i><?php echo $Lan['TICKETS_INFO']; ?></h2>
                        </div>
                        <div class="content no-padding">
                            <div class="fact-data text-center">
                                <h3><?php echo $Lan['Active']; ?></h3>

                                <h2><?php echo $allactivetic; ?></h2>
                                <h4><a href="all-active-tickets.php">  <?php echo $Lan['View_All']; ?></a></h4>
                            </div>
                            <div class="fact-data text-center">
                                <h3><?php echo $Lan['Pending']; ?></h3>

                                <h2><?php echo $allpendingtic; ?></h2>
                                <h4><a href="all-pending-tickets.php">  <?php echo $Lan['View_All']; ?></a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="block">
                    <div class="header">
                        <h2><i class="fa fa-tasks"></i><?php echo $Lan['BULK_INFO']; ?></h2>
                    </div>
                    <div class="content no-padding">
                        <div class="fact-data text-center">
                            <h3><?php echo $Lan['Email_Send']; ?></h3>
                            <h2><?php echo $el; ?></h2>
                            <h4><a href="email-history.php">  <?php echo $Lan['View_All']; ?></a></h4>
                        </div>
                        <div class="fact-data text-center">
                            <h3><?php echo $Lan['SMS_Send']; ?></h3>
                            <h2><?php echo $sh; ?></h2>
                            <h4><a href="sms-history.php">  <?php echo $Lan['View_All']; ?></a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row dash-cols">
            <div class="col-sm-6 col-md-6">
                <div class="widget-block  white-box calendar-box">
                    <div class="col-md-6 blue-box calendar no-padding">
                        <div class="padding ui-datepicker"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="padding">
                            <h2 class="text-center"><?php echo $day; ?></h2>
                            <h1 class="day"><?php echo $date;?></h1>
                        </div>
                    </div>
                </div>


            </div>

            <?php
            if($client['parent']=='0') {
                ?>
                <div class="col-sm-6 col-md-6">
                    <div class="block">
                        <div class="header">
                            <h2><?php echo $Lan['RECENT_TICKETS']; ?></h2>

                        </div>
                        <div class="content no-padding ">
                            <ul class="items">
                                <?php
                                foreach ($ltickets as $st) {
                                    $status = $st['status'];

                                    ?>
                                    <li>
                                        <i class="fa fa-ticket"></i><?php echo $st['subject'];?>
                                        <span class="pull-right value">
                        <?php if ($status == 'Pending') {
                            ?>
                            <span class="label label-warning"><?php echo $Lan['Pending']; ?></span>
                        <?php
                        } elseif ($status == 'Answered') {
                            ?>
                            <span class="label label-info"><?php echo $Lan['Answered']; ?></span>
                        <?php
                        } elseif ($status == 'In Progress') {
                            ?>
                            <span class="label label-success"><?php echo $Lan['In_Progress']; ?></span>
                        <?php
                        } elseif ($status == 'Customer Reply') {
                            ?>
                            <span class="label label-primary"><?php echo $Lan['Customer_Reply']; ?></span>
                        <?php
                        } else {
                            ?>
                            <span class="label label-danger"><?php echo $status; ?></span>
                        <?php
                        }
                        ?>




                        </span>
                                        <small><?php echo $st['email']; ?></small>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>

                    </div>
                </div>
            <?php
            }
            ?>

        </div>

    </div>
</div>

<?php  require ('theme/footer.tpl.php'); ?>
