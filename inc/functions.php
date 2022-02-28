<?php

include_once '../inc/conn.php';
include_once '../inc/settings.php';
//users
function getAdminDetails($a_id, $conn)
{
    $sql = "SELECT * FROM admins where a_id='" . $a_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res;
}

function getAdminType($at_id, $conn)
{
    $sql = "SELECT * FROM admin_types where at_id='" . $at_id . "'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['at_name'];
}

function getAdminTypeByid($a_id, $conn)
{
    $sql = "SELECT * FROM admins where a_id='" . $a_id . "'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return getAdminType($res['a_type'], $conn);
}

function getAdminTypeIdByid($a_id, $conn)
{
    $sql = "SELECT * FROM admins where a_id='" . $a_id . "'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['a_type'];
}

function setSecKey($a_id, $conn)
{
    $sec_key = rand(1000, 9999);

    $sql = "update admins set  a_sec_key ='" . $sec_key . "'where a_id='" . $a_id . "'";
    if (mysqli_query($conn, $sql)) {
    } else {
        $sec_key = '0';
    }

    return $sec_key;
}

function getSecKey($a_id, $conn)
{
    $sql = "SELECT a_sec_key FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return (int)$res['a_sec_key'];
}

function getAdminCurrency($a_id, $conn)
{
    $sql = "SELECT a_currency FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return (int)$res['a_currency'];
}

function getUserCurrency($u_id, $conn)
{
    $sql = "SELECT u_currency FROM users WHERE u_id = '" . $u_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return (int)$res['u_currency'];
}

function getAdmincountry($a_id, $conn)
{
    $sql = "SELECT a_country FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['a_country'];
}

function getAdminCity($a_id, $conn)
{
    $sql = "SELECT a_city FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['a_city'];
}

function getCurrencyByCu_id($cu_id, $conn)
{
    $sql = "select cu_symbol from currency where cu_id= '" . $cu_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['cu_symbol'];
}

function getaAdminUserName($a_id, $conn)
{
    $sql = "SELECT a_username FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['a_username'];
}

function getUserName($u_id, $conn)
{
    $user = getUserDetails($u_id, $conn);

    return $user['u_name'];
}


function getUserDetails($u_id, $conn)
{
    $sql = "SELECT * FROM users WHERE u_id = '" . $u_id . "' and u_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res;
}

function currency_convert_to_usd($cur_id, $amount, $conn)
{
    $get_rate = "select cu_rate from currency where cu_id =" . $cur_id;
    $rate_result = mysqli_query($conn, $get_rate);
    $res_cur = mysqli_fetch_assoc($rate_result);
    $rate = $res_cur['cu_rate'];
    $converted = ($amount / $rate);

    return $converted;
}

function currency_convert_from_usd($cu_id, $amount, $conn)
{
    $get_rate = "select cu_withdraw_rate from currency where cu_id =" . $cu_id;
    $rate_result = mysqli_query($conn, $get_rate);
    $res_cur = mysqli_fetch_assoc($rate_result);
    $rate = ($res_cur['cu_withdraw_rate']);
    $converted = ($rate * $amount);

    return $converted;
}


function currency_convert_from_usd_user($user_id, $amount, $conn)
{
    $get_currency = "select u_currency from users where u_id=" . $user_id;

    $result = mysqli_query($conn, $get_currency);
    $res = mysqli_fetch_assoc($result);
    $cur_id = $res['u_currency'];

    $converted = currency_convert_from_usd($cur_id, $amount, $conn);

    return $converted;
}

function currency_convert_to_usd_admin($user_id, $amount, $conn)
{
    $get_currency = "select a_currency from admins where a_id=" . $user_id;

    $result = mysqli_query($conn, $get_currency);
    $res = mysqli_fetch_assoc($result);
    $cur_id = $res['a_currency'];

    $converted = currency_convert_to_usd($cur_id, $amount, $conn);

    return $converted;
}

function currency_convert_from_usd_admin($a_id, $amount, $conn)
{
    $get_currency = "select a_currency from admins where a_id=" . $a_id;

    $result = mysqli_query($conn, $get_currency);
    $res = mysqli_fetch_assoc($result);
    $cur_id = $res['a_currency'];


    $converted = currency_convert_from_usd($cur_id, $amount, $conn);

    return $converted;
}

function printTime($date)
{
    return date_format($date, "H:i:s");
}

function printDate($date)
{
    $ndate = date_create($date);


    return date_format($ndate, "Y-m-d");
}

function printDateTime($date)
{
    $ndate = date_create($date);

    return date_format($ndate, 'Y-m-d H:i:s');
}

function setExpDate($today, $days = 100)
{
    return date('Y-m-d H:i:s', strtotime($today . ' + ' . $days . 'days'));
}

