<?php

include_once './top_header.php';
include_once 'data/data_invoice.php';

?>

<body class="hold-transition sidebar-mini">
<?php

if (isset($_GET['error'])) {
    $error = base64_decode($_GET['error']);

    if (isset($_GET['info'])) {
        $info = base64_decode($_GET['info']);


        echo '<script>  update_message("'.$info.'");</script>';
    } else {
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
        $t1 = $lang['Invoice'];
        $t2 = $lang['Details'];
        if ($in_id == 0) {

            if($pk_id>0){
                $t2 = $lang['New']." ".$t1." For ".get_pk_name_by_pkg_id($pk_id,$conn);
            }else{

                $t2 = $lang['New']." ".$t1;
            }

        } else {
            $t2 = $lang['Update'].$lang['Invoice'];
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
                                <div>
                                    <form action="data/register_invoice.php" class="templatemo-login-form" method="post" enctype="multipart/form-data" name="update_vehicles">
                                        <?php
                                        if ($in_id == 0) {
                                            echo '<input type="hidden" name="action" value="register">';
                                            echo '<input type="hidden" name="in_created_dt" value="'.$today.'">';
                                            echo '<input type="hidden" name="in_created_by" value="'.$user_act.'">';
                                            echo '<input type="hidden" name="pk_id" value="'.$pk_id.'">';
                                            echo '<input type="hidden" name="v_id" value="'.$v_id.'">';
                                            echo '<input type="hidden" name="u_id" value="'.$u_id.'">';
                                        } else {
                                            echo '<input type="hidden" name="action" value="update">';
                                            echo '<input type="hidden" name="in_id" value="'.$in_id.'">';
                                            echo '<input type="hidden" name="in_updated_dt" value="'.$today.'">';
                                            echo '<input type="hidden" name="in_updated_by" value="'.$user_act.'">';
                                            echo '<input type="hidden" name="u_id" value="'.$u_id.'">';
                                        }
                                        ?>

                                        <?php


                                        if ($pk_id == 0) {
                                            ?>


                                            <div class="row mb-3">
                                                <label for="in_contact" class="col-sm-2 col-form-label">Invoice to</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="in_contact" value="<?= get_memeber_name_by_vehical($conn, $v_id) ?>">
                                                </div>
                                            </div>


                                        <?php } else {
                                            echo ' <div class="row mb-3">';
                                            echo '<label for="in_contact" class="col-sm-2 col-form-label">Invoice to</label>';
                                            echo '<div class="col-sm-10">';

                                            echo ' <select class="form-control" name="u_id" id="customer"   required>';
                                            echo ' <option  value=0> Members/Customer </option>';
                                            $database->loadAllUsers($row['u_id']);
                                            echo '</select>';

                                            echo ' </div>';
                                            echo ' </div>';
                                        }


                                        ?>


                                        <div class="row mb-3">
                                            <label for="in_contact" class="col-sm-2 col-form-label">Contact Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="in_contact" name="in_contact" value="<?= get_memeber_phone_by_vehical($conn, $v_id) ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="in_contact" class="col-sm-2 col-form-label">E-mail</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="in_email"   name="in_email" value="<?= get_memeber_email_by_vehical($conn, $v_id) ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="in_address" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"  id="in_address" name="in_address" value="<?= get_memeber_address_by_vehical($conn, $v_id) ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="in_date" class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="in_date"  value="<?php echo date('Y-m-j'); ?>"   name="in_date">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label"><?= $lang['Payment Type'] ?></label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="pay_type" id="pay_type">
                                                    <?php
                                                    if ($row['pay_type'] != '') {
                                                        echo '<option selected='.$row['pay_type'].'>'.$row['pay_type'].'</option>';
                                                    }
                                                    ?>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                    <option value="Debit Card">Debit Card</option>

                                                </select>
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <label for="in_desc" class="col-sm-2 col-form-label">Note</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" class="form-control  summernote" id="in_desc" name="in_desc" value="<?php echo $row['s_desc']; ?>"><?php echo $row['s_desc']; ?></textarea>
                                            </div>
                                        </div>

                                        <button type="submit" style="float: right" id="print_inv" class="btn btn-primary">Ok</button>

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
      $('#browse_image').on('click', function(e) {

        $('#pk_img_file').click();
      });
      $('#pk_img_file').on('change', function(e) {
        var fileInput = this;
        if (fileInput.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
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

                                      maxDate: moment(),

                                    });


    </script>


    <script>

        $("#customer").change(function(){
          var u_id = $(this).children("option:selected").val();


          $.ajax({
                   type: "POST",
                   url: "data/data_user_details.php",

                   dataType: 'text',

                   data: { u_id: u_id },

                   success: function(response) {

                     var res = JSON.parse(response);

                     $('#in_contact').val(res['u_phone']);
                     $('#in_email').val(res['u_email']);
                     $('#in_address').val(res['u_address']);


                   }
                 });

        });






    </script>

    <script>
      //$("#print_inv").on('click', function(e) {
      //
      //  window.open('./package_list.php?error=<?//= base64_encode(9)?>//');
      //});

    </script>



    <!-- /.content-wrapper -->
    <?php include_once './footer.php'; ?>

</div>

</body>
</html>