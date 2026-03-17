```php
<?php
require_once "authorization.php";
$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

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

/* SIDEBAR */
.sidebar{
    width:260px;
    background:#fff;
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

/* MAIN CONTENT */

.content{
    flex:1;
    padding:30px;
}

/* PROFILE CARD */

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

<a href="dashboard.php" class="menu-item <?= active('dashboard.php') ?>">📊 Dashboard</a>
<a href="employee_records.php" class="menu-item <?= active('employee_records.php') ?>">👥 Employee Records</a>
<a href="form201.php" class="menu-item <?= active('form201.php') ?>">🗂️ Form 201</a>
<a href="requests.php" class="menu-item <?= active('requests.php') ?>">📝 Requests</a>
<a href="leave_application.php" class="menu-item <?= active('leave_application.php') ?>">📎 Leave Application</a>
<a href="performance.php" class="menu-item <?= active('performance.php') ?>">📈 Performance</a>
<a href="work_calendar.php" class="menu-item <?= active('work_calendar.php') ?>">📅 Work Calendar</a>
</div>

<!-- MAIN CONTENT -->
<div class="content">

<h4 class="mb-4">Profile Settings</h4>

<div class="profile-container">

<ul class="nav nav-tabs mb-4">

<li class="nav-item">
<a class="nav-link active" data-bs-toggle="tab" href="#profile">
Profile Information
</a>
</li>

<li class="nav-item">
<a class="nav-link" data-bs-toggle="tab" href="#password">
Change Password
</a>
</li>
</ul>

<div class="tab-content">

<!-- PROFILE TAB -->
<div class="tab-pane fade show active" id="profile">

<div class="row">

<div class="col-md-9">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Full Name</label>
<div class="input-group">
<span class="input-group-text">👤</span>
<input type="text" class="form-control" value="System Admin">
</div>
</div>

<div class="mb-3">
<label>Email Address</label>
<div class="input-group">
<span class="input-group-text">✉️</span>
<input type="email" class="form-control" value="systemadmin@gmail.com">
</div>
</div>

<div class="mb-3">
<label>Contact Number</label>
<div class="input-group">
<span class="input-group-text">📞</span>
<input type="text" class="form-control" value="09959788849">
</div>
</div>

<div class="mb-3">
<label>Address</label>
<div class="input-group">
<span class="input-group-text">📍</span>
<textarea class="form-control">Sta. Rita Karsada Batangas City</textarea>
</div>
</div>

<div class="mb-3">
<label>Date of Birth</label>
<div class="input-group">
<span class="input-group-text">📅</span>
<input type="date" class="form-control">
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

<div class="tab-pane fade" id="password">

<form style="max-width:500px">

<div class="mb-3">
<label>Current Password</label>
<input type="password" class="form-control">
</div>

<div class="mb-3">
<label>New Password</label>
<input type="password" class="form-control">
</div>

<div class="mb-3">
<label>Confirm Password</label>
<input type="password" class="form-control">
</div>

<button class="btn btn-primary">
Update Password
</button>
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