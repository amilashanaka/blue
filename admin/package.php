<?php
include_once './top_header.php';
include_once 'data/data_package.php';


?>
<body class="hold-transition sidebar-mini">
<?php

if (isset($_GET['error'])) {
    $error = base64_decode($_GET['error']);

    if (isset($_GET['info'])) {

        $info = base64_decode($_GET['info']);


        echo '<script>  update_message("'.$info.'");</script>';
    }else{

        echo '<script>  error_by_code('.$error.');</script>';
    }


}

?>


<div class="wrapper">
    <!-- Navbar -->
    <?php include_once './navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include_once './sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php
        $t1 = $lang['Package'];
        $t2 = $lang['Details'];
        if ($pk_id == 0) {
            $t2 = $lang['New'] . " " . $t1;
        } else {

            $t2 = $lang['Update Package'];
        }
        include_once './page_header.php';
        ?>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">


                            <div class="card-body">
                                <div >
                                    <form action="data/register_package.php" class="templatemo-login-form" method="post" enctype="multipart/form-data" name="update_vehicles">
                                        <?php
                                        if ($pk_id == 0) {

                                            echo '<input type="hidden" name="action" value="register">';
                                            echo '<input type="hidden" name="pk_created_dt" value="' . $today . '">';
                                            echo '<input type="hidden" name="pk_created_by" value="' . $user_act . '">';
                                        } else {

                                            echo ' <input type="hidden" name="action" value="update">';
                                            echo ' <input type="hidden" name="pk_id" value="' . $pk_id . '">';
                                            echo '<input type="hidden" name="pk_updated_dt" value="' . $today . '">';
                                            echo '<input type="hidden" name="pk_updated_by" value="' . $user_act . '">';
                                        }
                                        ?>


                                        <div class="col-lg-12 col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="row form-group">
                                                        <div class="form-group" style="">
                                                            <div class="user_image">
                                                                <?php if ($row['pk_img'] == '') { ?>
                                                                    <img name="pk_img" id="pk_img"  src="img/pkg.png" class="bg-transparent profile_image" style="max-height:150px;width:auto">
                                                                <?php } else { ?>
                                                                    <img name="pk_img" id="pk_img"  src="<?= $row['pk_img']; ?>" class="transparent profile_image" style="max-height:150px;width:auto">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="file" name="pk_img_file" id="pk_img_file" class="form-control"  placeholder="Username" aria-describedby="inputGroupPrepend" style="display: none;align-content: center" />
                                                        <input type="button" style="width: 30%;" value="Browse" id="browse_image" class="btn btn-block btn-success"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 ">
                                                    <div class="row form-group">

                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Package Name'] ?></label>
                                                            <input type="text" class="form-control" id="pk_name"   name="pk_name" value="<?php echo $row['pk_name']; ?>"  required>
                                                        </div>
                            
                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Package Amount'] ?></label>
                                                            <input type="text" class="form-control" id="pk_amount" placeholder="0.00" name="pk_amount" value="<?php echo printAmount($row['pk_amount']); ?>" >
                                                        </div>


                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Package Cost'] ?></label>
                                                            <input type="text" class="form-control" id="pk_cost" placeholder="0.00" name="pk_cost" value="<?php echo  printAmount($row['pk_cost']); ?>" >
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Package Discount'] ?></label>
                                                            <input type="text" class="form-control" id="pk_discount" placeholder="0.00" name="pk_discount" value="<?php echo  printAmount($row['pk_discount']); ?>" >
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Package Expire date'] ?></label>
                                                            <input type="date" class="form-control" id="pk_exp_date" placeholder="0.00" name="pk_exp_date" value="<?php echo  printAmount($row['pk_exp_date']); ?>" >
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Package Quantity'] ?></label>
                                                            <input type="text" class="form-control" id="pk_qty" placeholder="0" name="pk_qty" value="<?php echo  printAmount($row['pk_qty']); ?>" >
                                                        </div>






                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="text-divider"><span><?= $lang['Details'] ?></span></h5>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 form-group">
                                                <label><?= $lang['Description'] ?> :</label>
                                                <textarea type="text" class="form-control  summernote" id="pk_desc"  name="pk_desc" value="<?php echo $row['pk_desc']; ?>" ><?php echo $row['pk_desc']; ?></textarea>
                                            </div>



                                        </div>

                                        <hr>
                                        <?php
                                            if ($pk_id != '') {
                                                include_once 'data/data_package_item.php';?>
                                               
                                         <div class="col-lg-12 col-md-12 form-group">
                                            <div id="main" class="card-body">
                                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Code</th>
                                                    <th><?= $lang['Name'] ?></th>
                                                    <th>Qty</th>
                                                    <!--<th>Sub Total</th>-->
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php
                                                $i = 1;
                                                $tot=0;
                                                while ($row = mysqli_fetch_assoc($result_adon_list)) {
                                                    if($row['p_id']>0){
                                                        $name=get_product_name($row['p_id'],$conn);
                                                        $item_code=get_product_code($row['p_id'],$conn);
                                                    }else{
                                                
                                                        $name=get_service_nsme($row['s_id'],$conn);
                                                        $item_code=get_service_code($row['s_id'],$conn);
                                                    }
                                                   
                                                     ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                       <td><?= $item_code ?></td>
                                                        <td><?= $name ?></td>
                                                        <td><?= $row['int_qty'] ?></td>
                                                       
                                                    </tr>
                                                <?php } ?>



                                                </tbody>

                                              
                                            </table>
                                        </div>
                                    </div>


                                           <?php } ?>

                                        



                                        <div  class="row form-group">
                                            <div class="col-lg-2 col-md-2 form-group">


                                                <?php
                                                
                                                if ($pk_id != '') {
                                                    echo '<button type="submit" class="btn btn-block btn-outline-success">'.$lang['Update Now'].'</button>';
                                                } else {


                                                    echo '<button type="submit" class="btn btn-block btn-outline-secondary">'.$lang['Next'].'</button>';
                                                }
                                                ?>



                                            </div>
                                            <div class="col-lg-2 col-md-2 form-group">
                                                <button type="reset" class="btn btn-block btn-outline-warning">Reset</button>
                                            </div>

                                           



 
                                        </div>

                                    </form>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <script>
        $('#browse_image').on('click', function (e) {

            $('#pk_img_file').click();
        });
        $('#pk_img_file').on('change', function (e) {
            var fileInput = this;
            if (fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#pk_img').attr('src', e.target.result);
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        });

    </script>

    <script>


        $('#end_date').datetimepicker({

            defaultDate: new Date("<?php echo $row['enddate']; ?>"),

            format: 'YYYY-MM-DD',

            maxDate: moment()

        });
        </script>


    <!-- /.content-wrapper -->
    <?php include_once './footer.php'; ?>

</div>

</body>
</html>