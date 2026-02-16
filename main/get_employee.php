<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");

if ($conn->connect_error) {
    die("Connection failed");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM employees WHERE id = $id LIMIT 1";
$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode([]);
}

$conn->close();
?>
