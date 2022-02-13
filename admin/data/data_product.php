<?php

include_once '../session.php';
include_once '../../inc/functions.php';

 

if (isset($_GET['p_id'])) {
    $p_id = base64_decode($_GET['p_id']);
} else {
    $p_id = 0;
}


if ($p_id > 0) {


    $sql = "select * from products  where p_id='" . $p_id . "'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}



            
	