function genarateRefId($prefix, $conn)
{
    return $prefix . '-' . $last_id = $conn->insert_id;
}

function getAdminCurrencySymbol($a_id, $conn)
{
    $cu_id = getAdminCurrency($a_id, $conn);

    return getcurrencySymbolByid($cu_id, $conn);
}

function getUserCurrencySymbol($u_id, $conn)
{
    $cu_id = getUserCurrency($u_id, $conn);

    return getcurrencySymbolByid($cu_id, $conn);
}

function getcurrencySymbolByid($cu_id, $conn)
{
    $sql = "SELECT cu_symbol FROM currency WHERE cu_id = '" . $cu_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['cu_symbol'];
}

function printAmount_by_admin_with_symbol($a_id, $amount, $conn)
{
    $new_amount = currency_convert_from_usd_admin($a_id, $amount, $conn);

    return getAdminCurrencySymbol($a_id, $conn) . '' . number_format($new_amount, 2, '.', '');
}

function printAmount($amount)
{
    return number_format($amount, 2, '.', '');
}

function admin_Ref_wallet_balance_with_symbol($a_id, $conn)
{
    $direct_diposit = total_diposit_admin_by_type($a_id, 2, $conn);
    $widthdraw = total_withdraw_admin_by_type($a_id, 2, $conn);

    if ($direct_diposit > $widthdraw) {
        $balance = $direct_diposit - $widthdraw;
    } else {
        $balance = 0;
    }

    return printAmount_by_admin_with_symbol($a_id, $balance, $conn);
}

function admin_Ref_wallet_balance($a_id, $conn)
{
    $direct_diposit = total_diposit_admin_by_type($a_id, 2, $conn);
    $widthdraw = total_withdraw_admin_by_type($a_id, 2, $conn);

    if ($direct_diposit > $widthdraw) {
        $balance = $direct_diposit - $widthdraw;
    } else {
        $balance = 0;
    }

    return $balance;
}

function total_diposit_admin_by_type($a_id, $type, $conn)
{
    // normal deposit
    $sql = "SELECT SUM( w_a_amount) as total_deposit FROM admins_wallet_in  WHERE  w_a_status = '1' AND   w_a_type='$type'   and w_a_id = '" . $a_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);
    $total_deposit = ($res['total_deposit']);

    return $total_deposit;
}

function total_withdraw_admin_by_type($a_id, $type, $conn)
{
    // normal deposit
    $sql = "SELECT SUM(w_a_amount) as total_withdraw FROM admins_wallet_out  WHERE  w_a_status = '1' AND   w_a_type='$type'   and w_a_id = '" . $a_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);
    $total_deposit = ($res['total_withdraw']);

    return $total_deposit;
}

function getUserUplineAdminId($u_id, $conn)
{
    $user = getUserDetails($u_id, $conn);

    return $user['u_type5_by'];
}

function findWinner($numbers, $drawno, $conn)
{
    $sql = "SELECT CASE 
            WHEN first_place = '" . $numbers . "' THEN '1'
            WHEN second_place = '" . $numbers . "' THEN '2'
            WHEN third_place = '" . $numbers . "' THEN '3'
            
            WHEN sp1 = '" . $numbers . "' THEN 'sp1'
            WHEN sp2 = '" . $numbers . "' THEN 'sp2'
            WHEN sp3 = '" . $numbers . "' THEN 'sp3'
            WHEN sp4 = '" . $numbers . "' THEN 'sp4'
            WHEN sp5 = '" . $numbers . "' THEN 'sp5'
            WHEN sp6 = '" . $numbers . "' THEN 'sp6'
            WHEN sp7 = '" . $numbers . "' THEN 'sp7'
            WHEN sp8 = '" . $numbers . "' THEN 'sp8'
            WHEN sp9 = '" . $numbers . "' THEN 'sp9'
            WHEN sp10= '" . $numbers . "' THEN 'sp10'
            WHEN sp11= '" . $numbers . "' THEN 'sp11'    
            WHEN sp12= '" . $numbers . "' THEN 'sp12'
            WHEN sp13= '" . $numbers . "' THEN 'sp13'
            WHEN co1 = '" . $numbers . "' THEN 'co1 '
            WHEN co2 = '" . $numbers . "' THEN 'co2 '
            WHEN co3 = '" . $numbers . "' THEN 'co3 '
            WHEN co4 = '" . $numbers . "' THEN 'co4 '
            WHEN co5 = '" . $numbers . "' THEN 'co5 '
            WHEN co6 = '" . $numbers . "' THEN 'co6 '
            WHEN co7 = '" . $numbers . "' THEN 'co7 '
            WHEN co8 = '" . $numbers . "' THEN 'co8 '
            WHEN co9 = '" . $numbers . "' THEN 'co9 '
            WHEN co10 = '" . $numbers . "' THEN 'co10'

	    END AS place
 
FROM lottoresult where drawno='" . $drawno . "'";


    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);
    $place = $res['place'];

    return $place;
}

