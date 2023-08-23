<?php
require_once 'vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'margin_footer' => 10,
    'orientation' => 'L'
]);
$footer = '
<table width="100%">
    <tr>
        <td>www.access360care.com</td>
        <td style="text-align: right;">Page {PAGENO}</td>
    </tr>
</table>';

$mpdf->SetHTMLFooter($footer);

// Header set na karein page 1 ke liye

ob_start();
include('page1.php');
$page1 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page1);
$mpdf->AddPage();

// Page 2 ke liye header set karein
ob_start();
include('page2.php');
$page2 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page2);
$mpdf->AddPage();


ob_start();
include('page3.php');
$page3 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page3);
$mpdf->AddPage();

ob_start();
include('page4.php');
$page4 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page4);
$mpdf->AddPage();


ob_start();
include('page5.php');
$page5 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page5);
$mpdf->AddPage();

ob_start();
include('page9.php');
$page9 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page9);
$mpdf->AddPage();

ob_start();
include('page7.php');
$page7 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page7);
$mpdf->AddPage();

ob_start();
include('page8.php');
$page8 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page8);
$mpdf->AddPage();

ob_start();
include('page13.php');
$page13 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page13);
$mpdf->AddPage();

ob_start();
include('section.php');
$section = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($section);
$mpdf->AddPage();

ob_start();
include('page6.php');
$page6 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page6);
$mpdf->AddPage();

ob_start();
include('page10.php');
$page10 = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($page10);


$mpdf->Output();

?>




