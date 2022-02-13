<?php

include_once '../session.php';
include_once '../../inc/functions.php';

 

if (isset($_GET['pk_id'])) {
    $pk_id = base64_decode($_GET['pk_id']);
} else {
    $pk_id = 0;
}


if ($pk_id > 0) {


    $sql = "select * from packages  where pk_id='" . $pk_id . "'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}



            
	