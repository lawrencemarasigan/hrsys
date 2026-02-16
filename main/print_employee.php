<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");
$id = $_GET['id'];

$result = $conn->query("SELECT * FROM employees WHERE id=$id");
$emp = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<title>Print Employee</title>
<style>
body { font-family: Arial; padding: 30px; }
.print-box { border: 1px solid #000; padding: 20px; }
</style>
</head>
<body onload="window.print()">

<div class="print-box">
    <h2>Employee Information</h2>
    <p><b>Name:</b> <?= $emp['name'] ?></p>
    <p><b>Department:</b> <?= $emp['department'] ?></p>
    <p><b>Position:</b> <?= $emp['position'] ?></p>
    <p><b>Hired Date:</b> <?= $emp['hired_at'] ?></p>
    <p><b>Civil Status:</b> <?= $emp['civil_status'] ?></p>
    <p><b>PhilHealth:</b> <?= $emp['philhealth'] ?></p>
    <p><b>SSS:</b> <?= $emp['sss'] ?></p>
    <p><b>GSIS:</b> <?= $emp['gsis'] ?></p>
    <p><b>TIN:</b> <?= $emp['tin'] ?></p>
    <p><b>PAG-IBIG:</b> <?= $emp['pagibig'] ?></p>
</div>

</body>
</html>
