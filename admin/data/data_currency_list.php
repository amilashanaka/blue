<?php

include_once '../session.php';


if($_SESSION['login_type']==1){
    
    $sql = "select * from currency ORDER BY cu_id DESC";
    
}


$result = mysqli_query($conn, $sql);

