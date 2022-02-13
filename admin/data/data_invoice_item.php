<?php

include_once '../session.php';
include_once '../../inc/functions.php';

 

if (isset($_GET['in_id'])) {
    $in_id= base64_decode($_GET['in_id']);
} else {
    $in_id = 0;
}


$sql_adon_list    = "select * from  invoice_item where in_id='$in_id'";
$result_adon_list = mysqli_query($conn, $sql_adon_list);



            
	