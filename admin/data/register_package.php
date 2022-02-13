<?php

 include_once '../../conn.php';
 include_once '../../inc/functions.php';
 include_once '../../inc/imageUpload.php';

 //Fetching Values from URL
if (isset($_POST['pk_id'])) { $pk_id= $_POST['pk_id'];}else{ $pk_id= 0;}
if (isset($_POST['pk_name'])) { $pk_name= $_POST['pk_name'];}else{ $pk_name= '';}
if (isset($_POST['pk_desc'])) { $pk_desc= $_POST['pk_desc'];}else{ $pk_desc= '';}
if (isset($_POST['pk_amount'])) { $pk_amount= $_POST['pk_amount'];}else{ $pk_amount= 0;}
if (isset($_POST['pk_cost'])) { $pk_cost= $_POST['pk_cost'];}else{ $pk_cost= '';}
if (isset($_POST['pk_discount'])) { $pk_discount= $_POST['pk_discount'];}else{ $pk_discount= 0;}
if (isset($_POST['pk_exp_date'])) { $pk_exp_date= $_POST['pk_exp_date'];}else{ $pk_exp_date= 0;}

if (isset($_POST['pk_qty'])) { $pk_qty= $_POST['pk_qty'];}else{ $pk_qty= 0;}



if (isset($_POST['pk_created_by'])) { $pk_created_by= $_POST['pk_created_by'];}else{ $pk_created_by= 0;}
if (isset($_POST['pk_created_dt'])) { $pk_created_dt= $_POST['pk_created_dt'];}else{ $pk_created_dt= '';}
if (isset($_POST['pk_updated_by'])) { $pk_updated_by= $_POST['pk_updated_by'];}else{ $pk_updated_by= 0;}
if (isset($_POST['pk_updated_dt'])) { $pk_updated_dt= $_POST['pk_updated_dt'];}else{ $pk_updated_dt= null;}
if (isset($_POST['pk_status'])) { $pk_status= $_POST['pk_status'];}else{ $pk_status= 0;}

//Action 
$action = $_POST['action'];
 
// image location 
$target_dir = "../../uploads/admin/packages/";
$targ_front="../uploads/admin/packages/";
$tmp =getResizeImg("pk_img_file", $target_dir,422,552);


if($tmp!=''){

    $pk_img=$targ_front.$tmp;
}else{
    $pk_img='';
}



     
if ($action == 'register') {

    if ($pk_name != '') {

        $sql_check = "SELECT * FROM packages WHERE pk_name='" . $pk_name . "'";
        $result = mysqli_query($conn, $sql_check);



        if (mysqli_num_rows($result) > 0) {
            header('Location: ../service.php?error=' . base64_encode(10));
        } else {



            $insert_id= add_packages($pk_name,$pk_img, $pk_desc, $pk_amount, $pk_cost, $pk_discount,$pk_exp_date,$pk_qty,$pk_created_by, $pk_created_dt, $pk_status,$conn);

            if($insert_id>0) 
            {
                header('Location: ../package_add.php?error=' . base64_encode(4).'&pk_id='.base64_encode($insert_id));
            } else {
                header('Location: ../package.php?error=' . base64_encode(3));
            }
        }
    } else {
        header('Location: ../service.php?error=' . base64_encode(3));
    }
}



if ($action == 'update' && $pk_id > 0) {

    $result= update_packages($pk_id,$pk_name,$pk_img, $pk_desc, $pk_amount, $pk_cost, $pk_discount,$pk_qty,$pk_exp_date,$pk_updated_by, $pk_updated_dt, $pk_status,$conn);

    $result=implode(" ",$result);

    if ($result!=null) {

        header('Location: ../package_list.php?pk_id=' . base64_encode($pk_id) . '&error=' . base64_encode(1).'&info='.  base64_encode($result));

    } else {
        header('Location: ../package.php?pk_id=' . base64_encode($pk_id) . '&error=' . base64_encode(3));

    }
}