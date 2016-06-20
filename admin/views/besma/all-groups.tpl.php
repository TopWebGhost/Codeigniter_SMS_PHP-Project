<?php

$xheader="
<link rel=\"stylesheet\" href=\"views/besma/assets/js/jquery.niftymodals/css/component.css\" />
";

$xfooter='
<script src="views/besma/assets/js/jquery.datatables/jquery.datatables.min.js" type="text/javascript"></script>
    <script src="views/besma/assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js" type="text/javascript"></script>
    <script src="views/besma/assets/js/jquery.nestable/jquery.nestable.js" type="text/javascript"></script>
    <script src="views/besma/assets/js/jquery.niftymodals/js/jquery.modalEffects.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){

        App.dataTables();
         $(\'.md-trigger\').modalEffects();
      $(\'.dataTables_filter input\').addClass(\'form-control\').attr(\'placeholder\',\'Search\');
      $(\'.dataTables_length select\').addClass(\'form-control\');


      });

</script>
';
 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['All_Groups']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['All_Groups']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['All_Groups']; ?></h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['SL']; ?></th>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Name']; ?></th>
                                        <th class="center-align"><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $clgroup = ORM::for_table('accgroups')->order_by_asc('id')->find_many();
                                    $serial='0';
                                    if($clgroup->count()>0){
                                    foreach($clgroup as $value){
                                        $serial++;
                                        $gid=$value['id'];
                                        $gname=$value['groupname'];
                                    ?>

                                    <tr class="gradeA">
                                        <td><?php echo $serial; ?></td>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $gname; ?></td>
                                        <td  class="center-align">
                                            <a href="edit-client-group.php?_grpid=<?php echo $gid; ?>"  class="btn btn-primary btn-xs" ><i class="fa fa-edit"></i><?php echo $Lan['Edit']; ?> </a>
                                            <a href="delete-client-group.php?_grpid=<?php echo $gid; ?>"  class="btn btn-danger btn-xs" ><i class="fa fa-trash-o"></i><?php echo $Lan['Delete']; ?> </a>

                                        </td>
                                    </tr>
                                        <?php
                                    }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['Have_no_Client_Group']; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td  class="center-align"></td>

                                        <?php
                                    }
                                        ?>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

<?php  require ('theme/footer.tpl.php'); ?>