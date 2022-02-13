<?php

session_start();
include_once '../../conn.php';


if (isset($_GET['owner'])) {
    $owner = base64_decode($_GET['owner']);
} else {
    $owner = 0;
}

if ($owner > 0) {

    $sql_vehicle_list = " select * from vehicles where v_owner>0 ";

} else {

    $sql_vehicle_list = " select * from vehicles where v_owner=0";
}

$result_vehicle_list = mysqli_query($conn, $sql_vehicle_list);

$sql_all_vehicle  = " select * from vehicles  ";
$result_vehicle_all_list = mysqli_query($conn, $sql_all_vehicle);

//================================================================


$sql_service_list    = "select * from  services";
$result_service_list = mysqli_query($conn, $sql_service_list);


//==============================================================


$sql = "select * from currency ORDER BY cu_id DESC";


$result = mysqli_query($conn, $sql);


//================================================================




$sql_product_list    = "select * from  products";
$result_product_list = mysqli_query($conn, $sql_product_list);


//================================================================




$sql_packages_list    = "select * from  packages";
$result_packages_list = mysqli_query($conn, $sql_packages_list);


//================================================================




$sql_package_sold_list    = "select * from  pkg_sold";
$result_package_sold_list = mysqli_query($conn,$sql_package_sold_list);


$sql_invoice_list="select * from invoice";
$result_invoice_list=mysqli_query($conn,$sql_invoice_list);