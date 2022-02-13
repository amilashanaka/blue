<?php
include_once './top_header.php';
include_once 'data/data_vehicles.php';

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
            $t1 = $lang['VEHICLE'];
            $t2 = $lang['Details'];
            if ($v_id == 0) {
                $t2 = $lang['New'] . " " . $t2;
            } else {

                $t2 = $lang['Update Vehicle'];
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
                                            <form action="data/register_vehicles.php" class="templatemo-login-form" method="post" enctype="multipart/form-data" name="update_vehicles">
                                                <?php
                                                if ($v_id == 0) {

                                                    echo '<input type="hidden" name="action" value="register">';
                                                    echo '<input type="hidden" name="v_created_dt" value="' . $today . '">';
                                                    echo '<input type="hidden" name="v_created_by" value="' . $user_act . '">';
                                                } else {

                                                    echo ' <input type="hidden" name="action" value="update">';
                                                    echo ' <input type="hidden" name="v_id" value="' . $v_id . '">';
                                                    echo '<input type="hidden" name="v_updated_dt" value="' . $today . '">';
                                                    echo '<input type="hidden" name="v_updated_by" value="' . $user_act . '">';
                                                }
                                                ?>   
                                        
                                       
                                    <div class="col-lg-12 col-md-12 form-group">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4">
                                                <div class="row form-group">						
                                                    <div class="form-group" style="">
                                                        <div class="user_image">
                                                            <?php if ($row['v_img'] == '') { ?>
                                                            <img name="v_img" id="v_img"  src="img/car.png" class="bg-transparent profile_image" style="max-height:150px;width:auto">
                                                            <?php } else { ?>
                                                                <img name="v_img" id="v_img"  src="<?= $row['v_img']; ?>" class="transparent profile_image" style="max-height:150px;width:auto">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <input type="file" name="v_img_file" id="v_img_file" class="form-control"  placeholder="Username" aria-describedby="inputGroupPrepend" style="display: none;align-content: center" />
                                                    <input type="button" style="width: 30%;" value="Browse" id="browse_image" class="btn btn-block btn-success"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 ">
                                                <div class="row form-group">

                                                    <div class="col-lg-6 col-md-6 form-group">                  
                                                        <label><?= $lang['Vehicle Number'] ?></label>
                                                        <input type="text" class="form-control" id="v_number" placeholder="XXX-XXXX-X" name="v_number" value="<?php echo $row['v_number']; ?>" >
                                                    </div>
                                                    

                                                    <div class="col-lg-6 col-md-6 form-group">                  
                                                        <label><?= $lang['Vehicle Type'] ?></label>

                                                        <select class="form-control" name="v_type" id="v_type">


                                                            <?php
                                                            if ($row['v_type'] != '') {
                                                                echo '<option selected=' . $row['v_type'] . '>' . $row['v_type'] . '</option>';
                                                            }
                                                            ?>
                                                            <option value="Small">Small</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="Large">Large</option>

                                                        </select>
                                                       
                                                    </div>


                                                    <div class="col-lg-6 col-md-6 form-group">
                                                        <label><?= $lang['Make'] ?></label>
                                                        <input type="text" class="form-control" id="v_make" placeholder="Toyota" name="v_make" value="<?php echo $row['v_make']; ?>" >
                                                    </div>


                                                    <div class="col-lg-6 col-md-6 form-group">
                                                        <label><?= $lang['Model'] ?></label>
                                                        <input type="text" class="form-control" id="v_model" placeholder="Prius" name="v_model" value="<?php echo $row['v_model']; ?>" >
                                                    </div>

                                                    
                                                    <div class="col-lg-6 col-md-6 form-group">                  
                                                        <label><?= $lang['Mileage'] ?></label>
                                                        <input type="text" class="form-control" id="v_mileage"  placeholder="xxx km" name="v_mileage" value="<?php echo $row['v_mileage']; ?>" >
                                                    </div>
                            

                                                    <div class="col-lg-6 col-md-6 form-group">
                                                        <label><?= $lang['Under Owner'] ?></label>

                                                        <?php



                                                        echo ' <select class="form-control" name="v_owner" id="v_owner" value="' . $row['v_owner'] . '" required>';
                                                        echo ' <option  value=0> '.$lang['Under Owner'].' </option>';
                                                        $database->loadAllUsers($row['v_owner']);
                                                        echo '</select>';



                                                        ?>

                                                    </div>
                                                    

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-divider"><span><?= $lang['Details'] ?></span></h5>
                                    <div class="row form-group">
                                        <div class="col-lg-12 col-md-12 form-group">
                                            <label><?= $lang['Description'] ?> :</label>
                                            <textarea type="text" class="form-control  summernote" id="v_desc"  name="v_desc" value="<?php echo $row['v_desc']; ?>" ><?php echo $row['v_desc']; ?></textarea>
                                        </div>



                                    </div>

                                    <hr>



                                    <div  class="row form-group">
                                        <div class="col-lg-2 col-md-2 form-group"> 
                                            
                       
                                            <?php
                                            if ($v_id != '') {

                                                    
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

          $('#v_img_file').click();
        });
        $('#v_img_file').on('change', function (e) {
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