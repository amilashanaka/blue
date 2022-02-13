<?php

//initialize

$u_id   = 0;
$row    = null;
$u_type = 0;

include_once './top_header.php';
include_once 'data/data_user.php';

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
        $t1 = $lang['User'];


        if ($u_id == 0) {
            $t2 = $lang['New']." ".$t2;
        } else {

            $t2 = getUserName($u_id, $conn);
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
                                    <?php if ($row['u_img'] == '') {
                                        echo '<img class="profile-user-img img-fluid img-circle" src="../uploads/admin/profile/avt.png"  alt="User profile picture">';
                                    } else {
                                        echo '<img style="width:125px;height:125px" class="profile-user-img img-fluid img-circle" src="'.$row['u_img'].'"  alt="User profile picture">';

                                    }
                                    ?>
                                </div>

                                <h3 class="profile-username text-center"><?php echo $row['u_name']; ?></h3>

                                <p class="text-muted text-center"><?= $lang['User'] ?> | <?php echo $row['u_phone']; ?></p>

                                <ul class="list-group list-group-unbordered mb-3">

                                    <li class="list-group-item">
                                        <b><?= $lang['Vehicles'] ?> </b> <a class="float-right">1</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b><?= $lang['Join Date'] ?> </b> <a class="float-right"><?= printDate($row['u_register_date']) ?></a>
                                    </li>

                                    <li class="list-group-item">
                                        <b><?= $lang['Phone'] ?></b> <a class="float-right"><?= $row['u_phone'] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b><?= $lang['Email'] ?></b> <a class="float-right"><?= $row['u_email'] ?></a>
                                    </li>
<!--                                    <li class="list-group-item">-->
<!--                                        <b>--><?//= $lang['Date Of Birth'] ?><!--</b> <a class="float-right">--><?//= getAdminNamefromUser($row['u_id'], 5, $conn) ?><!--</a>-->
<!--                                    </li>-->
                                    <li class="list-group-item">
                                        <b><?= $lang['Subscription'] ?></b> <a class="float-right"><?php if ($row['u_type'] == 1) {
                                                echo $lang['Member'];
                                            } else {
                                                if ($row['u_type'] == 2) {
                                                    echo $lang['Customer'];
                                                } else {
                                                    echo $lang['Not Active'];
                                                }
                                            }; ?></a>
                                    </li>
                                </ul>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </div>

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <?php if ($u_id == 0) { ?>
                                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><?= $lang['Basic'] ?></a></li>

                                    <?php } else { ?>
                                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><?= $lang['Basic'] ?></a></li>
                                        <li class="nav-item"><a class="nav-link " href="#details" data-toggle="tab"><?= $lang['Details'] ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><?= $lang['Vehicles'] ?></a></li>


                                    <?php } ?>

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">


                                        <form action="data/register_user.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="update_members">

                                            <input type="hidden" name="u_type5_by" value="<?php echo $_SESSION['login'] ?>">
                                            <input type="hidden" name="u_type" value="<?= $u_type ?>">
                                            <?php
                                            if ($u_id == 0) {

                                                echo '<input type="hidden" name="action" value="register">';
                                            } else {

                                                echo ' <input type="hidden" name="action" value="update">';
                                                echo ' <input type="hidden" name="u_id" value="'.$u_id.'">';
                                            }
                                            ?>

<!--                                            <div class="form-group row">-->
<!--                                                <label for="u_username" class="col-sm-2 col-form-label">--><?//= $lang['User Name'] ?><!--</label>-->
<!--                                                <div class="col-sm-10">-->
<!--                                                    <input type="text" class="form-control" id="u_username" name="u_username" placeholder="--><?//= $lang['User Name'] ?><!--" value="--><?php //echo $row['u_username']; ?><!--" required>-->
<!--                                                </div>-->
<!--                                            </div>-->

                                            <div class="form-group row">
                                                <label for="u_name" class="col-sm-2 col-form-label"><?= $lang['Name'] ?></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="u_name" name="u_name" placeholder="<?= $lang['Name'] ?>" value="<?php echo $row['u_name']; ?>" required>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label"><?= $lang['Phone'] ?></label>
                                                <div class="col-sm-10">
                                                    <input type="number" maxlength="10" minlength="4" class="form-control" id="u_phone" placeholder="<?= $lang['Phone'] ?>" name="u_phone" value="<?php echo $row['u_phone']; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label"><?= $lang['Email'] ?></label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="u_email" placeholder="<?= $lang['Email'] ?>" name="u_email" value="<?php echo $row['u_email']; ?>">
                                                </div>
                                            </div>


                                            <div class="col-lg-12 col-md-12 form-group">
                                                <div class="row">

                                                    <?php if ($u_id == 0) { ?>

                                                        <div class="col-lg-3 col-md-3 form-group">
                                                            <button type="submit" name="add_new_Submit" class="btn btn-block btn-danger"><?= $lang['Add New'] ?></button>
                                                        </div>


                                                    <?php } else { ?>

                                                        <div class="col-lg-3 col-md-3 form-group">
                                                            <button type="submit" class="btn btn-block btn-success"><?= $lang['Update Now'] ?></button>
                                                        </div>

                                                    <?php } ?>
                                                    <div class="col-lg-3 col-md-3 form-group">
                                                        <button type="reset" class="btn btn-block btn-warning"><?= $lang['Reset'] ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                    <div class="tab-pane" id="details">
                                        <!-- The timeline -->

                                        <form action="data/register_user.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="more_details">


                                            <input type="hidden" name="u_upline" value="<?php echo $_SESSION['login'] ?>">
                                            <input type="hidden" name="action" value="update2">
                                            <input type="hidden" name="u_id" value="<?php echo $u_id; ?>">


                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label"><?= $lang['IC Type'] ?></label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="u_ic_type" id="u_ic_type">

                                                        <?php
                                                        if ($row['u_ic_type'] != '') {
                                                            echo '<option selected=' . $row['u_ic_type'] . '>' . $row['u_ic_type'] . '</option>';
                                                        }
                                                        ?>
                                                        <option value="IC"><?= $lang['IC'] ?></option>
                                                        <option value="Passport"><?= $lang['Passport'] ?></option>

                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="inputExperience" class="col-sm-2 col-form-label"><?= $lang['IC'] ?></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="u_ic_no" name="u_ic_no" placeholder="<?= $lang['IC Number'] ?>" value="<?php echo $row['u_ic_no']; ?>">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="inputExperience" class="col-sm-2 col-form-label"><?= $lang['Address'] ?></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="u_address" name="u_address" placeholder="<?= $lang['Address'] ?>" value="<?php echo $row['u_address']; ?>">
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


                                        <form action="data/register_user.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="more_details">

                                            <input type="hidden" name="u_type" value="<?php echo $u_type; ?>">
                                            <input type="hidden" name="action" value="update3">
                                            <input type="hidden" name="u_id" value="<?php echo $u_id; ?>">

                                            <?php

                                            $find="select * from vehicles where v_owner =".$u_id;

                                            $result_vehicle_list = mysqli_query($conn, $find);


                                            ?>


                                            <div class="form-group row">


                                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                    <tr>
                                                        <th>#</th>
                                                        <th><?= $lang['Vehicle Number'] ?></th>
                                                        <th><?= $lang['Register Date'] ?></th>
                                                    </tr>
                                                    <tbody>
                                                    <?php
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result_vehicle_list)) {


                                                        ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><a href="vehicle.php?v_id=<?= base64_encode($row['v_id'])?>"><?= $row['v_number'] ?></a></td>

                                                            <td><?= $row['v_created_dt'] ?></td>

                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>

                                                </table>
                                            </div>

<!--                                            <div class="form-group row">-->
<!--                                                <label for="inputName2" class="col-sm-2 col-form-label">--><?//= $lang['Vehicle Number'] ?><!--</label>-->
<!--                                                <div class="col-sm-10">-->
<!--                                                    <select class="form-control" name="v_number" id="v_number">-->
<!--                                                        <option value="1">WD 4567 C</option>-->
<!--                                                        <option value="2">WD 5067 C</option>-->
<!---->
<!--                                                    </select>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="col-lg-12 col-md-12 form-group">-->
<!--                                                <div class="row">-->
<!---->
<!--                                                    <div class="col-lg-3 col-md-3 form-group">-->
<!--                                                        <button type="submit" class="btn btn-block btn-info">--><?//= $lang['Add New'] ?><!--</button>-->
<!--                                                    </div>-->
<!---->
<!---->
<!--                                                    <div class="col-lg-3 col-md-3 form-group">-->
<!--                                                        <button type="reset" class="btn btn-block btn-warning">Reset</button>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
                                        </form>

                                    </div>

                                    <div class="tab-pane" id="passupdate">
                                        <!-- The timeline -->

                                        <form action="data/register_user.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="more_details">

                                            <input type="hidden" name="u_type" value="<?php echo $u_type; ?>">
                                            <input type="hidden" name="u_upline" value="<?php echo $_SESSION['login'] ?>">
                                            <input type="hidden" name="action" value="pass">
                                            <input type="hidden" name="u_id" value="<?php echo $u_id; ?>">


                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-sm-2 col-form-label"><?= $lang['New Password'] ?></label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="u_new_pass" placeholder="<?= $lang['New Password'] ?>" name="u_new_pass">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-sm-2 col-form-label"><?= $lang['Confirm Password'] ?></label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="u_confoirm_passs" placeholder="<?= $lang['Confirm Password'] ?>" name="u_confoirm_passs">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="u_otp" class="col-sm-2 col-form-label"><?= $lang['otp'] ?></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="u_otp" placeholder="<?= $lang['otp'] ?>" name="u_otp" value="<?php echo $row['u_otp']; ?>" required>
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
