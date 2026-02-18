<?php

require_once __DIR__ . '/vendor/autoload.php';

use setasign\Fpdi\Tcpdf\Fpdi;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid access.");
}

$assumption = $_POST['assumption'] ?? '';
$ordinance  = $_POST['ordinance'] ?? '';
$year       = $_POST['year'] ?? '';
$mayorDate  = $_POST['mayorDate'] ?? '';
$acctDate   = $_POST['acctDate'] ?? '';

$pdf = new Fpdi();

// 🔥 VERY IMPORTANT: Use EXACT file name
$templatePath = __DIR__ . '/../assets/forms/csform.pdf';

if (!file_exists($templatePath)) {
    die("Template not found: " . $templatePath);
}

$pageCount = $pdf->setSourceFile($templatePath);
$template = $pdf->importPage(1);

$pdf->AddPage();
$pdf->useTemplate($template);

$pdf->SetFont('helvetica', '', 11);
$pdf->SetTextColor(0, 0, 0);

//
// ===== WRITE VALUES =====
//

// 🔹 "on ____________"
$pdf->SetXY(40, 108);
$pdf->Write(0, $assumption);

// 🔹 Ordinance No.
$pdf->SetXY(30, 211);
$pdf->Write(0, $ordinance);

// 🔹 Series Year
$pdf->SetXY(58, 211);
$pdf->Write(0, $year);

// 🔹 Mayor Date
$pdf->SetXY(43, 150);
$pdf->Write(0, $mayorDate);

// 🔹 Accountant Date
$pdf->SetXY(43, 254);
$pdf->Write(0, $acctDate);

$pdf->Output('CS_Form_13_Filled.pdf', 'I');