function priceByplace($place, $drawno, $conn)
{
    $place_prise = '';
    $place = trim($place);
    if ($place == '1') {
        $place_prise = 'first_price';
    } elseif ($place == '2') {
        $place_prise = 'second_price';
    } elseif ($place == '3') {
        $place_prise = 'third_price';
    } else {
        $place_prise = $place . '_price';
    }


    $sql = "select * from lottoresult where drawno='" . $drawno . "'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);
    $peise = $res[$place_prise];

    return $peise;
}

function findNumbersCuIdbyNid($n_id, $conn)
{
    $get_game = "select * from numbers where n_id ='" . $n_id . "'";

    $rate_result = mysqli_query($conn, $get_game);
    $res_cur = mysqli_fetch_assoc($rate_result);
    $n_l_id = ($res_cur['n_l_id']);

    $l_config_id = "select * from lotto where l_id='$n_l_id'";
    $lotto_result = mysqli_query($conn, $l_config_id);
    $res_l_cur = mysqli_fetch_assoc($lotto_result);
    $game = ($res_l_cur['l_config_id']);

    return findGameCuId($game, $conn);
}


function get_rate_by_level_admin($level, $conn)
{
    $get_rate = "select * from rate_settings where rt_id=1";
    $rate_result = mysqli_query($conn, $get_rate);
    $res_cur = mysqli_fetch_assoc($rate_result);
    $level_new = 'rt_a_L' . $level;
    $rate = ($res_cur[$level_new]);


    return $rate;
}

function get_rate_by_level_user($level, $conn)
{
    $get_rate = "select * from rate_settings where rt_id=1";
    $rate_result = mysqli_query($conn, $get_rate);
    $res_cur = mysqli_fetch_assoc($rate_result);
    $level_new = 'rt_u_L' . $level;
    $rate = ($res_cur[$level_new]);


    return $rate;
}


function deposit_user($u_id, $amount, $type, $date, $w_u_type_note, $w_u_type_txt, $w_u_from, $status, $w_u_slip, $conn)
{
    $w_u_currency = getUserCurrency($u_id, $conn);
    $w_u_ref = genarateRefId($u_id, 'users_wallet_in', $conn);
    $w_u_expiry = setExpDate($date);


    $sql_in =
        "INSERT INTO `users_wallet_in` ( `w_u_id`, `w_u_currency`, `w_u_amount`, `w_u_ref`, `w_u_type`,`w_u_type_txt`, `w_u_date`, `w_u_expiry`, `w_u_status`,  `w_u_type_note`,   `w_u_slip`,`w_u_from`) VALUES ('$u_id', '$w_u_currency',  '$amount', '$w_u_ref','$type','$w_u_type_txt', '$date', '$w_u_expiry', '$status',  '$w_u_type_note',  '$w_u_slip','$w_u_from')";


    if (mysqli_query($conn, $sql_in)) {
        return $conn->insert_id;
    } else {
        return 0;
    }
}

function deposit_admin($a_id, $amount, $type, $date, $w_a_type_note, $w_a_type_txt, $w_a_from, $w_a_ref_out, $conn)
{
    $w_a_currency = getAdminCurrency($a_id, $conn);
    $w_a_ref_in = genarateRefId($a_id, 'admins_wallet_in', $conn);
    $w_a_expiry = setExpDate($date);

    $sql_in =
        "INSERT INTO `admins_wallet_in` ( `w_a_id`, `w_a_currency`, `w_a_amount`, `w_a_ref`, `w_a_type`, `w_a_date`, `w_a_expiry`, `w_a_status`,  `w_a_type_note`, `w_a_type_txt`, `w_a_from`,`w_a_from_ref`) VALUES ( '" . $a_id . "', '" . $w_a_currency . "', '" . $amount . "', '"
        . $w_a_ref_in . "', '" . $type . "', '" . $date . "','" . $w_a_expiry . "', '1',  '" . $w_a_type_note . "','" . $w_a_type_txt . "', '" . $w_a_from . "', '" . $w_a_ref_out . "')";
    if (mysqli_query($conn, $sql_in)) {
        return $conn->insert_id;
    } else {
        return 0;
    }
}

