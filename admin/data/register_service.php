<?php

 include_once '../../conn.php';
 include_once '../../inc/functions.php';
 include_once '../../inc/imageUpload.php';

 //Fetching Values from URL
if (isset($_POST['s_id'])) { $s_id= $_POST['s_id'];}else{ $s_id= 0;}
if (isset($_POST['s_name'])) { $s_name= $_POST['s_name'];}else{ $s_name= ' ';}
if (isset($_POST['s_desc'])) { $s_desc= $_POST['s_desc'];}else{ $s_desc= '';}
if (isset($_POST['s_amount'])) { $s_amount= $_POST['s_amount'];}else{ $s_amount= '';}
if (isset($_POST['s_cost'])) { $s_cost= $_POST['s_cost'];}else{ $s_cost= '';}
if (isset($_POST['s_discount'])) { $s_discount= $_POST['s_discount'];}else{ $s_discount= 0;}


if (isset($_POST['s_created_by'])) { $s_created_by= $_POST['s_created_by'];}else{ $s_created_by= 0;}
if (isset($_POST['s_created_dt'])) { $s_created_dt= $_POST['s_created_dt'];}else{ $s_created_dt= '';}
if (isset($_POST['s_updated_by'])) { $s_updated_by= $_POST['s_updated_by'];}else{ $s_updated_by= 0;}
if (isset($_POST['s_updated_dt'])) { $s_updated_dt= $_POST['s_updated_dt'];}else{ $s_updated_dt= null;}
if (isset($_POST['s_status'])) { $s_status= $_POST['s_status'];}else{ $s_status= 0;}


//Action 
$action = $_POST['action'];
 
// image location 
$target_dir = "../../uploads/admin/services/";
$targ_front="../uploads/admin/services/";
$tmp =getResizeImg("s_img_file", $target_dir,422,552);


if($tmp!=''){

    $s_img=$targ_front.$tmp;
}else{
    $s_img='';
}



     
if ($action == 'register') {

    if ($s_name != '') {

        $sql_check = "SELECT * FROM services WHERE s_name='" . $s_name . "'";
        $result = mysqli_query($conn, $sql_check);



        if (mysqli_num_rows($result) > 0) {
            header('Location: ../service.php?error=' . base64_encode(10));
        } else {

            if (add_services($s_name,$s_img, $s_desc, $s_amount, $s_cost, $s_discount,$s_created_by, $s_created_dt, $s_status,$conn)) {

                header('Location: ../service_list.php?error=' . base64_encode(4));
            } else {
                header('Location: ../service.php?error=' . base64_encode(3));
            }
        }
    } else {
        header('Location: ../service.php?error=' . base64_encode(3));
    }
}



if ($action == 'update' && $s_id > 0) {


    $result= update_services($s_id,$s_name,$s_img, $s_desc, $s_amount, $s_cost, $s_discount,$s_updated_by, $s_updated_dt, $s_status,$conn);

    $result=implode(" ",$result);

    if ($result!=null) {

        header('Location: ../service.php?s_id=' . base64_encode($s_id) . '&error=' . base64_encode(1).'&info='.  base64_encode($result));

    } else {
        header('Location: ../service.php?s_id=' . base64_encode($s_id) . '&error=' . base64_encode(3));

    }
}


 
 