<?php
include_once './top_header.php';
include_once 'data/data_admin.php';

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
            $t1 = "Admin Users";
            $t2 = getAdminType($a_type, $conn) . " " . $lang['Profile'];
            if ($a_id == 0) {
                $t2 = $lang['New'] . " " . $t2;
            } else {

                $t2 = getAdminTypeByid($a_id, $conn) . " " . $lang['Profile'];
            }
            include_once './page_header.php';
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="../uploads/admin/profile/avt.png"  alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $row['a_name']; ?></h3>

                                    <p class="text-muted text-center"><?= $row['a_location']?> | <?php echo $row['a_country']; ?></p>

                                    <ul class="list-group list-group-unbordered mb-3">

                                        <li class="list-group-item">
                                            <b><?= $lang['User Name']?></b> <a class="float-right"><?php echo $row['a_name']; ?></a>
                                        </li>
                                        
                                        <li class="list-group-item">
                                            <b><?= $lang['Email']?></b> <a class="float-right"><?php echo $row['a_email'] ?></a>
                                        </li>

                                    </ul>

                                 <?php  if($row['a_id']!= $_SESSION['login']){ ?>
                                    
                                    <button  onclick="changeAdmin('<?php echo base64_encode($row['a_id']); ?>','<?php echo base64_encode($row['a_type']); ?>')" class="btn btn-primary btn-block">Login</button>
                                 <?php }?>
                                    
                                    
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->


                        </div>

                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <?php if ($a_id == 0) { ?>
                                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><?= $lang['Basic'] ?></a></li>

                                        <?php } else { ?>
                                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><?= $lang['Basic'] ?></a></li>
                                            <li class="nav-item"><a class="nav-link " href="#details" data-toggle="tab"><?= $lang['Details'] ?></a></li>
<!--                                            <li class="nav-item"><a class="nav-link"  href="#timeline" data-toggle="tab">--><?//= $lang['Bank'] ?><!--</a></li>-->
                                            <li class="nav-item"><a class="nav-link"  href="#passupdate" data-toggle="tab"><?= $lang['Password'] ?></a></li>
                                            <?php if($row['a_id']==$_SESSION['login'] && $row['a_type']>2){ ?>
                                             <li class="nav-item"><a class="nav-link"  href="#refwallet" data-toggle="tab"><?= $lang['Referral Bonus'] ?></a></li>
                                            
                                            <?php }} ?>

                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">


                                            <form   action="data/register_admin.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="update_members" >
                                                <input type="hidden" name="a_type" value="<?php echo $a_type; ?>">
                                                <input type="hidden" name="a_upline" value="<?php echo $_SESSION['login'] ?>">
                                                <?php
                                                if ($a_id == 0) {

                                                    echo '<input type="hidden" name="action" value="register">';
                                                } else {

                                                    echo ' <input type="hidden" name="action" value="update">';
                                                    echo ' <input type="hidden" name="a_id" value="' . $a_id . '">';
                                                }
                                                ?>

                                                <div class="form-group row">
                                                    <label for="a_username" class="col-sm-2 col-form-label"><?= $lang['User Name'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text"    onkeyup="usernameval()" class="form-control" id="a_username"  name="a_username" placeholder="<?= $lang['User Name'] ?>" value="<?php echo $row['a_username']; ?>" required>
                                                           <p id="u_error" style=" color: red; display:none;" >Username can only contain letters and numbers</p>
                                                        <p id="u_ok" style=" color: green; display:none;" >Username accepted</p>
                                                        <p id="u_emp" style=" color: red; display:none;" >Username cannot be empty!</p>
                                                    
                                                    
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="a_name" class="col-sm-2 col-form-label"><?= $lang['Name'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text"  class="form-control"  id="a_name"  name="a_name" placeholder="<?= $lang['Name'] ?>" value="<?php echo $row['a_name']; ?>" required>
                                                      
                                                    
                                                    </div>
                                                </div>
                                                <?php if ($a_id == 0) { ?>
                                                       <div class="form-group row">
                                                        <label for="a_password"  class="col-sm-2 col-form-label"><?= $lang['Password'] ?></label>
                                                        <div class="col-sm-10">
                                                            <input type="password"   minlength="8" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" onkeyup="pwordval()" id="a_password" name="a_password" placeholder="<?= $lang['Password'] ?>"  required>
                                                            <p id="less" style=" color: red; display:none;">Password length must be more than 8 characters</p>
                                                            <p id="more" style=" color: green; display:none;" >Password length accepted</p>
                                                            <p id="empty" style=" color: red; display:none;" >Password cannot be empty!</p>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                               <?php if ($a_type == 2  && $a_id == 0){ ?>     
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label"><?= $lang['City'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text"  id="a_city" name="a_city" class="form-control " placeholder="<?= $lang['City'] ?>" value="<?php echo $row['a_city'] ?> " required>

                                                    </div>
                                                </div>

                                             

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label"><?= $lang['Country'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text"  id="a_country" name="a_country" class="form-control " placeholder="<?= $lang['Country'] ?>" value="<?php echo $row['a_country'] ?>" required>
                                                    </div>
                                                </div>

                                               <?php }?>

                                                <div class="col-lg-12 col-md-12 form-group">
                                                    <div class="row">

                                                        <?php if ($a_id == 0) { ?>

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
                                            </form>
                                        </div>


                                        <div class="tab-pane" id="details">
                                            <!-- The timeline -->

                                            <form   action="data/register_admin.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="more_details" >

                                                <input type="hidden" name="a_type" value="<?php echo $a_type; ?>">
                                                <input type="hidden" name="a_upline" value="<?php echo $_SESSION['login'] ?>">
                                                <input type="hidden" name="action" value="update2">
                                                <input type="hidden" name="a_id" value="<?php echo $a_id; ?>">

                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label"><?= $lang['Phone'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="a_phone" placeholder="<?= $lang['Phone'] ?>" name="a_phone" value="<?php echo $row['a_phone']; ?>"> 
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label"><?= $lang['Email'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="a_email" placeholder="<?= $lang['Email'] ?>" name="a_email" value="<?php echo $row['a_email']; ?>"> 
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-sm-2 col-form-label"><?= $lang['Address'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="a_address" name="a_address" placeholder="<?= $lang['Address'] ?>" value="<?php echo $row['a_address']; ?>">
                                                    </div>
                                                </div>


                                                <div class="col-lg-12 col-md-12 form-group">
                                                    <div class="row">

                                                        <div class="col-lg-3 col-md-3 form-group">
                                                            <button type="submit" class="btn btn-block btn-success">Update Now</button>
                                                        </div>



                                                        <div class="col-lg-3 col-md-3 form-group">
                                                            <button type="reset" class="btn btn-block btn-warning">Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="timeline">
                                            <!-- The timeline -->



                                            <form   action="data/register_admin.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="more_details" >

                                                <input type="hidden" name="a_type" value="<?php echo $a_type; ?>">
                                                <input type="hidden" name="a_upline" value="<?php echo $_SESSION['login'] ?>">
                                                <input type="hidden" name="action" value="update3">
                                                <input type="hidden" name="a_id" value="<?php echo $a_id; ?>">



                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label"><?= $lang['Bank Name'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="a_bank_name" placeholder="<?= $lang['Bank Name'] ?>" name="a_bank_name" value="<?php echo $row['a_bank_name']; ?>"> 
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label"><?= $lang['Account No'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="a_bank_account_no" placeholder="<?= $lang['Account No'] ?>" name="a_bank_account_no" value="<?php echo $row['a_bank_account_no']; ?>"> 
                                                    </div>
                                                </div>




                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label"><?= $lang['Bank Branch'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="a_bank_branach" placeholder="<?= $lang['Bank Branch'] ?>" name="a_bank_branach" value="<?php echo $row['a_bank_branach']; ?>"> 
                                                    </div>
                                                </div>



                                                <div class="col-lg-12 col-md-12 form-group">
                                                    <div class="row">

                                                        <div class="col-lg-3 col-md-3 form-group">
                                                            <button type="submit" class="btn btn-block btn-success">Update Now</button>
                                                        </div>



                                                        <div class="col-lg-3 col-md-3 form-group">
                                                            <button type="reset" class="btn btn-block btn-warning">Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                        <div class="tab-pane" id="passupdate">
                                            <!-- The timeline -->

                                            <form   action="data/register_admin.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="more_details" >

                                                <input type="hidden" name="a_type" value="<?php echo $a_type; ?>">
                                                <input type="hidden" name="a_upline" value="<?php echo $_SESSION['login'] ?>">
                                                <input type="hidden" name="action" value="pass">
                                                <input type="hidden" name="a_id" value="<?php echo $a_id; ?>">

<!--                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label"><?= $lang['Old Password'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="a_old_passs" placeholder="<?= $lang['Old Password'] ?>" name="a_old_passs" > 
                                                    </div>
                                                </div>-->

                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label"><?= $lang['New Password'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="a_new_pass" placeholder="<?= $lang['New Password'] ?>" name="a_new_pass"> 
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label"><?= $lang['Confirm Password'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="a_confoirm_passs" placeholder="<?= $lang['Confirm Password'] ?>" name="a_confoirm_passs"> 
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 form-group">
                                                    <div class="row">

                                                        <div class="col-lg-3 col-md-3 form-group">
                                                            <button type="submit" class="btn btn-block btn-success">Update Now</button>
                                                        </div>

                                                        <div class="col-lg-3 col-md-3 form-group">
                                                            <button type="reset" class="btn btn-block btn-warning">Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        
                                         <div class="tab-pane" id="refwallet">
                                            <!-- The timeline -->

                                            <form   action="data/register_admin.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="more_details" >

                                                <input type="hidden" name="a_type" value="<?php echo $a_type; ?>">
                                                <input type="hidden" name="a_upline" value="<?php echo $_SESSION['login'] ?>">
                                                <input type="hidden" name="action" value="ref_withdraw">
                                                <input type="hidden" name="a_id" value="<?php echo $a_id; ?>">
                                                <input type="hidden" name="ref_balance"  value="<?php echo  admin_Ref_wallet_balance($row['a_id'], $conn);?>"> 
                                                

                                                <div class="form-group row">
                                                    <label for="ref_balance" class="col-sm-2 col-form-label"><?= $lang['Current Balance'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="ref_ad" id="ref_ad" value="<?= admin_Ref_wallet_balance_with_symbol($row['a_id'], $conn)?>" disabled>
                                                      
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="a_ref_wd" class="col-sm-2 col-form-label"><?= $lang['Withdraw Request'] ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="number" step="0.01" class="form-control" id="a_ref_wd"  name="a_ref_wd"   placeholder="0.00" name="a_confoirm_passs"> 
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 form-group">
                                                    <div class="row">

                                                        <div class="col-lg-2 col-md-2 form-group">
                                                            <button type="submit" class="btn btn-block btn-danger"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                        </div>

                                                       
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

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
        <!-- /.content-wrapper -->
        <?php include_once './footer.php'; ?>

    </div>

</body>
</html>
