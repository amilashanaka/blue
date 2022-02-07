<?php

$sql="select * from  invoice where in_id='$in_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


    
    

    $u_name=get_username($row['u_id'],$conn);
    $contact_number=get_contact_number($row['in_id'],$conn);
    $address=get_address($row['in_id'],$conn);
    $date=get_date($row['in_id'],$conn);
    $price=get_price($row['pk_id'],$conn);
    $pay_type=get_payment_type($row['in_id'],$conn);
    $in_num=get_invoice_number($row['in_id'],$conn);

    $pk_name=get_pk_name_by_pkg_id($row['pk_id'],$conn);
       

   
    
$html='
<style>
* {
    font-size: 12px;
    font-family: \'Times New Roman\';
}


th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
    
}

td{
    height:30px;
    border-top: 1px dotted black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 95px;
    max-width: 95px;
    padding-left:10px;
    text-align:left;

  
    
}

td.quantity,
th.quantity {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
    text-align:center;
    
   
    
}

td.price,
th.price {
    width: 60px;
    max-width: 60px;
    word-break: break-all;
    text-align:right;
    
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 305px;
    max-width: 305px;
}

.center {
    margin-left: auto;
    margin-right: auto;
  }

.total{
     
     padding-left:50px;
     font-style:bold;

}

.double_line {
    border-bottom: 4px double #333;
    padding: 10px 0;
}

.line{
    margin-top: -10px;
}

.logo{
    height:70px;
    width:200px;
    margin-left:50px;
    
}

@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
</style>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Receipt example</title>
    </head>
    <body>
 
        <div class="ticket">
        <img src="https://baywash.com.my/admin/admin/img/logo.png" class="logo" alt="Logo"/>
            
        <p class="centered">BAYWASH AUTO-DETAILING SPECIALIST<br>CENTRE<br>DA MEN<br>SUBANG JAYA<br>Customer Name: '.$u_name.'<br>Contact Number :'.$contact_number.'  <br>Address: '.$address.'<br>Date: '.$date.'<br>Payment Type: '.$pay_type.'<br>Price:'.printAmount($price).'<br>Invoice Number:'.$in_num.'<br> Package :'.$pk_name.'</p>
            
            
           
            <br>
            <div class="double_line"></div>
            <br><br>
            
            <p class="centered">THANK YOU! See you again!..
                <br>Please like us on Facebook & Instagram 
                <br>#baywashmalaysia
                <br>HOTLINE: 010 200 4286 </p>
        </div>
   
    </body>
';