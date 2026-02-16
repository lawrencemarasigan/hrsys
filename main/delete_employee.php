<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");

if ($conn->connect_error) {
    die("Connection failed");
}

$id = intval($_GET['id']);

$sql = "DELETE FROM employees WHERE id=$id";

$conn->query($sql);

$conn->close();

header("Location: employee_records.php");
exit();
?>
