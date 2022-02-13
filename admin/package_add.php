<?php

include_once './top_header.php';
include_once 'data/data_package_item.php';

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
        $t1 = "Package Item";
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
                                <form action="data/register_package.php" class="templatemo-login-form" method="post" enctype="multipart/form-data" name="update_vehicles">
                                        <?php


                                        echo '<input type="hidden" name="action" value="register">';
                                        echo '<input type="hidden" name="pk_created_dt" value="'.$today.'">';
                                        echo '<input type="hidden" name="pk_created_by" value="'.$user_act.'">';


                                        echo '<input type="hidden" name="action" value="update">';
                                        echo '<input type="hidden" name="pk_id" value="'.$pk_id.'">';
                                        echo '<input type="hidden" name="pk_updated_dt" value="'.$today.'">';
                                        echo '<input type="hidden" name="pk_updated_by" value="'.$user_act.'">';

                                        ?>

                                        <div class="row mb-3">
                                            <label for="in_name" class="col-sm-2 col-form-label">Service</label>
                                            <div class="col-sm-8">

                                                <div class="row">

                                                    <div class="col-sm-8">


                                                        <?php

                                                        /*echo ' <select class="form-control" name="s_id" id="s_id"   required>';
                                                        echo ' <option  value=0> Select </option>';
                                                        $database->loadAllServices($row['s_id']);
                                                        echo '</select>';*/

                                                        $result=$conn->query("SELECT s_id,s_name from services");
                                                        echo '<select class="selectpicker form-control"  name="s_id" id="s_id"  data-live-search="true" required>';

                                                        while ($typ=$result->fetch_assoc())
                                                         {
                                                             $user_name=$typ['s_name'];
                                                             echo '<option value="' . $typ['s_id'] . '" ' .
                                                             ($row['s_id'] == $typ['s_id'] ? "selected" : "") . ' >' . $typ['s_name'] . '</option>';
                                                         }
                                                          echo '</select>';
                                                         ?>

                                                    </div>

                                                    <div class="col-sm-2">


                                                        <input type="number"  placeholder="Qty" class="form-control" id="s_qty"  name="s_qty">


                                                    </div>

                                                    <button type="button" onclick="add_service(<?=$pk_id?>,$('#s_id option:selected').val(),$('#s_qty').val(),'pkg')" class="btn btn-primary ">Add</button>

                                                </div>


                                            </div>


                                        </div>

                                        <div class="row mb-3">
                                            <label for="in_name" class="col-sm-2 col-form-label">Product</label>
                                            <div class="col-sm-8">

                                                <div class="row">

                                                    <div class="col-sm-8">


                                                        <?php

                                                        /*echo ' <select class="form-control" name="p_id" id="p_id"   required>';
                                                        echo ' <option  value=0> Product </option>';
                                                        $database->loadAllProducts($row['p_id']);
                                                        echo '</select>';*/

                                                        $result=$conn->query("SELECT p_id,p_name from products");
                                                        echo '<select class="selectpicker form-control"  name="p_id" id="p_id"  data-live-search="true" required>';

                                                        while ($typ=$result->fetch_assoc())
                                                         {
                                                             $user_name=$typ['p_name'];
                                                             echo '<option value="' . $typ['p_id'] . '" ' .
                                                             ($row['p_id'] == $typ['p_id'] ? "selected" : "") . ' >' . $typ['p_name'] . '</option>';
                                                         }
                                                          echo '</select>';

                                                        ?>

                                                    </div>

                                                    <div class="col-sm-2">


                                                        <input type="text" class="form-control" placeholder="Qty" name="p_qty" id="p_qty">


                                                    </div>

                                                    <button type="button"  onclick="add_item(<?=$pk_id?>,$('#p_id option:selected').val(),$('#p_qty').val(),'pkg')"  class="btn btn-primary ">Add</button>

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
                                                    <th>Qty</th>
                                                   
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php

                                                $i = 1;
                                                $tot=0;
                                                while ($row = mysqli_fetch_assoc($result_adon_list)) {
                                                    if($row['p_id']>0){
                                                        $name=get_product_name($row['p_id'],$conn);
                                                        $item_code=get_product_code($row['p_id'],$conn);
                                                    }else{
                                                        $name=get_service_nsme($row['s_id'],$conn);
                                                        $item_code=get_service_code($row['s_id'],$conn);
                                                    }
                                                     ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $item_code ?></td>
                                                        <td><?= $name ?></td>
                                                        <td><?= $row['int_qty'] ?></td>
                                                       
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>



                                    </form>
                                </div>

                                <a href="../admin/package_list.php"><button type="button" style="float: right"  href="" class="btn btn-primary"><?= $lang['Save'] ?></button></a>
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