function withdraw_admin($w_a_id, $w_a_amount, $w_a_from, $w_a_type, $w_a_date, $w_a_status, $w_a_type_approved_by, $w_a_type_approved_date, $w_a_type_note, $w_a_type_txt, $w_a_to, $conn)
{
    $w_a_ref = genarateRefId($w_a_from, 'admins_wallet_out', $conn);
    $w_a_to_ref = genarateRefId($w_a_to, 'admins_wallet_out', $conn);
    $w_a_expiry = setExpDate($w_a_date);
    $w_a_currency = getAdminCurrency($w_a_id, $conn);

    $sql_out =
        "INSERT INTO `admins_wallet_out` ( `w_a_id`, `w_a_currency`, `w_a_amount`, `w_a_ref`, `w_a_type`, `w_a_date`, `w_a_expiry`, `w_a_status`, `w_a_type_approved_by`, `w_a_type_approved_date`, `w_a_type_note`, `w_a_type_txt`, `w_a_to`, `w_a_to_ref`) VALUES ( '$w_a_id', '$w_a_currency', '$w_a_amount','$w_a_ref', '$w_a_type', '$w_a_date', '$w_a_expiry', '$w_a_status', '$w_a_type_approved_by', '$w_a_type_approved_date','$w_a_type_note', '$w_a_type_txt', '$w_a_to', '$w_a_to_ref')";

    if (mysqli_query($conn, $sql_out)) {
        return $conn->insert_id;
    } else {
        return 0;
    }
}


function add_user($u_username, $u_name, $hash_password, $u_phone, $u_email, $u_type, $conn)
{
    $u_otp = rand(1000, 9999);


    $sql = "INSERT INTO users (u_username,u_name,u_password, u_phone,u_email,u_otp,u_type) VALUES ('" . $u_username . "','" . $u_name . "', '" . $hash_password . "',  '" . $u_phone . "',  '" . $u_email . "','" . $u_otp . "','" . $u_type . "')";


    return (mysqli_query($conn, $sql));
}

function update_user($u_id, $u_username, $u_name, $hash_password, $u_phone, $u_email, $u_type, $u_ic_no, $u_ic_type, $u_address, $u_status, $conn)
{
    $out = array();


    if ($u_name != null) {
        $sql = "update users set `u_uname`='" . $u_name . "'   where u_id='" . $u_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "User Name", $msg);
    }


    if ($u_phone != null) {
        $sql = "update users set `u_phone`='" . $u_phone . "'   where u_id='" . $u_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Phone", $msg);
    }

    if ($u_email != null) {
        $sql = "update users set `u_email`='" . $u_email . "'   where u_id='" . $u_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "E-Mail", $msg);
    }


    if ($u_ic_no != null) {
        $sql = "update users set `u_ic_no`='" . $u_ic_no . "'   where u_id='" . $u_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "IC Number", $msg);
    }

    if ($u_ic_type != null) {
        $sql = "update users set `u_ic_type`='" . $u_ic_type . "'   where u_id='" . $u_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "IC Type", $msg);
    }

    if ($u_address != null) {
        $sql = "update users set `u_address`='" . $u_address . "'   where u_id='" . $u_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Address", $msg);
    }

    return $out;
}


//vehicles
function add_vehicles($v_number, $v_type, $v_model, $v_mileage, $v_make, $v_img, $v_desc, $v_owner, $v_size, $v_created_by, $v_created_dt, $v_status, $conn)
{
    $sql =
        "INSERT INTO `vehicles` (`v_number`, `v_type`, `v_model`, `v_mileage`,`v_make`, `v_img`, `v_desc`, `v_owner`, `v_size`, `v_created_by`, `v_created_dt`, `v_status`) VALUES ( '$v_number','$v_type', '$v_model', '$v_mileage','$v_make', '$v_img', '$v_desc','$v_owner', '$v_size', '$v_created_by', '$v_created_dt', '$v_status')";


    return (mysqli_query($conn, $sql));
}

function update_vehicles($v_id, $v_number, $v_type, $v_model, $v_mileage, $v_make, $v_img, $v_desc, $v_owner, $v_size, $v_updated_by, $v_updated_dt, $v_status, $conn)
{
    $out = array();

    if ($v_number != null) {
        $sql = "update vehicles set `v_number`='" . $v_number . "'   where v_id='" . $v_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Number", $msg);
    }

    if ($v_type != null) {
        $sql = "update vehicles set `v_type`='" . $v_type . "'   where v_id='" . $v_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Type", $msg);
    }

    if ($v_model != null) {
        $sql = "update vehicles set `v_model`='" . $v_model . "'   where v_id='" . $v_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Model", $msg);
    }

    if ($v_mileage != null) {
        $sql = "update vehicles set `v_mileage`='" . $v_mileage . "'   where v_id='" . $v_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "mileage", $msg);
    }

    if ($v_make != null) {
        $sql = "update vehicles set `v_make`='" . $v_make . "'   where v_id='" . $v_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Make", $msg);
    }

    if ($v_img != null) {
        $sql = "update vehicles set `v_img`='" . $v_img . "'   where v_id='" . $v_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "image", $msg);
    }

    if ($v_desc != null) {
        $sql = "update vehicles set `v_desc`='" . $v_desc . "'   where v_id='" . $v_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Description", $msg);
    }

    if ($v_owner != null) {
        $sql = "update vehicles set `v_owner`='" . $v_owner . "'   where v_id='" . $v_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Owner", $msg);
    }


    if ($v_size != null) {
        $sql = "update vehicles set `v_size`='" . $v_size . "'   where v_id='" . $v_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Size", $msg);
    }


    if ($v_updated_by != null) {
        $sql = "update vehicles set `v_updated_by`='" . $v_updated_by . "'   where v_id='" . $v_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Updated By", $msg);
    }


    if ($v_updated_dt != null) {
        $sql = "update vehicles set `v_updated_dt`='" . $v_updated_dt . "'   where v_id='" . $v_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Updated at", $msg);
    }

    if ($v_status != null) {
        $sql = "update vehicles set `v_status`='" . $v_status . "'   where v_id='" . $v_id . "'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Status", $msg);
    }

    return $out;
}

