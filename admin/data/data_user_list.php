<?php

include_once '../session.php';

if (isset($_GET['u_type'])) {
    $u_type = base64_decode($_GET['u_type']);
} else {
    $u_type = 0;
}





    $sql = "select * from users where u_type='".$u_type."' ORDER BY u_id DESC";


$result = mysqli_query($conn, $sql);



