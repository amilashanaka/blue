<?php
    include_once './top_header.php';

    include_once './data/data_list.php';
?>


<body class="hold-transition sidebar-mini">


    <?php
    if (isset($_GET['error'])) {
        $error = base64_decode($_GET['error']);
        echo '<script>  error_by_code(' . $error . ');</script>';
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
            
            $t1=$lang['Vehicles'];
            $t2= $lang['List'];
            
            include_once './page_header.php';
            
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                         
                        <div class="card">
                          
                            <div class="card-header">
                                <h3 class="card-title" >
                                    <button  type="button" class="btn btn-block  btn-outline-secondary" onclick="location.href = 'vehicle.php';"><?=$lang['Add New']?></button>
                                  
                                </h3>
                            </div>
                             
                            <!-- /.card-header -->
                            <div class="card-body">
                                 <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     <thead>
                                         <tr>
                                             <th>#</th>
                                             <th><?=$lang['Vehicle Number']?></th>
                                             <th><?=$lang['Vehicle Owner']?></th>
                                             <th><?=$lang['Register Date']?></th>
                                             <th><?=$lang['Vehicle Type']?></th>
                                             <th><?=$lang['Make']?></th>
                                             <th><?=$lang['Model']?></th>
                                             <th><?=$lang['New Invoice']?></th>

                                         </tr>
                                     </thead>
                                     <tfoot>
                                     <tr>
                                         <th>#</th>
                                         <th><?=$lang['Vehicle Number']?></th>
                                         <th><?=$lang['Vehicle Owner']?></th>
                                         <th><?=$lang['Register Date']?></th>
                                         <th><?=$lang['Vehicle Type']?></th>
                                         <th><?=$lang['Make']?></th>
                                         <th><?=$lang['Model']?></th>
                                         <th><?=$lang['New Invoice']?></th>


                                     </tr>
                                     </tfoot>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result_vehicle_list)) {
                                            
                                            
                                            ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><a href="vehicle.php?v_id=<?= base64_encode($row['v_id'])?>"><?= $row['v_number'] ?></a></td>
                                                <td><a href="user.php?u_id=<?= base64_encode($row['v_owner'])?>"> <?= getUserName($row['v_owner'],$conn) ?></a> </td>
                                                <td><?= $row['v_created_dt'] ?></td>
                                                <td><?= $row['v_type'] ?></td>
                                                <td><?= $row['v_make'] ?></td>
                                                <td><?= $row['v_model'] ?></td>
                                                <td>  <button type="button"  class="btn btn-block btn-outline-info btn-flat"  onclick="location.href = 'invoice.php?v_id=<?=base64_encode($row['v_id']) ?>';"><i class="fa fa-info" aria-hidden="true"></i></button></td>
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