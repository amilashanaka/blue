<?php

 include_once '../../conn.php';
 include_once '../../inc/functions.php';
 include_once '../../inc/imageUpload.php';

 //Fetching Values from URL
if (isset($_POST['v_id'])) { $v_id= $_POST['v_id'];}else{ $v_id= 0;}
if (isset($_POST['v_number'])) { $v_number= $_POST['v_number'];}else{ $v_number= ' ';}
if (isset($_POST['v_type'])) { $v_type= $_POST['v_type'];}else{ $v_type= '';}
if (isset($_POST['v_model'])) { $v_model= $_POST['v_model'];}else{ $v_model= '';}
if (isset($_POST['v_mileage'])) { $v_mileage= $_POST['v_mileage'];}else{ $v_mileage=0;}
if (isset($_POST['v_make'])) { $v_make= $_POST['v_make'];}else{ $v_make= '';}
if (isset($_POST['v_desc'])) { $v_desc= $_POST['v_desc'];}else{ $v_desc= '';}
if (isset($_POST['v_owner'])) { $v_owner= $_POST['v_owner'];}else{ $v_owner= '';}
if (isset($_POST['v_size'])) { $v_size= $_POST['v_size'];}else{ $v_size= 0;}
if (isset($_POST['v_created_by'])) { $v_created_by= $_POST['v_created_by'];}else{ $v_created_by= 0;}
if (isset($_POST['v_created_dt'])) { $v_created_dt= $_POST['v_created_dt'];}else{ $v_created_dt= '';}
if (isset($_POST['v_updated_by'])) { $v_updated_by= $_POST['v_updated_by'];}else{ $v_updated_by= 0;}
if (isset($_POST['v_updated_dt'])) { $v_updated_dt= $_POST['v_updated_dt'];}else{ $v_updated_dt= null;}
if (isset($_POST['v_status'])) { $v_status= $_POST['v_status'];}else{ $v_status= 0;}


//Action 
$action = $_POST['action'];
 
// image location 
$target_dir = "../../uploads/admin/vehicles/";
$targ_front="../uploads/admin/vehicles/";
$tmp =getResizeImg("v_img_file", $target_dir,700,400);


if($tmp!=''){

    $v_img=$targ_front.$tmp;
}else{
    $v_img='';
}

 

     
if ($action == 'register') {

    if ($v_number != '') {

        $sql_check = "SELECT * FROM vehicles WHERE v_number='" . $v_number . "'";
        $result = mysqli_query($conn, $sql_check);



        if (mysqli_num_rows($result) > 0) {
            header('Location: ../vehicle.php?error=' . base64_encode(10));
        } else {

            if (add_vehicles($v_number,$v_type, $v_model, $v_mileage, $v_make, $v_img, $v_desc,$v_owner, $v_size, $v_created_by, $v_created_dt, $v_status,$conn)) {

                header('Location: ../vehicle_list.php?error=' . base64_encode(4));
            } else {
                header('Location: ../vehicle.php?error=' . base64_encode(3));
            }
        }
    } else {
        header('Location: ../vehicle.php?error=' . base64_encode(3));
    }
}



if ($action == 'update' && $v_id > 0) {


    $result= update_vehicles($v_id,$v_number,$v_type, $v_model,$v_mileage, $v_make, $v_img, $v_desc,$v_owner, $v_size, $v_updated_by, $v_updated_dt, $v_status,$conn);

    $result=implode(" ",$result);

    if ($result!=null) {

        header('Location: ../vehicle.php?v_id=' . base64_encode($v_id) . '&error=' . base64_encode(1).'&info='.  base64_encode($result));

    } else {
        header('Location: ../service.php?v_id=' . base64_encode($v_id) . '&error=' . base64_encode(3));

    }
}