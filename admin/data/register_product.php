<?php

 include_once '../../conn.php';
 include_once '../../inc/functions.php';
 include_once '../../inc/imageUpload.php';

 //Fetching Values from URL
if (isset($_POST['p_id'])) { $p_id= $_POST['p_id'];}else{ $p_id= 0;}
if (isset($_POST['p_name'])) { $p_name= $_POST['p_name'];}else{ $p_name= ' ';}
if (isset($_POST['p_desc'])) { $p_desc= $_POST['p_desc'];}else{ $p_desc= '';}
if (isset($_POST['p_amount'])) { $p_amount= $_POST['p_amount'];}else{ $p_amount= '';}
if (isset($_POST['p_cost'])) { $p_cost= $_POST['p_cost'];}else{ $p_cost= '';}
if (isset($_POST['p_discount'])) { $p_discount= $_POST['p_discount'];}else{ $p_discount= 0;}
if (isset($_POST['p_exp_date'])) { $p_exp_date= $_POST['p_exp_date'];}else{ $p_exp_date= '';}
if (isset($_POST['p_stock'])) { $p_stock= $_POST['p_stock'];}else{ $p_stock= '';}


if (isset($_POST['p_created_by'])) { $p_created_by= $_POST['p_created_by'];}else{ $p_created_by= 0;}
if (isset($_POST['p_created_dt'])) { $p_created_dt= $_POST['p_created_dt'];}else{ $p_created_dt= '';}
if (isset($_POST['p_updated_by'])) { $p_updated_by= $_POST['p_updated_by'];}else{ $p_updated_by= 0;}
if (isset($_POST['p_updated_dt'])) { $p_updated_dt= $_POST['p_updated_dt'];}else{ $p_updated_dt= null;}
if (isset($_POST['p_status'])) { $p_status= $_POST['p_status'];}else{ $p_status= 0;}


//Action 
$action = $_POST['action'];
 
// image location 
$target_dir = "../../uploads/admin/products/";
$targ_front="../uploads/admin/products/";
$tmp =getResizeImg("p_img_file", $target_dir,600,400);


if($tmp!=''){

    $p_img=$targ_front.$tmp;
}else{
    $p_img='';
}



     
if ($action == 'register') {

    if ($p_name != '') {

        $sql_check = "SELECT * FROM services WHERE p_name='" . $p_name . "'";
        $result = mysqli_query($conn, $sql_check);



        if (mysqli_num_rows($result) > 0) {
            header('Location: ../product.php?error=' . base64_encode(10));
        } else {

            if (add_product($p_name,$p_img, $p_desc,$p_exp_date, $p_amount, $p_cost,$p_stock, $p_discount,$p_created_by, $p_created_dt, $p_status,$conn)) {

                header('Location: ../product_list.php?error=' . base64_encode(4));
            } else {
                header('Location: ../product.php?error=' . base64_encode(3));
            }
        }
    } else {
        header('Location: ../product.php?error=' . base64_encode(3));
    }
}



if ($action == 'update' && $p_id > 0) {


    $result= update_product($p_id,$p_name,$p_img, $p_desc,$p_exp_date, $p_amount, $p_cost,$p_stock, $p_discount,$p_updated_by, $p_updated_dt, $p_status,$conn);

    $result=implode(" ",$result);

    if ($result!=null) {

        header('Location: ../product.php?p_id=' . base64_encode($p_id) . '&error=' . base64_encode(1).'&info='.  base64_encode($result));

    } else {
        header('Location: ../product.php?p_id=' . base64_encode($p_id) . '&error=' . base64_encode(3));

    }
}


 
 