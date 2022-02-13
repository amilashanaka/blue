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
        $t2 = $lang['Package Sold'];

        include_once './page_header.php';

        ?>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                       

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example24" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pks No</th>
                                    <th><?= $lang['Package Name'] ?></th>
                                    <th><?= $lang['User ID'] ?></th>
                                    <th><?= $lang['User Name'] ?></th>
                                    <th><?= $lang['Package Sold Date'] ?></th>
                                    <th><?= $lang['Print'] ?></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                <th>#</th>
                                    <th>Pks No</th>
                                    <th><?= $lang['Package Name'] ?></th>
                                    <th><?= $lang['User ID'] ?></th>
                                    <th><?= $lang['User Name'] ?></th>
                                    <th><?= $lang['Package Sold Date'] ?></th>
                                    <th><?= $lang['Print'] ?></th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $i = 1;
                                
                                while ($row = mysqli_fetch_assoc($result_package_sold_list)) {
                                   
                                    $pkg_name=get_package_name($row['pk_id'], $conn);
                                    $user_name=get_username($row['u_id'], $conn);
                                   
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><a href="package.php?pks_id=<?= base64_encode($row['pks_id']) ?>"><?= $row['pks_no'] ?></a></td>
                                        <td><?= $pkg_name ?></td>
                                        <td><?= ($row['u_id'] )?></td>
                                        <td><?= $user_name?></td>
                                        <td><?= $row['pks_created_dt'] ?></td>
<!--                                        <td><a href="'../inc/package_print.php?error='.--><?//=base64_encode(4)?><!--.'&in_id='.--><?//=base64_encode($row['pk_id'])?><!--)">--><?//= $row['pks_id'] ?><!--</a></td>-->
<!--                                     -->


                                      <td><a href="../inc/package_print.php"><?= $row['pks_id'] ?></a></td>

                                        

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
