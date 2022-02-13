<?php

include_once '../session.php';
include_once '../../inc/functions.php';

 

if (isset($_GET['v_id'])) {
    $v_id = base64_decode($_GET['v_id']);
} else {
    $v_id = 0;
}

if (isset($_GET['v_type'])) {
    $v_type = base64_decode($_GET['v_type']);
} else {
    $v_type = 0;
}

if ($v_id > 0) {


    $sql = "select * from vehicles  where v_id='" . $v_id . "'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}



            
	