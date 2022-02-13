<?php

 include_once '../../conn.php';
 include_once '../../inc/functions.php';
 

 //Fetching Values from URL
if (isset($_POST['u_id'])) { $u_id= $_POST['u_id'];}else{ $u_id= 0;}

if (isset($_POST['u_username'])) { $u_username= $_POST['u_username'];}else{ $u_username= '';}
if (isset($_POST['u_password'])) { $u_password= $_POST['u_password'];}else{ $u_password= '';}
if (isset($_POST['u_phone'])) { $u_phone= $_POST['u_phone'];}else{ $u_phone= '';}
if (isset($_POST['u_email'])) { $u_email= $_POST['u_email'];}else{ $u_email= '';}
if (isset($_POST['u_currency'])) { $u_currency= $_POST['u_currency'];}else{ $u_currency= 0;}
if (isset($_POST['u_name'])) { $u_name= $_POST['u_name'];}else{ $u_name= '';}
if (isset($_POST['u_country'])) { $u_country= $_POST['u_country'];}else{ $u_country= '';}
if (isset($_POST['u_city'])) { $u_city= $_POST['u_city'];}else{ $u_city= '';}
if (isset($_POST['u_phone'])) { $u_phone= $_POST['u_phone'];}else{ $u_phone= '';}
if (isset($_POST['u_email'])) { $u_email= $_POST['u_email'];}else{ $u_email= '';}
if (isset($_POST['u_address'])) { $u_address= $_POST['u_address'];}else{ $u_address= '';}
if (isset($_POST['u_bank_name'])) { $u_bank_name= $_POST['u_bank_name'];}else{ $u_bank_name= '';}
if (isset($_POST['u_bank_account_no'])) { $u_bank_account_no= $_POST['u_bank_account_no'];}else{ $u_bank_account_no= '';} 
if (isset($_POST['u_bank_branach'])) { $u_bank_branach= $_POST['u_bank_branach'];}else{ $u_bank_branach= '';} 
if (isset($_POST['u_old_passs'])) { $u_old_passs= $_POST['u_old_passs'];}else{ $u_old_passs= '';} 
if (isset($_POST['u_new_pass'])) { $u_new_pass= $_POST['u_new_pass'];}else{ $u_new_pass= '';}
if (isset($_POST['u_confoirm_passs'])) { $u_confoirm_passs= $_POST['u_confoirm_passs'];}else{ $u_confoirm_passs= '';}
if (isset($_POST['u_otp'])) { $u_otp= $_POST['u_otp'];}else{ $u_otp= '';}
if (isset($_POST['u_ref'])) { $u_ref= $_POST['u_ref'];}else{ $u_ref= '';}
if (isset($_POST['u_ic_no'])) { $u_ic_no= $_POST['u_ic_no'];}else{ $u_ic_no= '';}
if (isset($_POST['u_ic_type'])) { $u_ic_type= $_POST['u_ic_type'];}else{ $u_ic_type= '';}
if (isset($_POST['u_type'])) { $u_type= $_POST['u_type'];}else{ $u_type= 0;}
if (isset($_POST['u_status'])) { $u_status= $_POST['u_status'];}else{ $u_status= 0;}



 

//Action 
$action = $_POST['action'];



$hash_password = password_hash($u_password, PASSWORD_DEFAULT);
 

// image location 
//$target_dir = "../../uploads/user/profile/";
//$m_img = uploadPic("user_profile_image", $target_dir);

// manage user levels 


//date 
$today = date('Y-m-d');

     
     if ($action == 'register') {
    
          if ($u_name != ''  && $u_phone !='') {
           
            $sqlcheck = "SELECT * FROM users WHERE u_name='" . $u_name . "'";
            $result = mysqli_query($conn, $sqlcheck);
            
             
            if (mysqli_num_rows($result) > 0) {

                header('Location: ../user.php?type=' . base64_encode($u_type). '&error='.base64_encode(5));
            } else {

                if (add_user($u_username,$u_name,$hash_password,$u_phone,$u_email,$u_type,$conn)) {

                    header('Location: ../user_list.php?u_type='. base64_encode($u_type).'error='.base64_encode(4));
                } else {
                    header('Location: ../user.php?error='.base64_encode(3));
                }
            }
    
    } else {
        header('Location: ../user.php?error='.base64_encode(3));
    }
         
     }
     
     
   
 if ($action == 'update' && $u_id > 0) {



     $result= update_user($u_id,$u_username,$u_name,$hash_password,$u_phone,$u_email,$u_type,$u_ic_no,$u_ic_type,$u_address,$u_status,$conn);
     $result=implode(" ",$result);

     if ($result!=null) {

         header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error=' . base64_encode(1).'&info='.  base64_encode($result));

     } else {
         header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error=' . base64_encode(3));

     }


}


 if ($action == 'update2' && $u_id > 0) {



     $result= update_user($u_id,$u_username,$u_name,$hash_password,$u_phone,$u_email,$u_type,$u_ic_no,$u_ic_type,$u_address,$u_status,$conn);
     $result=implode(" ",$result);

     if ($result!=null) {

         header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error=' . base64_encode(1).'&info='.  base64_encode($result));

     } else {
         header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error=' . base64_encode(3));

     }
       
}


 if ($action == 'update3' && $u_id > 0) {



      $sql = "update users set  u_bank_name='" . $u_bank_name . "',u_bank_account_no ='" . $u_bank_account_no . "', u_bank_branach='" . $u_bank_branach . "'  where u_id='" . $u_id . "'";
   
     
        if (mysqli_query($conn, $sql)) {

                header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error='.base64_encode(6));
                      exit();
                } else {
                    header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error='.base64_encode(3));
                }
       
}

 if ($action == 'pass' && $u_id > 0) {



    if (strcmp($u_new_pass, $u_confoirm_passs)) { 
        header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error='.base64_encode(2));
        exit();
    }elseif ($u_new_pass!='') {
         $hash_pw_2 = password_hash($u_new_pass, PASSWORD_DEFAULT);
    $sql = "update users set  u_password='" . $hash_pw_2 . "'   where u_id='" . $u_id . "'";


    if (mysqli_query($conn, $sql)) {

          header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error='.base64_encode(7));
    } else {
         header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error='.base64_encode(3));
    }
        
    }
    
    if($u_otp !=''){
        
         $sql = "update users set  u_otp='" . $u_otp . "'   where u_id='" . $u_id . "'";


    if (mysqli_query($conn, $sql)) {

          header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error='.base64_encode(7));
    } else {
         header('Location: ../user.php?u_id=' . base64_encode($u_id) . '&error='.base64_encode(3));
    }
        
        
    }

   
}

 