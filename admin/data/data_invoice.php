<?php

include_once '../session.php';
include_once '../../inc/functions.php';

 

if (isset($_GET['v_id'])) {
    $v_id = base64_decode($_GET['v_id']);



    $u_id=get_u_id__by_v_id( $conn,$v_id);


} else {
    $v_id = 0;
}
if (isset($_GET['pk_id'])) {
    $pk_id = base64_decode($_GET['pk_id']);
} else {
    $pk_id = 0;
}




            
	