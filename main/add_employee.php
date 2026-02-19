<?php
$conn = new mysqli("127.0.0.1", "root", "", "hrsys_db", 3306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $address = $_POST['address'];
    $civil_status = $_POST['civil_status'];
    $blood_type = $_POST['blood_type'];
    $philhealth = $_POST['philhealth'];
    $sss = $_POST['sss'];
    $gsis = $_POST['gsis'];
    $pagibig = $_POST['pagibig'];
    $tin = $_POST['tin'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $employee_status = $_POST['employee_status'];
    $salary_grade = $_POST['salary_grade'];
    $date_hired = $_POST['date_hired'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_ended = $_POST['appointment_ended'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $name = $first_name . " " . $middle_name . " " . $last_name;

    $sql = "INSERT INTO employees (
        first_name,
        last_name,
        middle_name,
        name,
        address,
        civil_status,
        blood_type,
        philhealth,
        sss,
        gsis,
        pagibig,
        tin,
        department,
        position,
        employee_status,
        salary_grade,
        hired_at,
        appointment_date,
        appointment_ended,
        role,
        email,
        password
    ) VALUES (
        '$first_name',
        '$last_name',
        '$middle_name',
        '$name',
        '$address',
        '$civil_status',
        '$blood_type',
        '$philhealth',
        '$sss',
        '$gsis',
        '$pagibig',
        '$tin',
        '$department',
        '$position',
        '$employee_status',
        '$salary_grade',
        '$date_hired',
        '$appointment_date',
        '$appointment_ended',
        '$role',
        '$email',
        '$password'
    )";

    if ($conn->query($sql) === TRUE) {
        header("Location: employee_records.php?success=1");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