function get_product_name($item_id, $conn)
{
    $sql = "select p_name as name from products where `p_id`='$item_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['name'];
}

function get_service_nsme($s_id, $conn)
{
    $sql = "select s_name as amt from services where `s_id`='$s_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['amt'];
}

function get_invoice_Date($in_id, $conn)
{
    $sql = "select in_date from invoice where `in_id`='$in_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['in_date'];
}

function get_vehicle_no($in_id, $conn)
{
    $sql = "select v_number FROM vehicles v, invoice i  WHERE v.v_id=i.v_id and i.in_id='$in_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['v_number'];
}

function get_vehicle_mileage($in_id, $conn)
{
    $sql = "select v_mileage FROM vehicles v, invoice i WHERE v.v_id=i.v_id and i.in_id='$in_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['v_mileage'];
}


// invoice

function add_invoice($u_id, $v_id, $pk_id, $in_name, $in_contact, $in_address, $in_desc, $in_date, $pay_type, $in_amount, $in_status, $in_created_by, $in_created_dt, $conn)
{
    $sql = "INSERT INTO `invoice` (`u_id`,`v_id`,`pk_id`,`in_name`,`in_contact`,`in_address`, `in_desc`,`in_date`,`pay_type`,`in_amount`,`in_status`,`in_created_by`,`in_created_dt`) VALUES ('$u_id','$v_id','$pk_id','$in_name','$in_contact','$in_address','$in_desc','$in_date','$pay_type','$in_amount','$in_status','$in_created_by','$in_created_dt')";


    mysqli_query($conn, $sql);


    $in_id = $conn->insert_id;
    $in_no = "inv-" . $in_id;
    $sql = "update invoice set `in_no`='$in_no' where in_id='$in_id'";
    mysqli_query($conn, $sql);

    $sql = "INSERT INTO `pkg_sold` (`u_id`,`pk_id`, `pks_status`, `pks_created_by`, `pks_created_dt`) VALUES ('$u_id','$pk_id',   '$in_status', '$in_created_by','$in_created_dt')";
    mysqli_query($conn, $sql);

    $pks_id = $conn->insert_id;
    $pks_no = "pks-" . $pks_id;
    $sql = "update pkg_sold set `pks_no`='$pks_no' where pks_id='$pks_id'";
    mysqli_query($conn, $sql);

    if ($pk_id > 0) {
        $sql = "select pk_qty as amount from packages where pk_id='$pk_id'";
        $result = mysqli_query($conn, $sql);
        $res = mysqli_fetch_assoc($result);
        $amount = $res['amount'];
        $amount = $amount - 1;

        $sql = "update packages set `pk_qty`='$amount' where pk_id='$pk_id'";
        mysqli_query($conn, $sql);

        $sql = "select pk_used as usage from packages where pk_id='$pk_id'";
        $result = mysqli_query($conn, $sql);
        $res = mysqli_fetch_assoc($result);
        $used = $res['usage'];
        $used = $used + 1;

        $sql = "update packages set `pk_used`='$used' where pk_id='$pk_id'";
        mysqli_query($conn, $sql);
    }

    return ($in_id);
}


function update_invoice($in_id, $in_name, $in_contact, $in_address, $in_desc, $in_date, $pay_type, $in_amount, $in_status, $in_update_by, $in_update_dt, $conn)
{
    $out = array();

    if ($in_name != null) {
        $sql = "update invoice set `in_name`='" . $in_name . "'   where s_id='" . $in_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "name", $msg);
    }

    return $out;
}


// packages

