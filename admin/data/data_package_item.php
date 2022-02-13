<?php

include_once '../session.php';
include_once '../../inc/functions.php';

 

if (isset($_GET['pk_id'])) {
    $pk_id= base64_decode($_GET['pk_id']);
} else {
    $pk_id = 0;
}



    $sql_adon_list    = "select * from  package_item where pk_id='$pk_id'";
    $result_adon_list = mysqli_query($conn, $sql_adon_list);


