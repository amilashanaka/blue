<?php

$sql="select * from  invoice_item where in_id='$in_id'";
$result = mysqli_query($conn, $sql);


$table="";
$tot=0;



while ($row = mysqli_fetch_assoc($result)) {

    $qty=$row['int_qty'];
    if($row['p_id']>0){
        $name=get_product_name($row['p_id'],$conn);
    }else{

        $name=get_service_nsme($row['s_id'],$conn);
    }
    
    $amt=$row['int_amount'];

    $sub_amt=$amt*$qty;
    $tot=$tot+$sub_amt;
    $table=$table.'  <tr>
                        <td class="quantity">'.$qty.'</td>
                        <td class="description">'.$name.'</td>
                        <td class="price">'.printAmount($amt).'</td>
                        <td class="price">'.printAmount($sub_amt).'</td>
                        
                    </tr>
                    
                    
                    ';
    
                    
    $date=get_invoice_Date($row['in_id'],$conn);
    $invoiceNo=get_invoice_number($row['in_id'],$conn);
    $u_name=get_username($row['in_id'],$conn);
    $v_number=get_vehicle_no($row['in_id'],$conn);
    $v_mileage=get_vehicle_mileage($row['in_id'],$conn);
    $pay_type=get_payment_type($row['in_id'],$conn);
}


$total_line='  <tr>
                        <td class="total" colspan="3" >Total<br>Grand</td>
                        
                        
                        <td class="price" >'.printAmount($tot).'<br>'.printAmount($tot).'</td>
                        
                    
                        
                    </tr>

                    
                    <tr>
                    <td class="total"  colspan="3" >Total<br>Tendered</td>
                    
                    
                    <td class="price" >'.printAmount($tot).'<br>'.printAmount($tot).'</td>
                    
                
                    
                </tr>
                    
                    
                    ';




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
            
        <p class="centered">BAYWASH AUTO-DETAILING SPECIALIST<br>CENTRE<br>DA MEN<br>SUBANG JAYA<br>Date: '.$date.'<br> BAY: 17 <br>Opened By: '.$u_name.'<br>Payment Type: '.$pay_type.'<br>Reg No: '.$v_number.'<br>Mileage:'.$v_mileage.'km</p>
            
            <p class="centered line" style="font-size: 16px; font-style: bold;">Invoice</p>
            <p class="centered line">(Receipt No:'.$invoiceNo.')</p>
            <table class="center">
                <thead>
                    <tr>
                        <th class="quantity">QTY</th>
                        <th class="description">ITEM</th>
                        <th class="price">PRICE<br>(RM)</th>
                        <th class="price">TOTAL<br>(RM)</th>
                    
                    </tr>
                </thead>

                
                <tbody>'.$table.$total_line.'</tbody>
                
            </table>
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