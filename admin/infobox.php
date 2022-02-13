  <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> <?=$lang['Packages']?></span>
                <a href="package_list.php"><span class="info-box-number"><?=get_packages_count($conn)?></span></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cubes"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?=$lang['Products']?></span>
                <a href="product_list.php"><span class="info-box-number"><?=get_products_count($conn)?></span></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shower"></i></span>

              <div class="info-box-content">
                  
                <span class="info-box-text"><?=$lang['Services']?></span>
                <a href="service_list.php"><span class="info-box-number"><?=get_services_count($conn)?></span></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

             <div class="info-box-content">
                <span class="info-box-text"><?=$lang['Members']?></span>
                  <a href="user_list.php?u_type=<?=base64_encode(2)?>"><span class="info-box-number"><?=get_memeber_count($conn)?></span>
                  </a>
              </div>
            
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
