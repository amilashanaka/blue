

<?php
include_once './top_header_login.php';


if (isset($_GET['error'])) {
    $error = $_GET['error'];
} else {
    $error = '';
}
?>
<body>

<div class="login-form">
    <form action="data/data_login.php" method="post">
        <div class="top">
            <img src="dist/img/kode-icon.png" alt="icon" class="icon">
            <h2>Blue Telecoms</h2>
            <h4>SYSTEM></h4>


            <?php if ($error != '') { ?>
                <div class="row">
                    <div id="error_display" class=" text-danger">
                        <?php
                        if ($error == '0') {

                            echo "Please fill-in the Username and Password";
                        } else if ($error == '1') {
                            echo '<script>  swal("Invalid Username/Password", "Account not Active", "error");</script>';
                            echo "Invalid Username /Password or Account not Active.";
                        } else if ($error == '5') {
                            echo '<script>  swal("Invalid Captha Code", "Please Try Agin", "warning");</script>';
                            echo "Invalid Captha Code";
                        }else if ($error == 6) {
                            echo '<script>  swal("Security Alert", "Multiple Login", "warning");</script>';
                            echo "Security Alert";
                        }

                        ?>
                    </div>
                </div>
            <?php } ?>



        </div>
        <div class="form-area">
            <div class="group">
                <input type="text" id="a_username" name="a_username"  class="form-control" placeholder="Username">
                <i class="fa fa-user"></i>
            </div>
            <div class="group">
                <input type="password" id="a_password"  name="a_password" class="form-control" placeholder="Password">
                <i class="fa fa-key"></i>
            </div>

            <div class="group">
                <input autocomplete="off" class="form-control " placeholder="Captcha Code" name="captcha_code" type="text">
            </div>
            <div class="group center-block">
                <img style="margin-left: 103px"src="data/phpcaptcha.php" />
            </div>
            <div class="group " style="align-content: center;margin-left: 65px;">

                <a href="<?= $current_file ?>?lang=cn" style="color: #FFF;"> <img src="./img/china.png"></a>
                <span style="color: #FFDF00;"></span >
                <a href="<?= $current_file ?>?lang=my" style="color: #FFF;"> <img src="./img/my.png"></a>
                <span style="color: #FFDF00;"></span >

                <a href="<?= $current_file ?>?lang=en" class="text-center" style="color: #FFF;"><img src="./img/uk.png"></a>
                <span style="color: #FFDF00;"></span >

            </div>
            <button type="submit" class="btn btn-default btn-block"><?=$lang['LOGIN']?></button>

            <!--        <div class="col-xs-6"><a href="#"><i class="fa fa-external-link"></i> Register Now</a></div>-->
            <div style=" top: 2px;" class="col-xs-6 text-right"><a href="#"><i class="fa fa-lock"><?=$lang['Forgot password']?> </i> </a></div>

        </div>
    </form>

</div>

</body>
</html>