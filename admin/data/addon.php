<?php

include_once '../../conn.php';
include_once '../../inc/functions.php';

//featch Data

$inv_id  = $_POST['inv_id'];
$item_id = $_POST['item_id'];
$qty     = $_POST['qty'];
$s_id    = $_POST['s_id'];
$type    = $_POST['type'];

if($type=="inv"){
    if($s_id>0){

        $item_id=0;
    }else{
        $s_id=0;
    }
    
    if ($item_id != null) {
        $amount = get_product_amount($item_id, $conn);
    } else {
        $amount = get_service_amount($s_id, $conn);
    }
    

    $sql="INSERT INTO `invoice_item` ( `in_id`, `s_id`, `p_id`, `int_qty`, `int_amount`, `int_status`) VALUES ('$inv_id', '$s_id', '$item_id', '$qty', '$amount', '1')";
    
    mysqli_query($conn, $sql);
    
    echo json_encode(array('res' => 1));  
}
elseif ($type=="pkg")
{
    if($s_id>0){

        $item_id=0;
    }else{
        $s_id=0;
    }
    
    if ($item_id != null) {
        $amount = get_product_amount($item_id, $conn);
    } else {
        $amount = get_service_amount($s_id, $conn);
    }
    

    $sql="INSERT INTO `package_item` ( `pk_id`, `s_id`, `p_id`, `int_qty`, `int_amount`, `pkt_status`) VALUES ('$inv_id', '$s_id', '$item_id', '$qty', '$amount', '1')";
    
    mysqli_query($conn, $sql);
    
    echo json_encode(array('res' => 1));

}






