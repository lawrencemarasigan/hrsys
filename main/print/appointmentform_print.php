<?php

require_once __DIR__ . '/../vendor/autoload.php';

use setasign\Fpdi\Tcpdf\Fpdi;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid access.");
}

$fullname    = $_POST['fullname'] ?? '';
$postitle1   = $_POST['postitle1'] ?? '';
$officename  = $_POST['officename'] ?? '';
$assumption  = $_POST['assump'] ?? '';
$surname     = $_POST['surname'] ?? '';
$postitle2   = $_POST['postitle2'] ?? '';
$day         = $_POST['day'] ?? '';
$month       = $_POST['month'] ?? '';


$pdf = new Fpdi();

$templatePath = __DIR__ . '/../../assets/forms/appointment.pdf';

if (!file_exists($templatePath)) {
    die("Template not found: " . $templatePath);
}

$pageCount = $pdf->setSourceFile($templatePath);
$template = $pdf->importPage(1);

$pdf->AddPage();
$pdf->useTemplate($template);

$pdf->SetFont('helvetica', '', 11);
$pdf->SetTextColor(0, 0, 0);

// 🔹 Full Name
$pdf->SetXY(91, 77);
$pdf->Write(0, $fullname);

// 🔹 Position Title 1
$pdf->SetXY(69, 84);
$pdf->Write(0, $postitle1);

// 🔹 Office Name
$pdf->SetXY(100, 84);
$pdf->Write(0, $officename);

// 🔹 Date Of Assumption
$pdf->SetXY(160, 84);
$pdf->Write(0, $assumption);

// 🔹 Surname
$pdf->SetXY(35, 106);
$pdf->Write(0, $surname);

// 🔹 Position Title
$pdf->SetXY(76, 106);
$pdf->Write(0, $postitle2);

// 🔹 Day
$pdf->SetXY(60, 121);
$pdf->Write(0, $day);

// 🔹 Month
$pdf->SetXY(82, 121);
$pdf->Write(0, $month);

$pdf->Output('Appointment_' . time() . '.pdf', 'I');