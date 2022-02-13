<?php

 include_once '../../conn.php';
 include_once '../../inc/functions.php';
 

 //Fetching Values from URL
if (isset($_POST['cu_id'])) { $cu_id= $_POST['cu_id'];}else{ $cu_id= 0;}
if (isset($_POST['cu_name'])) { $cu_name= $_POST['cu_name'];}else{ $cu_name= 0;}
if (isset($_POST['cu_rate'])) { $cu_rate= $_POST['cu_rate'];}else{ $cu_rate= '';}
if (isset($_POST['cu_withdraw_rate'])) { $cu_withdraw_rate= $_POST['cu_withdraw_rate'];}else{ $cu_withdraw_rate= '';}
if (isset($_POST['cu_symbol'])) { $cu_symbol= $_POST['cu_symbol'];}else{ $cu_symbol= '';}
if (isset($_POST['cu_created_by'])) { $cu_created_by= $_POST['cu_created_by'];}else{ $cu_created_by= '';}
if (isset($_POST['cu_created_date'])) { $cu_created_date= $_POST['cu_created_date'];}else{ $cu_created_date= 0;}
if (isset($_POST['cu_updated_by'])) { $cu_updated_by= $_POST['cu_updated_by'];}else{ $cu_updated_by= 0;}
if (isset($_POST['cu_bank'])) { $cu_bank= $_POST['cu_bank'];}else{ $cu_bank= '';}



 


//Action 
$action = $_POST['action'];
 
// image location 
//$target_dir = "../../uploads/admin/profile/";
//$m_img = uploadPic("user_profile_image", $target_dir);

// manage admin levels 
  
//date 
$today = date('Y-m-d');

     
     if ($action == 'register') {
          
          if ($cu_name != '' && $cu_rate != ''  && $cu_withdraw_rate != '' ) {
       
            $sqlcheck = "SELECT * FROM currency WHERE cu_name='" . $cu_name . "'";
            $result = mysqli_query($conn, $sqlcheck);
            
            

            if (mysqli_num_rows($result) > 0) {
                header('Location: ../currency.php?error='.base64_encode(8));
            } else {
                $sql = "INSERT INTO `currency` ( `cu_name`, `cu_rate`, `cu_withdraw_rate`, `cu_symbol`, `cu_created_by`, `cu_created_date`,`cu_status`, `cu_bank`) VALUES ( '".$cu_name."', '".$cu_rate."', '".$cu_withdraw_rate."', '".$cu_symbol."', '".$cu_created_by."',CURRENT_TIMESTAMP, '1', '".$cu_bank."')";
                
                
              
                if (mysqli_query($conn, $sql)) {

                    header('Location: ../currency_list.php?error='.base64_encode(4));
                } else {
                    header('Location: ../currency.php?error='.base64_encode(3));
                }
            }
    
    } else {
        header('Location: ../currency.php?error='.base64_encode(3));
    }
         
     }
     
     
   
 if ($action == 'update' && $cu_id > 0) {


    $sql = "update currency set  cu_name='" . $cu_name . "',`cu_rate`='" . $cu_rate . "', `cu_withdraw_rate`='" . $cu_withdraw_rate . "', `cu_symbol`='" . $cu_symbol . "', `cu_updated_by`='" . $cu_updated_by . "', `cu_updated_date`='" . $today . "',`cu_bank`='" . $cu_bank . "'  where cu_id='" . $cu_id . "'";
   
    if (mysqli_query($conn, $sql)) {

        header('Location: ../currency.php?cu_id=' . base64_encode($cu_id) . '&error='. base64_encode(1));
    } else {
        header('Location: ../currency.php?cu_id=' . base64_encode($cu_id) . '&error='. base64_encode(3));
    }
}


 
