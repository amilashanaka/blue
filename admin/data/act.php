<?php

include_once '../../conn.php';
include_once '../../inc/functions.php';

//featch Data

$id = $_POST['id'];
$table_name = $_POST['tbl'];
 


if ($table_name == 'a') {
    $sql = "UPDATE admins SET a_status = '1' WHERE a_id = '" . $id . "'";
} elseif ($table_name == 'cu') {
    $sql = "UPDATE currency SET cu_status = '1' WHERE cu_id = '" . $id . "'";
} elseif ($table_name == 'u') {
    $sql = "UPDATE users SET u_status = '1' WHERE u_id = '" . $id . "'";
}elseif ($table_name == 'res') {
    $sql = "UPDATE lottoresult SET r_status = '1' WHERE r_id = '" . $id . "'";
}elseif ($table_name == 'dip') {
    $sql = "UPDATE users_wallet_in SET w_u_status = '1' WHERE w_id_u = '" . $id . "'";
}elseif ($table_name == 'sl') {
    $sql = "UPDATE sliders SET sl_status = '1' WHERE sl_id = '" . $id . "'";
}elseif ($table_name == 'wd') {
    $sql = "UPDATE users_wallet_out SET w_u_status = '1' WHERE  w_id_u = '" . $id . "'";
}elseif ($table_name == 'game') {
    $sql = "UPDATE games SET g_status = 1 WHERE  g_id = '" . $id . "'";
}elseif ($table_name == 'admin_w') {
    $sql = "UPDATE admins_wallet_out SET w_a_status = 1 WHERE  w_id_a = '" . $id . "'";
}elseif ($table_name == 'pk') {
    $sql = "UPDATE packages SET pk_status = 1 WHERE  pk_id = '" . $id . "'";
}






if (mysqli_query($conn, $sql)) {
    if ($table_name == 'a') {
        echo json_encode(array('res' => 1));
    } else if ($table_name == 'cu') {
        echo json_encode(array('res' => 3));
    } else if ($table_name == 'u') {
        echo json_encode(array('res' => 5));
    } else if ($table_name == 'res') {
        echo json_encode(array('res' => 7));
    }else if ($table_name == 'dip') {
        echo json_encode(array('res' => 11));
    }else if ($table_name == 'sl') {
        echo json_encode(array('res' => 13));
    }else if ($table_name == 'wd') {
        echo json_encode(array('res' => 15));
    }else if ($table_name == 'game') {
        echo json_encode(array('res' => 17));
    }else if ($table_name == 'pk') {
        echo json_encode(array('res' => 20));
    }
} else {
    if ($table_name == 'a') {
        echo json_encode(array('res' => 2));
    } else if ($table_name == 'cu') {
        echo json_encode(array('res' => 4));
    } else if ($table_name == 'u') {
        echo json_encode(array('res' => 6));
    } else if ($table_name == 'res') {
        echo json_encode(array('res' => 8));
    }else if ($table_name == 'dip') {
        echo json_encode(array('res' => 12));
    }else if ($table_name == 'wd') {
        echo json_encode(array('res' => 16));
    }else if ($table_name == 'game') {
        echo json_encode(array('res' => 18));
    }else if ($table_name == 'pk') {
        echo json_encode(array('res' => 20));
    }
}

 