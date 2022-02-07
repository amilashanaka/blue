<?php
include_once '../admin/session.php';
require 'vendor/autoload.php';

if (isset($_GET['in_id'])) {
 $in_id= base64_decode($_GET['in_id']);
}else{

    $in_id = 0;
}


include_once 'package_recepit_format.php';


// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Courier');
$options->set('isRemoteEnabled', TRUE);
$options->set('debugKeepTemp', TRUE);
$options->set('isHtml5ParserEnabled', true);
//$options->set('chroot', '');
$dompdf = new Dompdf($options);

// instantiate and use the dompdf class
$dompdf = new Dompdf();


$page=file_get_contents("format.html");
$dompdf->loadHtml($aData['html']);
$dompdf->set_option('isRemoteEnabled',TRUE);
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A6', 'portrait');

// Render the HTML as PDF
$dompdf->render();


 // Output the generated PDF to Browser
$dompdf->stream( 'file.pdf' , array( 'Attachment'=>false) );

echo "1";







