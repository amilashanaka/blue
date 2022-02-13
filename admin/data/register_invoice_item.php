<?php

 include_once '../../conn.php';
 include_once '../../inc/functions.php';


 //Fetching Values from URL
if (isset($_POST['in_id'])) { $in_id= $_POST['in_id'];}else{ $in_id= 0;}
if (isset($_POST['in_name'])) { $in_name= $_POST['in_name'];}else{ $in_name= ' ';}
if (isset($_POST['in_desc'])) { $in_desc= $_POST['in_desc'];}else{ $in_desc= '';}
if (isset($_POST['in_contact'])) { $in_contact= $_POST['in_contact'];}else{ $in_contact= '';}
if (isset($_POST['in_address'])) { $in_address= $_POST['in_address'];}else{ $in_cost= '';}
if (isset($_POST['in_date'])) { $in_date= $_POST['in_date'];}else{ $in_date= '';}
if (isset($_POST['in_amount'])) { $in_amount= $_POST['in_amount'];}else{ $in_amount= 0;}



if (isset($_POST['in_created_by'])) { $in_created_by= $_POST['in_created_by'];}else{ $in_created_by= 0;}
if (isset($_POST['in_created_dt'])) { $in_created_dt= $_POST['in_created_dt'];}else{ $in_created_dt= '';}
if (isset($_POST['in_updated_by'])) { $in_updated_by= $_POST['in_updated_by'];}else{ $in_updated_by= 0;}
if (isset($_POST['in_updated_dt'])) { $in_updated_dt= $_POST['in_updated_dt'];}else{ $in_updated_dt= null;}
if (isset($_POST['in_status'])) { $in_status= $_POST['in_status'];}else{ $in_status= 0;}


//Action 
$action = $_POST['action'];


if ($action == 'register') {


    $insert_id=add_invoice($in_name, $in_contact, $in_address, $in_desc, $in_date, $in_amount, $in_status, $in_created_by, $in_created_dt, $conn);
    if ($insert_id>0) {

        header('Location: ../invoice_add.php?error='.base64_encode(4).'&in_id='.base64_encode($insert_id));
    } else {
        header('Location: ../invoice.php?error='.base64_encode(3));
    }

}


if ($action == 'update' && $in_id > 0) {


    $result = update_invoice($in_id,$in_name, $in_contact, $in_address, $in_desc, $in_date, $in_amount, $in_status, $in_updated_by, $in_updated_dt, $conn);

    $result = implode(" ", $result);

    if ($result != null) {

        header('Location: ../service.php?in_id='.base64_encode($in_id).'&error='.base64_encode(1).'&info='.base64_encode($result));

    } else {
        header('Location: ../service.php?in_id='.base64_encode($in_id).'&error='.base64_encode(3));

    }
}


 
 