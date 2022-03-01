<?php

include_once '../session.php';

if (isset($_GET['u_type'])) {
    $u_type = base64_decode($_GET['u_type']);
} else {
    $u_type = 0;
}





