<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");

if ($conn->connect_error) {
    die("Connection failed");
}

if(!isset($_GET['id'])) {
    die("Invalid request");
}

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM employees WHERE id = '$id'");

if($result->num_rows == 0) {
    die("Employee not found");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Print Employee</title>
    <style>
        body {
            font-family: Arial;
            padding: 40px;
        }
        h2 {
            text-align: center;
        }
        .info {
            margin-top: 30px;
            font-size: 18px;
        }
        .info p {
            margin: 8px 0;
        }
    </style>
</head>
<body onload="window.print()">

<h2>Employee Information</h2>

<div class="info">
    <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
    <p><strong>Department:</strong> <?php echo $row['department']; ?></p>
    <p><strong>Position:</strong> <?php echo $row['position']; ?></p>
    <p><strong>Civil Status:</strong> <?php echo $row['civil_status']; ?></p>
    <p><strong>PhilHealth:</strong> <?php echo $row['philhealth']; ?></p>
    <p><strong>SSS:</strong> <?php echo $row['sss']; ?></p>
    <p><strong>GSIS:</strong> <?php echo $row['gsis']; ?></p>
    <p><strong>TIN:</strong> <?php echo $row['tin']; ?></p>
    <p><strong>Pag-IBIG:</strong> <?php echo $row['pagibig']; ?></p>
</div>

</body>
</html>
