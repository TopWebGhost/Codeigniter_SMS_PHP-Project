<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
    <script src="views/besma/assets/js/jquery.datatables/jquery.datatables.min.js" type="text/javascript"></script>
    <script src="views/besma/assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js" type="text/javascript"></script>
    <script src="views/besma/assets/js/jquery.nestable/jquery.nestable.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        App.dataTables();
        $(\'.dataTables_filter input\').addClass(\'form-control\').attr(\'placeholder\',\'Search\');
      $(\'.dataTables_length select\').addClass(\'form-control\');
      });
    </script>
    ';
 require '../lib/country.php';
 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Coverage']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Coverage']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>

            <div class="row">



                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['All_Coverage']; ?></h3>
                        </div>
                        <div class="content">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Country']; ?></th>
                                        <th><?php echo $Lan['ISO_Code']; ?></th>
                                        <th><?php echo $Lan['Country_Code']; ?></th>
                                        <th><?php echo $Lan['Tariff']; ?></th>
                                        <th><?php echo $Lan['Status']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $find_coverage = ORM::for_table('int_country_codes')->order_by_asc('country_name')->find_many();
                                    if($find_coverage->count()>0){
                                        foreach($find_coverage as $value){
                                            $status=$value['active'];
                                            ?>

                                            <tr class="gradeA">
                                                <td><?php echo $value['id']; ?></td>
                                                <td><?php echo $value['country_name']; ?></td>
                                                <td><?php echo $value['iso_code']; ?></td>
                                                <td><?php echo $value['country_code']; ?></td>
                                                <td><?php echo $value['tariff'].' '.appconfig('defaultcurrencysymbol'); ?></td>
                                                <td>
                                                    <?php
                                                    if($status=='1'){
                                                        ?>
                                                        <span class="label label-success"><?php echo $Lan['Live']; ?></span>
                                                    <?php
                                                    }else{
                                                        ?>
                                                        <span class="label label-danger"><?php echo $Lan['Offline']; ?></span>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td><a type="button" href="coverage-manage.php?_coid=<?php echo $value['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i><?php echo $Lan['Manage']; ?> </a></td>
                                            </tr>
                                        <?php
                                        }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['Have_No_SMS_Coverage']; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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