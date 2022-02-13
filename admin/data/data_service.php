<?php

include_once '../session.php';


 

if (isset($_GET['s_id'])) {
    $s_id = base64_decode($_GET['s_id']);
} else {
    $s_id = 0;
}



if ($s_id > 0) {


    $sql = "select * from services  where s_id='" . $s_id . "'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}



            
	