function add_packages($pk_name, $pk_img, $pk_desc, $pk_amount, $pk_cost, $pk_discount, $pk_exp_date, $pk_qty, $pk_created_by, $pk_created_dt, $pk_status, $conn)
{
    $sql =
        "INSERT INTO `packages` (`pk_name`,`pk_img`,`pk_desc`,`pk_amount`,`pk_cost`,`pk_discount`,`pk_exp_date`,`pk_qty`,`pk_created_by`, `pk_created_dt`, `pk_status`) VALUES ('$pk_name','$pk_img','$pk_desc','$pk_amount','$pk_cost','$pk_discount','$pk_exp_date','$pk_qty','$pk_created_by','$pk_created_dt','$pk_status')";

    mysqli_query($conn, $sql);

    $pk_id = $conn->insert_id;
    $pk_no = "pkg-" . $pk_id;
    $sql = "update packages set `pk_code`='$pk_no' where pk_id='$pk_id'";
    mysqli_query($conn, $sql);

    return ($pk_id);
}

function update_packages($pk_id, $pk_name, $pk_img, $pk_desc, $pk_amount, $pk_cost, $pk_discount, $pk_exp_date, $pk_qty, $pk_updated_by, $pk_updated_dt, $pk_status, $conn)
{
    $out = array();

    if ($pk_name != null) {
        $sql = "update packages set `pk_name`='" . $pk_name . "'   where pk_id='" . $pk_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Name", $msg);
    }

    if ($pk_img != null) {
        $sql = "update packages set `pk_img`='" . $pk_img . "'   where pk_id='" . $pk_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Package Image", $msg);
    }

    if ($pk_desc != null) {
        $sql = "update packages set `pk_desc`='" . $pk_desc . "'   where pk_id='" . $pk_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Description", $msg);
    }

    if ($pk_amount != null) {
        $sql = "update packages set `pk_amount`='" . $pk_amount . "'   where pk_id='" . $pk_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Package Amount", $msg);
    }

    if ($pk_cost != null) {
        $sql = "update packages set `pk_cost`='" . $pk_cost . "'   where pk_id='" . $pk_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Package Cost", $msg);
    }
    if ($pk_discount != null) {
        $sql = "update packages set `pk_discount`='" . $pk_discount . "'   where pk_id='" . $pk_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Package Discount", $msg);
    }
    if ($pk_exp_date != null) {
        $sql = "update packages set `pk_exp_date`='" . $pk_exp_date . "'   where pk_id='" . $pk_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Package Expire Date", $msg);
    }
    if ($pk_qty != null) {
        $sql = "update packages set `pk_qty`='" . $pk_qty . "'   where pk_id='" . $pk_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Package Quantity", $msg);
    }
    if ($pk_updated_dt != null) {
        $sql = "update packages set `pk_updated_dt`='" . $pk_updated_dt . "'   where pk_id='" . $pk_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Updated Date", $msg);
    }

    return $out;
}


function add_package_invoice($u_id, $in_name, $in_contact, $in_address, $in_desc, $in_date, $in_amount, $pk_id, $pay_type, $in_status, $in_created_by, $in_created_dt, $conn)
{
    $sql =
        "INSERT INTO `package_invoice` (`u_id`, `in_name`, `in_contact`, `in_address`, `in_desc`, `in_date`, `in_amount`, `pk_id`,'pay_type' ,`in_status`, `in_created_by`, `in_created_dt`) VALUES ('$u_id', '$in_name','$in_contact', '$in_address', '$in_desc', '$in_date', '$in_amount','$pk_id','$pay_type', '$in_status', '$in_created_by','$in_created_dt')";

    mysqli_query($conn, $sql);

    $pk_in_id = $conn->insert_id;
    $pk_in_no = "inv-" . $pk_in_id;
    $sql = "update package_invoice set `in_no`='$pk_in_no' where pk_in_id='$pk_in_id'";
    mysqli_query($conn, $sql);

    return ($pk_in_id);
}


function update_package_invoice($pk_in_id, $in_name, $in_contact, $in_address, $in_desc, $in_date, $pay_type, $in_amount, $in_status, $in_update_by, $in_update_dt, $conn)
{
    $out = array();

    if ($in_name != null) {
        $sql = "update package_invoice set `in_name`='" . $in_name . "'   where pk_in_id='" . $pk_in_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "name", $msg);
    }

    return $out;
}

function get_product_code($item_id, $conn)
{
    $sql = "select p_code as code from products where `p_id`='$item_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['code'];
}

function get_service_code($item_id, $conn)
{
    $sql = "select s_code as code from services where `s_id`='$item_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['code'];
}

function get_package_name($pk_id, $conn)
{
    $sql = "select pk_name as name from packages where `pk_id`='$pk_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['name'];
}

function get_username($u_id, $conn)
{
    $sql = "select u_name as name from users where `u_id`='$u_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['name'];
}

function get_address($in_id, $conn)
{
    $sql = "select in_address as address from invoice where `in_id`='$in_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['address'];
}

