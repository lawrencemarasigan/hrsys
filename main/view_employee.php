<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) { die("DB Error"); }

$id = (int)$_GET['id'];
$res = $conn->query("SELECT * FROM employees WHERE id=$id");
$emp = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Employee Details</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-3 bg-light">

<h5>Employee Details</h5>

<table class="table table-bordered">
<tr><th>Name</th><td><?= htmlspecialchars($emp['name']) ?></td></tr>
<tr><th>Department</th><td><?= htmlspecialchars($emp['department']) ?></td></tr>
<tr><th>Position</th><td><?= htmlspecialchars($emp['position']) ?></td></tr>
<tr><th>SSS</th><td><?= htmlspecialchars($emp['sss'] ?? '') ?></td></tr>
<tr><th>TIN</th><td><?= htmlspecialchars($emp['tin'] ?? '') ?></td></tr>
<tr><th>Pag-IBIG</th><td><?= htmlspecialchars($emp['pagibig'] ?? '') ?></td></tr>
</table>

<div class="text-end">
    <button onclick="window.close()" class="btn btn-secondary">Close</button>
</div>

</body>
</html>
