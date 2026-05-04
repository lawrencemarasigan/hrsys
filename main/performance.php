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
<title>Employee Performance</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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

.performance-card {
    background: #e9e9e9;
    border-radius: 12px;
    padding: 60px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
}

.search-bar input,
.search-bar select {
    border-radius: 8px;
}

</style>
</head>

<body>

<div class="overlay">
<div class="wrapper">

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

<div class="content">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-dark">Employee Performance</h3>
</div>
    <!-- TOP SEARCH BAR -->
    <div style="display:flex; justify-content:flex-end; margin-bottom:15px;">
    
    <form method="GET" class="search-bar d-flex align-items-center" style="gap:10px;">
        
        <input type="text" name="search" class="form-control" 
               placeholder="Search Employee" style="width:200px;">

        <select name="year" class="form-select" style="width:150px;">
            <option value="">Select Year</option>
            <?php for($y = date('Y'); $y >= 2000; $y--): ?>
                <option value="<?= $y ?>"><?= $y ?></option>
            <?php endfor; ?>
        </select>

        <button class="btn btn-light" style="padding:8px 12px;">
            🔍
        </button>

    </form>

</div>

    <!-- MAIN CARD -->
    <div class="performance-card">

        <div style="display:flex; align-items:center; justify-content:space-between;">

            <!-- LEFT TEXT -->
            <div style="flex:1; text-align:left;">
                <h3 style="color:#1c6fb7; font-weight:bold;">
                    NO RESULTS FOUND.
                </h3>
            </div>

            <!-- RIGHT FAKE TABLE LINES -->
            <div style="flex:2;">
                <?php for($i=0; $i<10; $i++): ?>
                    <div style="height:12px; background:#ddd; margin:10px 0; border-radius:5px;"></div>
                <?php endfor; ?>
            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>