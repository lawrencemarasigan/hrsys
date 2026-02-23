<?php

require_once __DIR__ . '/../vendor/autoload.php';

use setasign\Fpdi\Tcpdf\Fpdi;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid access.");
}

$appointee     = $_POST['appointee'] ?? '';
$address       = $_POST['address'] ?? '';
$position      = $_POST['position'] ?? '';
$appointeesig  = $_POST['appointeesig'] ?? '';
$governmentid  = $_POST['governmentid'] ?? '';
$idnumber      = $_POST['idnumber'] ?? '';
$date          = $_POST['date'] ?? '';
$day           = $_POST['day'] ?? '';
$month         = $_POST['month'] ?? '';

$pdf = new Fpdi();

$templatePath = __DIR__ . '/../../assets/forms/oath.pdf';

if (!file_exists($templatePath)) {
    die("Template not found: " . $templatePath);
}

$pageCount = $pdf->setSourceFile($templatePath);
$template  = $pdf->importPage(1);

$pdf->AddPage();
$pdf->useTemplate($template);

$pdf->SetFont('helvetica', '', 11);
$pdf->SetTextColor(0, 0, 0);

/* Name */
$pdf->SetXY(56, 73);
$pdf->Write(0, $appointee);

/* Address */
$pdf->SetXY(110, 73);
$pdf->Write(0, $address);

/* Position Title */
$pdf->SetXY(70, 85);
$pdf->Write(0, $position);

/* Appointee Signature Name */
$pdf->SetXY(130, 207);
$pdf->Write(0, $appointeesig);

/* Government ID */
$pdf->SetXY(49, 223);
$pdf->Write(0, $governmentid);

/* ID Number */
$pdf->SetXY(53, 227);
$pdf->Write(0, $idnumber);

/* Date */
$pdf->SetXY(60, 231);
$pdf->Write(0, $date);

/* Day */
$pdf->SetXY(130, 246);
$pdf->Write(0, $day);

/* Month */
$pdf->SetXY(143, 246);
$pdf->Write(0, $month);

$pdf->Output('OathForm_' . time() . '.pdf', 'I');