<?php

include_once '../session.php';
include_once '../../inc/functions.php';

 

if (isset($_GET['u_id'])) {
    $u_id = base64_decode($_GET['u_id']);
} else {
    $u_id = 0;
}

if (isset($_GET['u_type'])) {
    $u_type = base64_decode($_GET['u_type']);
} else {
    $u_type = 0;
}

if ($u_id > 0) {


    $sql = "select * from users where u_id='" . $u_id . "'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}



            
	