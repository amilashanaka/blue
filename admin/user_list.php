<?php
include_once './top_header.php';

include_once './data/data_user_list.php';
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
    <?php include_once './sidebar.php'; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <?php
        $t1 = $lang['User'];
        $t2 = $lang['List'];

        include_once './page_header.php';
        ?>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->

                    <div class="card">
                        <?php if ($_SESSION['login_type'] < 3) { ?>
                            <div class="card-header">

                                <h3 class="card-title">
                                    <div class="row">


                                        <div class="col6">
                                            <button type="button" class="btn btn-app" onclick="location.href = 'user.php?u_type=<?= base64_encode($u_type) ?>';"><i class="fas fa-user-plus"></i><?= $lang['Add New User'] ?></button>
                                        </div>


                                    </div>


                                </h3>
                            </div>
                        <?php } ?>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $lang['User'] ?></th>
                                    <th><?= $lang['Phone'] ?></th>
                                    <th><?= $lang['Email'] ?></th>

                                    <th><?= $lang['Join date'] ?></th>

                                    <th style="width:3%; text-align: center;"><?= $lang['Action'] ?></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><?= $lang['User'] ?></th>
                                    <th><?= $lang['Phone'] ?></th>
                                    <th><?= $lang['Email'] ?></th>

                                    <th><?= $lang['Join date'] ?></th>

                                    <th style="width:3%; text-align: center;"><?= $lang['Action'] ?></th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><a href="user.php?u_id=<?php echo base64_encode($row['u_id']); ?>"><?php
                                                if ($row['u_username'] != '') {
                                                    echo $row['u_username'];
                                                } else {
                                                    if ($row['u_name'] != '') {
                                                        echo $row['u_name'];
                                                    }
                                                }
                                                ?></a></td>
                                        <td><?php echo $row['u_phone']; ?></td>
                                        <td><?php echo $row['u_email']; ?></td>



                                        <td><?php echo printDate($row['u_register_date']); ?></td>



                                        <td><?php if ($row['u_status'] == '1') { ?>
                                                <button type="button" id="btnm<?php echo $row['u_id']; ?>" class="btn btn-block btn-outline-danger btn-flat" onclick="delete_record('<?php echo $row['u_id']; ?>', 'u', 'u_id', '0');"><i class="fa fa-times"
                                                                                                                                                                                                                                          aria-hidden="true"></i></button>
                                            <?php } else { ?>
                                                <button type="button" id="btnm<?php echo $row['u_id']; ?>" class="btn btn-block btn-outline-success btn-flat" onclick="activate_record('<?php echo $row['u_id']; ?>', 'u', 'u_id', '0');"><i class="fa fa-check "></i>
                                                </button>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>


    <?php include_once './control-sidebar.php'; ?>


    <!-- /.content-wrapper -->
    <?php include_once './footer.php'; ?>

</div>

<script>
    function copy_link() {
        var copyText = document.getElementById("share");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        swal("Copied to clip board ", copyText.value, "success");

    }
</script>
</body>
</html>
