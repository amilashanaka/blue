<?php 
  
include_once './top_header.php';

?>

<style>
    
    .lockscreen-image>img {
    border-radius: 50%;
    height: 80px;
    width: 88px;
}
</style>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="../../index2.html"><b><?=$lang['APP_NAME']?></b>LOCK</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name"><?= $_SESSION['login_name']  ?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
        <img src="img/lock.png" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" class="form-control" placeholder="password">

        <div class="input-group-append">
            <button onclick="logout()" type="button" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Session Is Locked 
  </div>
  <div class="text-center">
      <a href="data/logout.php">Or sign in as a different user</a>
  </div>
  
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
