<?php

header('Cache-control: private'); // IE 6 FIX
if (isSet($_GET['lang'])) {
    $lang = $_GET['lang'];
    // register the session and set the cookie
    $_SESSION['lang'] = $lang;
    setcookie('lang', $lang, time() + (3600 * 24 * 30));
} else if (isSet($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else if (isSet($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
} else {
    $lang = 'en';
}

switch ($lang) {
    case 'en':
        $language = 'en';
        $lang_file = 'lang.en.php';
        break;
    case 'cn':
        $language = 'cn';
        $lang_file = 'lang.cn.php';
        break;
    case 'my':
        $language = 'my';
        $lang_file = 'lang.my.php';
        break;
    case 'th':
        $language = 'th';
        $lang_file = 'lang.th.php';
        break;
    default:
        $language = 'en';
        $lang_file = 'lang.en.php';
}

include_once 'languages/' . $lang_file;
?>