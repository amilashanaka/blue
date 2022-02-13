<?php

 include_once '../../conn.php';
 include_once '../../inc/functions.php';
 

 //Fetching Values from URL
if (isset($_POST['a_id'])) { $a_id= $_POST['a_id'];}else{ $a_id= 0;}
if (isset($_POST['a_type'])) { $a_type= $_POST['a_type'];}else{ $a_type= 0;}
if (isset($_POST['a_username'])) { $a_username= $_POST['a_username'];}else{ $a_username= '';}
if (isset($_POST['a_password'])) { $a_password= $_POST['a_password'];}else{ $a_password= '';}
if (isset($_POST['a_phone'])) { $a_phone= $_POST['a_phone'];}else{ $a_phone= '';}
if (isset($_POST['a_email'])) { $a_email= $_POST['a_email'];}else{ $a_email= '';}
if (isset($_POST['a_upline'])) { $a_upline= $_POST['a_upline'];}else{ $a_upline= 0;}
if (isset($_POST['a_currency'])) { $a_currency= $_POST['a_currency'];}else{ $a_currency= 0;}
if (isset($_POST['a_name'])) { $a_name= $_POST['a_name'];}else{ $a_name= '';}
if (isset($_POST['a_country'])) { $a_country= $_POST['a_country'];}else{ $a_country= '';}
if (isset($_POST['a_city'])) { $a_city= $_POST['a_city'];}else{ $a_city= '';}
if (isset($_POST['a_phone'])) { $a_phone= $_POST['a_phone'];}else{ $a_phone= '';}
if (isset($_POST['a_email'])) { $a_email= $_POST['a_email'];}else{ $a_email= '';}
if (isset($_POST['a_address'])) { $a_address= $_POST['a_address'];}else{ $a_address= '';}
if (isset($_POST['a_bank_name'])) { $a_bank_name= $_POST['a_bank_name'];}else{ $a_bank_name= '';}
if (isset($_POST['a_bank_account_no'])) { $a_bank_account_no= $_POST['a_bank_account_no'];}else{ $a_bank_account_no= '';} 
if (isset($_POST['a_bank_branach'])) { $a_bank_branach= $_POST['a_bank_branach'];}else{ $a_bank_branach= '';} 
if (isset($_POST['a_old_passs'])) { $a_old_passs= $_POST['a_old_passs'];}else{ $a_old_passs= '';} 
if (isset($_POST['a_new_pass'])) { $a_new_pass= $_POST['a_new_pass'];}else{ $a_new_pass= '';}
if (isset($_POST['a_confoirm_passs'])) { $a_confoirm_passs= $_POST['a_confoirm_passs'];}else{ $a_confoirm_passs= '';}
if (isset($_POST['a_ref'])) { $a_ref= $_POST['a_ref'];}else{ $a_ref= '';}
if (isset($_POST['ref_balance'])) { $ref_balance= $_POST['ref_balance'];}else{ $ref_balance= 0;}
if (isset($_POST['a_ref_wd'])) { $a_ref_wd= $_POST['a_ref_wd'];}else{ $a_ref_wd= 0;}

//a_ref_wd

//Action 
$action = $_POST['action'];


$hash_password = password_hash($a_password, PASSWORD_DEFAULT);
 
if($a_id==0){
     $a_ref=rand(1000, 9999);
}



if($a_currency==0){
    $a_currency=getAdminCurrency($a_upline,$conn);
}

if($a_country==''){
    
     $a_country= getAdmincountry($a_upline, $conn);
}

if($a_city==''){
    
    $a_city= getAdminCity($a_upline, $conn);
    
}
// image location 
//$target_dir = "../../uploads/admin/profile/";
//$m_img = uploadPic("user_profile_image", $target_dir);

// manage admin levels 

