<?php
include_once './top_header.php';

include_once './data/data_admin_list.php';


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
            
            $t1=$lang['Admin User'];
            $t2= $lang['List'];
            
            include_once './page_header.php';
            
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->

                        <div class="card">
                              <?php if(abs($a_type-$_SESSION['login_type'])==1){ ?>
                            <div class="card-header">
                                <h3 class="card-title" >
                                  
                                    

                                    <button type="button" class="btn btn-app" onclick="location.href = 'admin.php?type=<?= base64_encode(2) ?>';"><i class="fas fa-user-plus"></i><?= $lang['Add New User'] ?></button>
                                  
                                </h3>
                            </div>
                              <?php }?>   
                            <!-- /.card-header -->
                            <div class="card-body">
                                 <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                             <tr>
                                            <th>#</th>
                                            <th><?= $lang['Name'] ?> </th>
                                            <th><?= $lang['Email'] ?></th>
                                            <th><?= $lang['Phone'] ?> </th>
                                            <th><?= $lang['Join Date'] ?></th>

                                          
                                             
                                            <th style="width:3%; text-align: center;"><?= $lang['Action'] ?></th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th><?= $lang['Name'] ?> </th>
                                            <th><?= $lang['Email'] ?></th>
                                            <th><?= $lang['Phone'] ?> </th>
                                            <th><?= $lang['Join Date'] ?></th>



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
                                                <td><a href="admin.php?a_id=<?php echo base64_encode($row['a_id']); ?>&type=<?php echo base64_encode($row['a_type']); ?>"><?php if ($row['a_username'] != '') {  echo $row['a_username'];}else if($row['a_name'] != ''){echo $row['a_name'];}  ?></a></td>
                                                 <td><?= $row['a_email']; ?></td>
                                                 <td><?php  echo $row['a_phone']; ?></td>
                                               
                                                 <td><?php echo printDate($row['a_register_date']); ?></td>

                                              
                                                <td>
                                                        <?php if ($row['a_status'] == '1') { ?><button type="button" id="btnm<?php echo $row['a_id']; ?>" class="btn btn-block btn-outline-danger btn-flat" onclick="delete_record('<?php echo $row['a_id']; ?>', 'a', 'a_id', '<?php echo base64_encode($a_type); ?>');"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <button type="button" id="btnm<?php echo $row['a_id']; ?>" class="btn btn-block btn-outline-success btn-flat" onclick="activate_record('<?php echo $row['a_id']; ?>', 'a', 'a_id', '<?php echo base64_encode($a_type); ?>');"><i class="fa fa-check "  ></i></button>
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
