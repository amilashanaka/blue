<?php
include_once '../session.php';
include_once '../../inc/functions.php';

if (isset($_GET['cu_id']))
{
    $cu_id  = base64_decode($_GET['cu_id']);
}
else
{
    $cu_id  = 0;
}

if ($cu_id > 0)
{

    $sql    = "select * from currency where cu_id='" . $cu_id . "'";
    $result = mysqli_query($conn, $sql);
    $row    = mysqli_fetch_assoc($result);
}


	