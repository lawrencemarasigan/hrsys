<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");

if ($conn->connect_error) {
    die("Connection failed");
}

if(isset($_POST['id']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $civil_status = $_POST['civil_status'];
    $philhealth = $_POST['philhealth'];
    $sss = $_POST['sss'];
    $gsis = $_POST['gsis'];
    $tin = $_POST['tin'];
    $pagibig = $_POST['pagibig'];

    $sql = "UPDATE employees SET
        name='$name',
        department='$department',
        position='$position',
        civil_status='$civil_status',
        philhealth='$philhealth',
        sss='$sss',
        gsis='$gsis',
        tin='$tin',
        pagibig='$pagibig'
        WHERE id='$id'";

    if($conn->query($sql)){
        echo "success";
    } else {
        echo "error";
    }
}
else
{
    echo "Invalid request";
}

$conn->close();
?>
