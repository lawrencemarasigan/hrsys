<?php
require_once "authorization.php";
$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT leave_app_no, employee_id, employee_name, department, position, type_of_leave, status FROM leave_application";
$result = $conn->query($sql);

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employee Records</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: url("/assets/images/bgsannic.png") no-repeat center center fixed;
    background-size: cover;
}

.overlay {
    background: rgba(173, 216, 230, 0.85);
    min-height: 100vh;
}

.wrapper {
    height: 100vh;
}

.sidebar {
    width: 260px;
    background: #ffffff;
    padding: 20px 12px;
    min-height: 100vh;
    position: fixed;
    box-shadow: 2px 0 8px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
}

.sidebar-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    margin-bottom: 10px;
}

.sidebar-logo img {
    width: 45px;
    height: 45px;
}

.logo-title {
    font-size: 18px;
    font-weight: bold;
    color: #2c5cc5;
}

.logo-sub {
    font-size: 12px;
    color: #666;
}

.menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    margin-bottom: 8px;
    border-radius: 12px;
    text-decoration: none;
    color: #1e40af;
    font-weight: 500;
}

.menu-item.active {
    background: #0d6efd;
    color: #fff;
}

.content {
    margin-left: 280px;
    padding: 30px;
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
    <a href="#" class="menu-item logout" data-bs-toggle="modal" data-bs-target="#logoutModal">
        🚪 Logout
    </a>

</div>

<div class="modal fade" id="logoutModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Confirm Logout</h5>
      </div>

      <div class="modal-body">
        Are you sure you want to logout?
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancel
        </button>

        <a href="logout.php" class="btn btn-danger">
            Logout
        </a>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>