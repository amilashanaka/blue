<?php




include_once './top_header.php';
include_once 'data/data_invoice_item.php';

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
        $t1 = "invoice Item";
        $t2 = "Add/Remove Item";

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


                                        echo '<input type="hidden" name="action" value="register">';
                                        echo '<input type="hidden" name="in_created_dt" value="'.$today.'">';
                                        echo '<input type="hidden" name="in_created_by" value="'.$user_act.'">';


                                        echo '<input type="hidden" name="action" value="update">';
                                        echo '<input type="hidden" name="in_id" value="'.$in_id.'">';
                                        echo '<input type="hidden" name="in_updated_dt" value="'.$today.'">';
                                        echo '<input type="hidden" name="in_updated_by" value="'.$user_act.'">';

                                        ?>

                                        <div class="row mb-3">
                                            <label for="in_name" class="col-sm-2 col-form-label">Service</label>
                                            <div class="col-sm-8">

                                                <div class="row">

                                                    <div class="col-sm-8">


                                                        <?php


                                                        echo ' <select class="form-control" name="s_id" id="s_id"   required>';
                                                        echo ' <option  value=0> Select </option>';
                                                        $database->loadAllServices($row['s_id']);
                                                        echo '</select>';


                                                        ?>

                                                    </div>

                                                    <div class="col-sm-2">


                                                        <input type="number"  placeholder="Qty" class="form-control" id="s_qty"  name="s_qty">


                                                    </div>

                                                    <button type="button" onclick="add_service(<?=$in_id?>,$('#s_id option:selected').val(),$('#s_qty').val(),'inv')" class="btn btn-primary ">Add</button>

                                                </div>


                                            </div>


                                        </div>

                                        <div class="row mb-3">
                                            <label for="in_name" class="col-sm-2 col-form-label">Product</label>
                                            <div class="col-sm-8">

                                                <div class="row">

                                                    <div class="col-sm-8">


                                                        <?php


                                                        echo ' <select class="form-control" name="p_id" id="p_id"   required>';
                                                        echo ' <option  value=0> Product </option>';
                                                        $database->loadAllProducts($row['p_id']);
                                                        echo '</select>';


                                                        ?>

                                                    </div>

                                                    <div class="col-sm-2">


                                                        <input type="text" class="form-control" name="p_qty" id="p_qty">


                                                    </div>

                                                    <button type="button"  onclick="add_item(<?=$in_id?>,$('#p_id option:selected').val(),$('#p_qty').val(),'inv')"  class="btn btn-primary ">Add</button>

                                                </div>


                                            </div>


                                        </div>


                                        <div id="main" class="card-body">
                                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Code</th>
                                                    <th><?= $lang['Name'] ?></th>
                                                    <th><?= $lang['Amount'] ?></th>

                                                    <th>Qty</th>
                                                    <th>Sub Total</th>


                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php
                                                $i = 1;
                                                $tot=0;
                                                while ($row = mysqli_fetch_assoc($result_adon_list)) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><a href="package.php?s_id=<?= base64_encode($row['p_id']) ?>"><?= $row['p_id'] ?></a></td>

                                                        <td><?= $row['p_id'] ?></td>
                                                        <td><?= printAmount($row['int_amount']) ?></td>


                                                        <td><?= $row['int_qty'] ?></td>
                                                        <td><?= printAmount($row['int_amount']*$row['int_qty']) ?></td>

                                                        <?php $tot=$tot+$row['int_amount']*$row['int_qty']; ?>
                                                    </tr>
                                                <?php } ?>



                                                </tbody>

                                                <tfoot>
                                                <tr>
                                                    <th colspan="5">Total  </th>

                                                    <th id="tot"><?=printAmount($tot)?></th>


                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>



<!--                                        <a href="../inc/print.php?in_id=--><?//=base64_encode($in_id)?><!--" target="_blank"><button type="button" style="float: right"  href="" class="btn btn-primary">Proceed</button></a>-->


                                        <a href="./invoice_list.php" ><button type="button" style="float: right"  href="" class="btn btn-primary">Proceed</button></a>
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




    <!-- /.content-wrapper -->
    <?php include_once './footer.php'; ?>

</div>

 

</body>
</html>