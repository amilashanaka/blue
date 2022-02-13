<?php

include_once '../session.php';

if (isset($_GET['type'])) {
    $a_type = base64_decode($_GET['type']);
} else {
    $a_type = 0;
}


$sql = "select * from admins where a_type ='2'ORDER BY a_id DESC";


$result = mysqli_query($conn, $sql);

