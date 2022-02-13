<?php
include_once './top_header.php';
include_once 'data/data_currency.php';

?>
<body class="hold-transition sidebar-mini">
<?php 

if (isset($_GET['error'])) {
    $error = base64_decode($_GET['error']);
    echo '<script>  error_by_code('.$error.');</script>';
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
            $t1 = "Genaral Seetings";
            $t2 = "Currency";
            if ($cu_id == 0) {
                $t2 = $lang['New'] . " " . $t2;
            } else {

                $t2 = "Update Currency";
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
                                    <form   action="data/register_currency.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="update_members" >
                                               
                                                    <?php
                                                    if ($cu_id == 0) {

                                                        echo '<input type="hidden" name="action" value="register">';
                                                        echo '<input type="hidden" name="cu_created_by" value="' . $_SESSION['login'] . '">';
                                                    } else {

                                                        echo ' <input type="hidden" name="action" value="update">';
                                                        echo ' <input type="hidden" name="cu_id" value="' . $cu_id . '">';
                                                        echo '<input type="hidden" name="cu_updated_by" value="' . $_SESSION['login'] . '">';
                                                    }
                                                    ?>

                                                <div class="form-group row">
                                                    <label for="cu_name" class="col-sm-2 col-form-label"><?= $lang['Currency Name'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text"    class="form-control" id="cu_name"  name="cu_name" placeholder="<?= $lang['Currency Name'] ?>" value="<?php echo $row['cu_name']; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="cu_rate" class="col-sm-2 col-form-label"><?= $lang['Currency Rate'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text"  class="form-control" id="cu_rate"  name="cu_rate" placeholder="<?= $lang['Currency Rate'] ?>" value="<?php echo $row['cu_rate']; ?>" required>
                                                    </div>
                                                </div>
                                                 
                                                    <div class="form-group row">
                                                        <label for="cu_withdraw_rate" class="col-sm-2 col-form-label"><?= $lang['Withdraw Rate'] ?></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="cu_withdraw_rate" name="cu_withdraw_rate" placeholder="<?= $lang['Withdraw Rate'] ?>" value="<?php echo $row['cu_withdraw_rate']; ?>" required>
                                                        </div>
                                                    </div>
                                             
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label"><?= $lang['Symbol'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text"  id="cu_symbol" name="cu_symbol" class="form-control " placeholder="<?= $lang['Symbol'] ?>" value="<?php echo $row['cu_symbol'] ?>">

                                                    </div>
                                                </div>
 

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label"><?= $lang['Bank'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text"  id="cu_bank" name="cu_bank" class="form-control " placeholder="<?= $lang['Bank'] ?>" value="<?php echo $row['cu_bank'] ?>">
                                                    </div>
                                                </div>

                                                <div  class="col-lg-12 col-md-12 form-group ">
                                                    <div class="col-lg-6 col-md-6 form-group" >
                                                        <br>
                                                    </div>
                                                     <div class="col-lg-6 col-md-6 form-group ">
                                                    <div class="row">

                                                        <?php if ($cu_id == 0) { ?>

                                                            <div class="col-lg-3 col-md-3 form-group">
                                                                <button type="submit" name="add_new_Submit" class="btn btn-block btn-danger">Add New</button>
                                                            </div>


                                                        <?php } else { ?>

                                                            <div class="col-lg-3 col-md-3 form-group">
                                                                <button type="submit" class="btn btn-block btn-success">Update Now</button>
                                                            </div>

                                                        <?php } ?>
                                                        <div class="col-lg-3 col-md-3 form-group">
                                                            <button type="reset" class="btn btn-block btn-warning">Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                </div>

                                               
                                            </form>
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
        <!-- /.content-wrapper -->
        <?php include_once './footer.php'; ?>

    </div>

</body>
</html>