if ($a_type == 2) {
    $a_type5_by = 0;
    $a_type4_by = 0;
    $a_type3_by = 0;
    $a_type2_by = 0;
    $a_type1_by = 1;
} elseif ($a_type == 3) {

    $a_type5_by = 0;
    $a_type4_by = 0;
    $a_type3_by = 0;
    $a_type2_by = $a_upline;
    $a_type1_by = 1;
   
} elseif ($a_type == 4) {


    $a_type4_by = 0;
    $a_type5_by = 0;
    $a_type3_by = $a_upline;
    $a_type2_by = getaAdminUpline($a_upline, $conn);
    $a_type1_by = 1;
} elseif ($a_type == 5) {

    $a_type5_by = 0;
    $a_type4_by = $a_upline;
    $a_type3_by = getaAdminUpline($a_upline, $conn);
    $a_type2_by = getaAdminUpline($a_type3_by, $conn);
    $a_type1_by = 1;
} elseif ($a_type == 6) {

    $a_type5_by = $a_upline;
    $a_type4_by = getaAdminUpline($a_upline, $conn);
    $a_type3_by = getaAdminUpline($a_type4_by, $conn);
    $a_type2_by = getaAdminUpline($a_type3_by, $conn);
    $a_type1_by = 1;
}

 
//date 
$today = date('Y-m-d');

     
     if ($action == 'register') {
         
        

          if ($a_username != '' && $a_password != ''  && $a_currency >0 ) {
       
            $sqlcheck = "SELECT * FROM admins WHERE a_username='" . $a_username . "'";
            $result = mysqli_query($conn, $sqlcheck);
            
       

            if (mysqli_num_rows($result) > 0) {
                header('Location: ../admin.php?type=' . base64_encode($a_type). '&error='.base64_encode(5));
            } else {
                $sql = "INSERT INTO admins (a_username,a_name,a_password, a_type, a_type1_by, a_type2_by, a_type3_by, a_type4_by, a_type5_by,a_upline,a_currency,a_city,a_country,a_registered_by,a_register_date,a_ref,a_status) VALUES ('" . $a_username . "','" . $a_name . "', '" . $hash_password . "', '" . $a_type . "', '" . $a_type1_by . "', '" . $a_type2_by . "', '" . $a_type3_by . "', '" . $a_type4_by . "', '" . $a_type5_by . "','" . $a_upline . "','" . $a_currency . "', '" . $a_city . "', '" . $a_country . "', '" . $a_upline . "', '" . $today . "', '" . $a_ref . "','1')";
                 
                if (mysqli_query($conn, $sql)) {

                    header('Location: ../admin_list.php?type=' . base64_encode($a_type) . '&error='.base64_encode(4));
                } else {
                    header('Location: ../admin.php?type=' . base64_encode($a_type). '&error='.base64_encode(3));
                }
            }
    
    } else {
        header('Location: ../admin.php?type=' . base64_encode($a_type). '&error='.base64_encode(3));
    }
         
     }
     
     
   
 if ($action == 'update' && $a_id > 0) {


      $sql = "update admins set  a_name='" . $a_name . "', a_city='" . $a_city . "', a_country ='" . $a_country . "'  where a_id='" . $a_id . "'";
      
        if (mysqli_query($conn, $sql)) {

                     header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(1));
                } else {
                     header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(3));
                }
        
        

    if ($a_username != '') {

        $sqlcheck = "SELECT * FROM admins WHERE a_username='" . $a_username . "'";
        $result = mysqli_query($conn, $sqlcheck);



        if (mysqli_num_rows($result) == 0) {

            $sql = "update admins set  a_username='" . $a_username . "'   where a_id='" . $a_id . "'";

           if (mysqli_query($conn, $sql)) {

                     header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(1));
                } else {
                     header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(2));
                }
        } else {

             header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(3));
            exit();
        }
    }

}


 if ($action == 'update2' && $a_id > 0) {


      $sql = "update admins set  a_phone='" . $a_phone . "',a_email ='" . $a_email . "', a_address='" . $a_address . "'  where a_id='" . $a_id . "'";
   
    
        if (mysqli_query($conn, $sql)) {

                   header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(1));
                } else {
                     header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(2));
                }
       
}


 if ($action == 'update3' && $a_id > 0) {



      $sql = "update admins set  a_bank_name='" . $a_bank_name . "',a_bank_account_no ='" . $a_bank_account_no . "', a_bank_branach='" . $a_bank_branach . "'  where a_id='" . $a_id . "'";
   
     
        if (mysqli_query($conn, $sql)) {

                      header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(6));
                      exit();
                } else {
                    header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(3));
                }
       
}

 if ($action == 'pass' && $a_id > 0) {



    if (strcmp($a_new_pass, $a_confoirm_passs)) {


          header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(2));
        exit();
    }

    $hash_pw_2 = password_hash($a_new_pass, PASSWORD_DEFAULT);
    $sql = "update admins set  a_password='" . $hash_pw_2 . "'   where a_id='" . $a_id . "'";


    if (mysqli_query($conn, $sql)) {

          header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(7));
    } else {
         header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(3));
    }
}




if($action=='ref_withdraw'){
 
    
    $w_a_type_note='Ref Bonous Withdraw Request';
    $w_a_type_txt='Ref Bonous';
    $amount=currency_convert_to_usd_admin($a_id, $a_ref_wd, $conn) ;
    $tst=number_format($amount, 2, '.', '');
     $ref_balance_new=number_format($ref_balance, 2, '.', '');
   
    if($tst>$ref_balance_new){
           
   
          header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(14));
        exit();
        
    }else{
       
        if(withdraw_admin($a_id,$amount,1,2,$today,1,1,$today,$w_a_type_note,$w_a_type_txt,0,$conn)>0){
            withdraw_admin($a_id,$amount,1,4,$today,0,1,$today,$w_a_type_note,$w_a_type_txt,0,$conn);
           header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(13));  
        }else{
             header('Location: ../admin.php?a_id=' . base64_encode($a_id) . '&error='.base64_encode(2));
        }
    }
    
}

 