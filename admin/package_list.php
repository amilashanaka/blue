<?php
include_once './top_header.php';

include_once './data/data_list.php';
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

        $t1 = $lang['Package'];
        $t2 = $lang['List'];

        include_once './page_header.php';

        ?>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" class="btn btn-block  btn-outline-secondary" onclick="location.href = 'package.php';"><?= $lang['Add New'] ?></button>

                            </h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $lang['Package Code'] ?></th>
                                    <th><?= $lang['Package Name'] ?></th>
                                    <th><?= $lang['Package Amount'] ?></th>
                                    <th><?= $lang['Package count'] ?></th>
                                    <th><?= $lang['Package Discount'] ?></th>
                                    <th><?= $lang['Package Used'] ?></th>
                                    <th><?= $lang['Sale package'] ?></th>
                                    <th><?= $lang['Action'] ?></th>


                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><?= $lang['Package Code'] ?></th>
                                    <th><?= $lang['Package Name'] ?></th>
                                    <th><?= $lang['Package Amount'] ?></th>
                                    <th><?= $lang['Package count'] ?></th>
                                    <th><?= $lang['Package Discount'] ?></th>
                                    <th><?= $lang['Package Used'] ?></th>
                                    <th><?= $lang['Sale package'] ?></th>
                                    <th><?= $lang['Action'] ?></th>



                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result_packages_list)) {


                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><a href="package.php?pk_id=<?= base64_encode($row['pk_id']) ?>"><?= $row['pk_code'] ?></a></td>
                                        <td><?= $row['pk_name'] ?></td>
                                        <td><?= printAmount($row['pk_amount'] )?></td>
                                        <td><?= $row['pk_qty']?></td>
                                        <td><?= $row['pk_discount']?></td>
                                        <td><?= $row['pk_used']?></td>
                                      
                                        <?php if ($row['pk_qty']>0){ ?>
                                        <td>  <button  type="button"   class="btn btn-block btn-outline-info btn-flat"  onclick="location.href = 'invoice.php?pk_id=<?=base64_encode($row['pk_id']) ?>';" ><i class="fa fa-info" aria-hidden="true"></i></button></td>
                                        <?php } else { ?>
                                        <td>  <button  type="button"   class="btn btn-block btn-outline-info btn-flat"  onclick="location.href = 'invoice.php?pk_id=<?=base64_encode($row['pk_id']) ?>';"  disabled><i class="fa fa-info" aria-hidden="true"></i></button></td>
                                        <?php } ?>




                                        <td><?php if ($row['pk_status'] == '1') { ?>
                                                <button type="button" id="btnm<?php echo $row['pk_id']; ?>" class="btn btn-block btn-outline-danger btn-flat" onclick="delete_record('<?php echo $row['pk_id']; ?>', 'pk', 'pk_id', '0');"><i class="fa fa-times"
                                                                                                                                                                                                                                          aria-hidden="true"></i></button>
                                            <?php } else { ?>
                                                <button type="button" id="btnm<?php echo $row['pk_id']; ?>" class="btn btn-block btn-outline-success btn-flat" onclick="activate_record('<?php echo $row['pk_id']; ?>', 'pk', 'pk_id', '0');"><i class="fa fa-check "></i>
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
<!-- ./wrapper -->
</body>
</html>
