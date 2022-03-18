<?php
include_once './top_header.php';



if (isset($_GET['error']))
{
    $error = $_GET['error'];
}
else
{
    $error = '';
}
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
 

        <?php include_once './navbar.php'; ?>



        <?php include_once './sidebar.php'; ?>
        <?php include_once './dashboard.php'; ?>

        <?php include_once './control-sidebar.php'; ?>

        <?php include_once './footer.php'; ?>
    </div>

</body>
</html>