function get_pk_username($u_id, $conn)
{
    $sql = "select u_name as name from users where `u_id`='$u_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['name'];
}

function get_contact_number($in_id, $conn)
{
    $sql = "select in_contact as contact from invoice where `in_id`='$in_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['contact'];
}

function get_date($in_id, $conn)
{
    $sql = "select in_date as date from invoice where `in_id`='$in_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['date'];
}

function get_payment_type($in_id, $conn)
{
    $sql = "select pay_type as payment from invoice where `in_id`='$in_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['payment'];
}

function get_price($pk_id, $conn)
{
    $sql = "select pk_amount as price from packages where pk_id='$pk_id' ";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['price'];
}

function get_invoice_number($in_id, $conn)
{
    $sql = "select in_no as number from invoice where `in_id`='$in_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['number'];
}

// Products
function add_product($p_name, $p_img, $p_desc, $p_exp_date, $p_amount, $p_cost, $p_stock, $p_discount, $p_created_by, $p_created_dt, $p_status, $conn)
{
    $sql =
        "INSERT INTO `products` ( `p_name`, `p_img`, `p_desc`, `p_exp_date`, `p_amount`, `p_cost`, `p_stock`, `p_discount`, `p_created_by`, `p_created_dt`, `p_status`) VALUES ( '$p_name', '$p_img', '$p_desc', '$p_exp_date', '$p_amount', '$p_cost', '$p_stock', '$p_discount', '$p_created_by', '$p_created_dt',  '$p_status')";


    $result = mysqli_query($conn, $sql);

    $last_id = $conn->insert_id;
    $p_code = genarateRefId('p', $conn);

    $sql_update = "update products set p_code= '" . $p_code . "' where p_id=" . $last_id;


    mysqli_query($conn, $sql_update);


    return ($result);
}


function update_product($p_id, $p_name, $p_img, $p_desc, $p_exp_date, $p_amount, $p_cost, $p_stock, $p_discount, $p_updated_by, $p_updated_dt, $p_status, $conn)
{
    $out = array();

    if ($p_name != null) {
        $sql = "update products set `p_name`='" . $p_name . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Name", $msg);
    }

    if ($p_img != null) {
        $sql = "update products set `p_img`='" . $p_img . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Image", $msg);
    }

    if ($p_desc != null) {
        $sql = "update products set `p_desc`='" . $p_desc . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "description", $msg);
    }

    if ($p_exp_date != null) {
        $sql = "update products set `p_exp_date`='" . $p_exp_date . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Expire Date", $msg);
    }

    if ($p_amount != null) {
        $sql = "update products set `p_amount`='" . $p_amount . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Amount", $msg);
    }

    if ($p_cost != null) {
        $sql = "update products set `p_cost`='" . $p_cost . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Cost", $msg);
    }

    if ($p_stock != null) {
        $sql = "update products set `p_stock`='" . $p_stock . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Stock", $msg);
    }

    if ($p_discount != null) {
        $sql = "update products set `p_discount`='" . $p_discount . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Discount", $msg);
    }

    if ($p_updated_by != null) {
        $sql = "update products set `p_updated_by`='" . $p_updated_by . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Update By", $msg);
    }

    if ($p_updated_dt != null) {
        $sql = "update products set `p_updated_dt`='" . $p_updated_dt . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Update at", $msg);
    }

    if ($p_status != null) {
        $sql = "update products set `p_status`='" . $p_status . "'   where p_id='" . $p_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "status", $msg);
    }


    return $out;
}

function get_product_amount($item_id, $conn)
{
    $sql = "select p_amount as amt from products where `p_id`='$item_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['amt'];
}


// service

function add_services($s_name, $s_img, $s_desc, $s_amount, $s_cost, $s_discount, $s_created_by, $s_created_dt, $s_status, $conn)
{
    $sql =
        "INSERT INTO `services` (`s_name`, `s_img`, `s_desc`, `s_amount`, `s_cost`, `s_discount`, `s_created_by`, `s_created_dt`, `s_status`) VALUES ( '$s_name','$s_img', '$s_desc', '$s_amount', '$s_cost', '$s_discount','$s_created_by', '$s_created_dt', '$s_status')";

    mysqli_query($conn, $sql);

    $s_id = $conn->insert_id;
    $s_code = "sev-" . $s_id;
    $sql = "update services set `s_code`='$s_code' where s_id='$s_id'";


    mysqli_query($conn, $sql);

    return ($s_id);
}


