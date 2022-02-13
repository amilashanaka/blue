<?php

include_once './data/data_list.php';
?>


<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Search By Vehicles</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
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
                            <th><?=$lang['Package']?></th>

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
                            <th><?=$lang['Package']?></th>


                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result_vehicle_all_list)) {


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
                                <td>  <button type="button"  class="btn btn-block btn-outline-success btn-flat"  onclick="location.href = 'invoice.php?v_id=<?=base64_encode($row['v_id']) ?>';"><i class="fa fa-info" aria-hidden="true"></i></button></td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">

                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>