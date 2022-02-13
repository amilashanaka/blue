<?php
    include_once './top_header.php';

    include_once './data/data_currency_list.php';
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
            
            $t1="Currency";
            $t2= "  List";
            
            include_once './page_header.php';
            
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                         
                        <div class="card">
                          
                            <div class="card-header">
                                <h3 class="card-title" >
                                    <button  type="button" class="btn btn-block  btn-outline-secondary" onclick="location.href = 'currency.php';">Add New currency</button>
                                  
                                </h3>
                            </div>
                             
                            <!-- /.card-header -->
                            <div class="card-body">
                                 <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>Name </th>
                                             <th>Rate</th>
                                             <th>Withdrawal Rate </th>
                                             <th>Symbol</th>
                                             <th style="width:3%; text-align: center;">Action</th>
                                         </tr>
                                     </thead>
                                     <tfoot>
                                         <tr>
                                             <th>#</th>
                                             <th>Name </th>
                                             <th>Rate</th>
                                             <th>Withdrawal Rate </th>
                                             <th>Symbol</th>
                                             <th style="width:3%; text-align: center;">Action</th>
                                         </tr>
                                     </tfoot>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><a href="currency.php?cu_id=<?php echo base64_encode($row['cu_id']); ?>"><?php echo $row['cu_name']; ?></a></td>
                                                 <td><?php echo $row['cu_rate']; ?></td>
                                                 <td><?php  echo $row['cu_withdraw_rate']; ?></td>
                                                 <td><?php echo $row['cu_symbol']; ?></td>
                                                 <td>
                                                     <?php if ($row['cu_status'] == '1') { ?><button type="button" id="btnm<?php echo $row['cu_id']; ?>" class="btn btn-block btn-outline-danger btn-flat" onclick="delete_record('<?php echo $row['cu_id']; ?>', 'cu', 'cu_id', '0');"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                    <?php } else { ?>
                                                        <button type="button" id="btnm<?php echo $row['cu_id']; ?>" class="btn btn-block btn-outline-success btn-flat" onclick="activate_record('<?php echo $row['cu_id']; ?>', 'cu', 'cu_id', '0');"><i class="fa fa-check "  ></i></button>
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
