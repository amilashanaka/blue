<?php
include_once './top_header.php';
include_once 'data/data_service.php';

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
        $t1 = $lang['Service'];
        $t2 = $lang['Details'];
        if ($s_id == 0) {
            $t2 = $lang['New'] . " " . $t1;
        } else {

            $t2 = $lang['Update Service'];
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
                                    <form action="data/register_service.php" class="templatemo-login-form" method="post" enctype="multipart/form-data" name="update_vehicles">
                                        <?php
                                        if ($s_id == 0) {

                                            echo '<input type="hidden" name="action" value="register">';
                                            echo '<input type="hidden" name="s_created_dt" value="' . $today . '">';
                                            echo '<input type="hidden" name="s_created_by" value="' . $user_act . '">';
                                        } else {

                                            echo ' <input type="hidden" name="action" value="update">';
                                            echo ' <input type="hidden" name="s_id" value="' . $s_id . '">';
                                            echo '<input type="hidden" name="s_updated_dt" value="' . $today . '">';
                                            echo '<input type="hidden" name="s_updated_by" value="' . $user_act . '">';
                                        }
                                        ?>


                                        <div class="col-lg-12 col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="row form-group">
                                                        <div class="form-group" style="">
                                                            <div class="user_image">
                                                                <?php if ($row['v_img'] == '') { ?>
                                                                    <img name="s_img" id="s_img"  src="img/service.jpeg" class="bg-transparent profile_image" style="max-height:150px;width:auto">
                                                                <?php } else { ?>
                                                                    <img name="s_img" id="s_img"  src="<?= $row['s_img']; ?>" class="transparent profile_image" style="max-height:150px;width:auto">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="file" name="s_img_file" id="s_img_file" class="form-control"  placeholder="Username" aria-describedby="inputGroupPrepend" style="display: none;align-content: center" />
                                                        <input type="button" style="width: 30%;" value="Browse" id="browse_image" class="btn btn-block btn-success"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 ">
                                                    <div class="row form-group">

                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Service Name'] ?></label>
                                                            <input type="text" class="form-control" id="s_name"   name="s_name" value="<?php echo $row['s_name']; ?>"  required>
                                                        </div>



                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Service Amount'] ?></label>
                                                            <input type="number" step="0.01" class="form-control" id="s_amount" placeholder="0.00" name="s_amount" value="<?php echo printAmount($row['s_amount']); ?>" >
                                                        </div>


                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Service Cost'] ?></label>
                                                            <input type="number" step="0.01" class="form-control" id="s_cost" placeholder="0.00" name="s_cost" value="<?php echo  printAmount($row['s_cost']); ?>" >
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 form-group">
                                                            <label><?= $lang['Service Discount'] ?></label>
                                                            <input type="number" step="0.01" class="form-control" id="s_discount" placeholder="0.00" name="s_discount" value="<?php echo  printAmount($row['s_discount']); ?>" >
                                                        </div>






                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="text-divider"><span><?= $lang['Details'] ?></span></h5>
                                        <div class="row form-group">
                                            <div class="col-lg-12 col-md-12 form-group">
                                                <label><?= $lang['Description'] ?> :</label>
                                                <textarea type="text" class="form-control  summernote" id="s_desc"  name="s_desc" value="<?php echo $row['s_desc']; ?>" ><?php echo $row['s_desc']; ?></textarea>
                                            </div>



                                        </div>

                                        <hr>



                                        <div  class="row form-group">
                                            <div class="col-lg-2 col-md-2 form-group">


                                                <?php
                                                if ($s_id != '') {


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

            $('#s_img_file').click();
        });
        $('#s_img_file').on('change', function (e) {
            var fileInput = this;
            if (fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#v_img').attr('src', e.target.result);
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
