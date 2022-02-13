<?php

include_once '../session.php';
include_once '../../inc/functions.php';

if (isset($_GET['type'])) {
    $a_type = base64_decode($_GET['type']);
} else {
    $a_type = 0;
}

if (isset($_GET['a_id'])) {
    $a_id = base64_decode($_GET['a_id']);
} else {
    $a_id = 0;
}

if ($a_id > 0) {


    $sql = "select * from admins where a_id='" . $a_id . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}



            
	