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

        $t1 = $lang['Service'];
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
                                <button type="button" class="btn btn-block  btn-outline-secondary" onclick="location.href = 'service.php';"><?= $lang['Add New'] ?></button>

                            </h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $lang['Service Name'] ?></th>
                                    <th><?= $lang['Service Amount'] ?></th>
                                    <th><?= $lang['Service Discount'] ?></th>
                                    <th><?= $lang['Service Cost'] ?></th>


                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><?= $lang['Service Name'] ?></th>
                                    <th><?= $lang['Service Amount'] ?></th>
                                    <th><?= $lang['Service Discount'] ?></th>
                                    <th><?= $lang['Service Cost'] ?></th>


                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result_service_list)) {


                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><a href="service.php?s_id=<?= base64_encode($row['s_id']) ?>"><?= $row['s_name'] ?></a></td>
                                        <td><?= printAmount($row['s_amount'] )?></td>
                                        <td><?= printAmount($row['s_discount']) ?></td>
                                        <td><?= printAmount($row['s_cost']) ?></td>


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
