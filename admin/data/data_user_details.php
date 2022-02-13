<?php
include_once '../../conn.php';
include_once '../../inc/functions.php';

$id = $_POST['u_id'];



$sql    = "select * from users where u_id='$id'";
$result = mysqli_query($conn, $sql);
$res    = mysqli_fetch_assoc($result);

$u_name= $res['u_name'];





$json = json_encode($res);

echo   $json;