function update_services($s_id, $s_name, $s_img, $s_desc, $s_amount, $s_cost, $s_discount, $s_updated_by, $s_updated_dt, $s_status, $conn)
{
    $out = array();

    if ($s_name != null) {
        $sql = "update services set `s_name`='" . $s_name . "'   where s_id='" . $s_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Name", $msg);
    }

    if ($s_img != null) {
        $sql = "update services set `s_img`='" . $s_img . "'   where s_id='" . $s_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Image", $msg);
    }

    if ($s_desc != null) {
        $sql = "update services set `s_desc`='" . $s_desc . "'   where s_id='" . $s_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Description ", $msg);
    }

    if ($s_amount != null) {
        $sql = "update services set `s_amount`='" . $s_amount . "'   where s_id='" . $s_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Amount", $msg);
    }

    if ($s_cost != null) {
        $sql = "update services set `s_cost`='" . $s_cost . "'   where s_id='" . $s_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Cost", $msg);
    }

    if ($s_discount != null) {
        $sql = "update services set `s_discount`='" . $s_discount . "'   where s_id='" . $s_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Discount", $msg);
    }

    if ($s_updated_by != null) {
        $sql = "update services set `s_updated_by`='" . $s_updated_by . "'   where s_id='" . $s_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Updated By", $msg);
    }

    if ($s_updated_dt != null) {
        $sql = "update services set `s_updated_dt`='" . $s_updated_dt . "'   where s_id='" . $s_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Updated at", $msg);
    }


    if ($s_status != null) {
        $sql = "update services set `s_status`='" . $s_status . "'   where s_id='" . $s_id . "'";

        mysqli_query($conn, $sql);


        if (mysqli_affected_rows($conn) > 0) {
            $msg = "successfully updated";
        } else {
            $msg = "not change";
        }

        array_push($out, "Status", $msg);
    }

    return $out;
}


function get_service_amount($s_id, $conn)
{
    $sql = "select s_amount as amt from services where `s_id`='$s_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['amt'];
}


//info

function get_packages_count($conn)
{
    $sql = "select count(pk_id) as pk from packages";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['pk'];
}


function get_products_count($conn)
{
    $sql = "select count(p_id) as pk from products";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['pk'];
}

function get_services_count($conn)
{
    $sql = "select count(s_id) as pk from services";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['pk'];
}

function get_memeber_count($conn)
{
    $sql = "select count(u_id) as pk from users where u_type>1";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['pk'];
}

function get_memeber_name_by_vehical($conn, $v_id)
{
    $sql = "SELECT u.u_name,u.u_email from vehicles v  INNER JOIN users u where  v.v_owner=u.u_id AND v.v_id='$v_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['u_name'];
}


function get_memeber_email_by_vehical($conn, $v_id)
{
    $sql = "SELECT u.u_email from vehicles v  INNER JOIN users u where  v.v_owner=u.u_id AND v.v_id='$v_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['u_email'];
}


function get_memeber_phone_by_vehical($conn, $v_id)
{
    $sql = "SELECT u.u_phone from vehicles v  INNER JOIN users u where  v.v_owner=u.u_id AND v.v_id='$v_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['u_phone'];
}


function get_memeber_address_by_vehical($conn, $v_id)
{
    $sql = "SELECT u.u_address from vehicles v  INNER JOIN users u where  v.v_owner=u.u_id AND v.v_id='$v_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['u_address'];
}

function get_u_id__by_v_id($conn, $v_id)
{
    $sql = "SELECT u.u_id from vehicles v  INNER JOIN users u where  v.v_owner=u.u_id AND v.v_id='$v_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['u_id'];
}


function get_pk_name_by_pkg_id($pk_id, $conn)
{

    $sql = "select * from packages where pk_id='$pk_id'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['pk_name'];

}

function get_access_token($api_user, $api_pass)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => BASE_URL . 'blue_api/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{

    "email": "' . $api_user . '",
    "password": "' . $api_pass . '"
    
}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: PHPSESSID=6vsa62qm5tj45i14502v29b2c9'
        ),
    ));

    $response = curl_exec($curl);

    $arr = json_decode($response, true);


    curl_close($curl);


    return $arr['data'];


}

function get_user_type($u_username, $token)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => BASE_URL . 'blue_api/user/type',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{

"u_username":"sasagent8"
}',
        CURLOPT_HTTPHEADER => array(
            'Authorization:  Bearer  ' . $token,
            'Content-Type: application/json',
            'Cookie: PHPSESSID=m5c6iq0b1h66camm7mitmjgh0j'
        ),
    ));

    $response = curl_exec($curl);

    $arr = json_decode($response, true);

    $arra = $arr['data'];


    curl_close($curl);
    return $arra[0]['u_type'];


}

function user_login($u_username, $u_password)
{


    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/blue_api/user/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{

"u_username": "'.$u_username.'",
"u_password":"'.$u_password.'"
}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: PHPSESSID=heoi34jfsef1malo9app1ljlho'
        ),
    ));




    $response = curl_exec($curl);

    $arr = json_decode($response, true);


    curl_close($curl);
    return $arr['data'];


}





