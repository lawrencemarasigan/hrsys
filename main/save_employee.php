<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) die("DB Error");

$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$name  = $fname . ' ' . $lname;

$stmt = $conn->prepare("
INSERT INTO employees 
(name, department, position, hired_at, civil_status, philhealth, sss, gsis, tin, pagibig) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssssssss",
    $name,
    $_POST['department'],
    $_POST['position'],
    $_POST['hired_at'],
    $_POST['civil_status'],
    $_POST['philhealth'],
    $_POST['sss'],
    $_POST['gsis'],
    $_POST['tin'],
    $_POST['pagibig']
);

$stmt->execute();

echo "<script>
alert('Employee added successfully!');
window.opener.location.reload();
window.close();
</script>";
