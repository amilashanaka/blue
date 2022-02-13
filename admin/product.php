<?php
include_once './top_header.php';
include_once 'data/data_product.php';

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
        $t1 = $lang['Product'];
        $t2 = $lang['Details'];
        if ($s_id == 0) {
            $t2 = $lang['New'] . " " . $t1;
        } else {

            $t2 = $lang['Update Product'];
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
                                    <form action="data/register_product.php" class="templatemo-login-form" method="post" enctype="multipart/form-data" name="update_vehicles">
                                        <?php
                                        if ($p_id == 0) {

                                            echo '<input type="hidden" name="action" value="register">';
                                            echo '<input type="hidden" name="p_created_dt" value="' . $today . '">';
                                            echo '<input type="hidden" name="p_created_by" value="' . $user_act . '">';
                                        } else {

                                            echo ' <input type="hidden" name="action" value="update">';
                                            echo ' <input type="hidden" name="p_id" value="' . $p_id . '">';
                                            echo '<input type="hidden" name="p_updated_dt" value="' . $today . '">';
                                            echo '<input type="hidden" name="p_updated_by" value="' . $user_act . '">';
                                        }
                                        ?>


                                        <div class="col-lg-12 col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="row form-group">
                                                        <div class="form-group" style="">
                                                            <div class="user_image">
                                                                <?php if ($row['p_img'] == '') { ?>
                                                                    <img name="p_img" id="p_img"  src="img/product.png" class="bg-transparent profile_image" style="max-height:150px;width:auto">
                                                                <?php } else { ?>
                                                                    <img name="p_img" id="p_img"  src="<?= $row['p_img']; ?>" class="transparent profile_image" style="max-height:150px;width:auto">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="file" name="p_img_file" id="p_img_file" class="form-control"  aria-describedby="inputGroupPrepend" style="display: none;align-content: center" />
                                                        <input type="button" style="width: 30%;" value="Browse" id="browse_image" class="btn btn-block btn-success"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 ">
                                                    <div class="row form-group">

                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Product Name'] ?></label>
                                                            <input type="text" class="form-control" id="p_name"   name="p_name" value="<?php echo $row['p_name']; ?>"  required>
                                                        </div>


                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Product Amount'] ?></label>
                                                            <input type="number" step="0.01" class="form-control" id="p_amount" placeholder="0.00" name="p_amount" value="<?php echo printAmount($row['p_amount']); ?>" >
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Product Cost'] ?></label>
                                                            <input type="number" step="0.01" class="form-control" id="p_cost" placeholder="0.00" name="p_cost" value="<?php echo printAmount($row['p_cost']); ?>" >
                                                        </div>


                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Product Stock'] ?></label>
                                                            <input type="number" step="1" class="form-control" id="p_stock" placeholder="0" name="p_stock" value="<?php echo ($row['p_stock']); ?>" >
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Product Discount'] ?></label>
                                                            <input type="number" step="0.01" class="form-control" id="p_discount" placeholder="0.00" name="p_discount" value="<?php echo  printAmount($row['p_discount']); ?>" >
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Expire Date'] ?></label>
                                                            <input type="date"   class="form-control" id="p_exp_date"   name="p_exp_date" value="<?php echo  printAmount($row['p_exp_date']); ?>" >
                                                        </div>






                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="text-divider"><span><?= $lang['Details'] ?></span></h5>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 form-group">
                                                <label><?= $lang['Description'] ?> :</label>
                                                <textarea type="text" class="form-control  summernote" id="p_desc"  name="p_desc" value="<?php echo $row['p_desc']; ?>" ><?php echo $row['p_desc']; ?></textarea>
                                            </div>



                                        </div>

                                        <hr>



                                        <div  class="row form-group">
                                            <div class="col-lg-2 col-md-2 form-group">


                                                <?php
                                                if ($p_id != '') {


                                                    echo '<button type="submit" class="btn btn-block btn-outline-success">Update Now</button>';
                                                } else {


                                                    echo '<button type="submit" class="btn btn-block btn-outline-secondary">ADD New</button>';
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

            $('#p_img_file').click();
        });
        $('#p_img_file').on('change', function (e) {
            var fileInput = this;
            if (fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#p_img').attr('src', e.target.result);
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
