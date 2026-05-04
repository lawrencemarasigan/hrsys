<?php
 require_once 'user_authorization.php';
$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* ✅ GET LOGGED-IN USER */
$employee_id = $_SESSION['employee_id']; // make sure this is set during login

$result = $conn->query("SELECT * FROM employees WHERE employee_id = '$employee_id'");
$user = $result->fetch_assoc();

/* ✅ UPDATE PROFILE */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // PASSWORD UPDATE
    if (isset($_POST['action']) && $_POST['action'] === 'change_password') {

        $current = $_POST['current_password'];
        $new = $_POST['new_password'];
        $confirm = $_POST['confirm_password'];

        $stmt = $conn->prepare("SELECT password FROM employees WHERE employee_id=?");
        $stmt->bind_param("s", $employee_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!password_verify($current, $row['password'])) {
            echo "<script>alert('Current password is incorrect');</script>";
        } elseif ($new !== $confirm) {
            echo "<script>alert('Passwords do not match');</script>";
        } else {
            $hashed = password_hash($new, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE employees SET password=? WHERE employee_id=?");
            $stmt->bind_param("ss", $hashed, $employee_id);
            $stmt->execute();

            echo "<script>alert('Password updated successfully');</script>";
        }

    } 
    // PROFILE UPDATE
    else {

        $name = $_POST['full_name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $dob = $_POST['dob'];

        $stmt = $conn->prepare("UPDATE employees SET 
            name=?, 
            email=?, 
            contact_number=?, 
            address=?, 
            date_of_birth=? 
            WHERE id=?");

        $stmt->bind_param("ssssss", $name, $email, $contact, $address, $dob, $employee_id);
        $stmt->execute();

        echo "<script>alert('Profile updated successfully');</script>";

        // refresh data
        $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id=?");
        $stmt->bind_param("s", $employee_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'change_password') {

    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    // get current password from DB
    $stmt = $conn->prepare("SELECT password FROM employees WHERE employee_id=?");
    $stmt->bind_param("s", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // verify current password
    if (!password_verify($current, $row['password'])) {
        echo "<script>alert('Current password is incorrect');</script>";
    } 
    elseif ($new !== $confirm) {
        echo "<script>alert('Passwords do not match');</script>";
    } 
    else {
        $hashed = password_hash($new, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE employees SET password=? WHERE employee_id=?");
        $stmt->bind_param("ss", $hashed, $employee_id);
        $stmt->execute();

        echo "<script>alert('Password updated successfully');</script>";
    }
}

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* (UNCHANGED DESIGN) */
body{
    margin:0;
    font-family: Arial, sans-serif;
    background:url("/assets/images/bgsannic.png") no-repeat center center fixed;
    background-size:cover;
}
.overlay{
    background:rgba(173,216,230,0.85);
    min-height:100vh;
}

.wrapper{
    display:flex;
}

.sidebar{
    width:260px; background:#fff;
    padding:20px 12px;
    min-height:100vh;
    box-shadow:2px 0 8px rgba(0,0,0,0.05);
}

.sidebar-logo{
    display:flex;
    align-items:center;
    gap:12px;
    padding:15px 20px;
}

.sidebar-logo img{
    width:45px;
}

.logo-title{
    font-weight:bold;
    color:#2c5cc5;
}

.logo-sub{
    font-size:12px;
    color:#777;
}

.menu-item{
    display:block;
    padding:10px 15px;
    border-radius:10px;
    margin:6px 0;
    color:#1e40af;
    text-decoration:none;
}

.menu-item.active{
    background:#0d6efd;
    color:#fff;
}

.content{
    flex:1;
    padding:30px;
}

.profile-container{
    background:#fff;
    border-radius:12px;
    padding:25px; 
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

.update-btn{
    background:#0d6efd;
    color:#fff;
    }

</style>
</head>

<body>

<div class="overlay">
<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">
<div class="sidebar-logo">
<img src="/assets/images/sannic.png">
<div>
<div class="logo-title">San Nicolas</div>
<div class="logo-sub">HR Management System</div>
</div>
</div>

<a href="user_dashboard.php" class="menu-item">📊 Dashboard</a>
<a href="employee_record.php" class="menu-item">👥 Employee Records</a>
<a href="request_application.php" class="menu-item">📝 Requests Application</a>
<a href="leave_application.php" class="menu-item">📎 Leave Application</a>
<a href="employee_performance.php" class="menu-item">📈 Performance</a>
</div>

<!-- MAIN CONTENT -->
<div class="content">

<h4 class="mb-4">Profile Settings</h4>

<div class="profile-container">

<ul class="nav nav-tabs mb-4">
<li class="nav-item">
<a class="nav-link active" data-bs-toggle="tab" href="#profile">Profile Information</a>
</li>
<li class="nav-item">
<a class="nav-link" data-bs-toggle="tab" href="#password">Change Password</a>
</li>
</ul>

<div class="tab-content">

<!-- PROFILE TAB -->
<div class="tab-pane fade show active" id="profile">

<div class="row">
<div class="col-md-9">

<form method="POST">

<div class="mb-3">
<label>Full Name</label>
<div class="input-group">
<span class="input-group-text">👤</span>
<input type="text" name="full_name" class="form-control" value="<?= $user['employee_name'] ?>">
</div>
</div>

<div class="mb-3">
<label>Email Address</label>
<div class="input-group">
<span class="input-group-text">✉️</span>
<input type="email" name="email" class="form-control" value="<?= $user['email'] ?>">
</div>
</div>

<div class="mb-3">
<label>Contact Number</label>
<div class="input-group">
<span class="input-group-text">📞</span>
<input type="text" name="contact" class="form-control" value="<?= $user['contact_number'] ?>">
</div>
</div>

<div class="mb-3">
<label>Address</label>
<div class="input-group">
<span class="input-group-text">📍</span>
<textarea name="address" class="form-control"><?= $user['address'] ?></textarea>
</div>
</div>

<div class="mb-3">
<label>Date of Birth</label>
<div class="input-group">
<span class="input-group-text">📅</span>
<input type="date" name="dob" class="form-control" value="<?= $user['date_of_birth'] ?>">
</div>
</div>

<div class="text-end mt-4">
<button type="button" class="btn btn-secondary">Cancel</button>
<button type="submit" class="btn update-btn">Update Profile</button>
</div>

</form>

</div>
</div>
</div>

<!-- PASSWORD TAB (UNCHANGED) -->
<div class="tab-pane fade" id="password">
<form method="POST" style="max-width:500px">

<input type="hidden" name="action" value="change_password">

<div class="mb-3">
<label>Current Password</label>
<input type="password" name="current_password" class="form-control" required>
</div>

<div class="mb-3">
<label>New Password</label>
<input type="password" name="new_password" class="form-control" required>
</div>

<div class="mb-3">
<label>Confirm Password</label>
<input type="password" name="confirm_password" class="form-control" required>
</div>

<button type="submit" class="btn btn-primary">Update Password</button>
</form>
</div>

</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>