<?php
require_once "authorization.php";
$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}

$leave_query = "SELECT employee_id, employee_name, type_of_leave 
FROM leave_application 
WHERE status='Pending'";

$leave_result = $conn->query($leave_query);

$request_query = "SELECT employee_id, employee_name, request_type 
FROM requests 
WHERE status='Pending'";

$request_result = $conn->query($request_query);

$count_leave = $leave_result->num_rows;
$count_request = $request_result->num_rows;

$total_notifications = $count_leave + $count_request;
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
    background: #ffffff;
    border-radius: 12px;
    padding: 80px 30px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    text-align: center;
}

.search-bar {
    display: flex;
    gap: 10px;
}

.notification-bell {
    position: relative;
    font-size: 22px;
    cursor: pointer;
}

.notification-count {
    position: absolute;
    top: -6px;
    right: -8px;
    background: red;
    color: white;
    font-size: 12px;
    padding: 3px 7px;
    border-radius: 50%;
}

.dropdown-menu-notif {
    width: 320px;
    max-height: 350px;
    overflow-y: auto;
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<div class="content">

    <div class="d-flex justify-content-between align-items-center mb-4">

<h2 style="font-weight:bold; color:#1f4e79;">EMPLOYEE PERFORMANCE</h2>

<div class="d-flex align-items-center gap-3">

<div class="dropdown">
    <div class="notification-bell" data-bs-toggle="dropdown">
        🔔
        <?php if($total_notifications > 0): ?>
            <span class="notification-count"><?= $total_notifications ?></span>
        <?php endif; ?>
    </div>

    <div class="dropdown-menu dropdown-menu-end dropdown-menu-notif">

        <h6 class="dropdown-header">Notifications</h6>

        <?php while($row = $leave_result->fetch_assoc()): ?>
            <a class="dropdown-item" href="leave_application.php">
                📎 Leave request from <b><?= $row['employee_name'] ?></b>
            </a>
        <?php endwhile; ?>

        <?php while($row = $request_result->fetch_assoc()): ?>
            <a class="dropdown-item" href="requests.php">
                📝 New request from <b><?= $row['employee_name'] ?></b>
            </a>
        <?php endwhile; ?>

        <?php if($total_notifications == 0): ?>
            <span class="dropdown-item text-muted">No new notifications</span>
        <?php endif; ?>

    </div>
</div>

<div class="search-bar">
    <input type="text" class="form-control" placeholder="Search Employee">

    <select class="form-select">
        <option>Select Year</option>
        <option>2023</option>
        <option>2024</option>
        <option>2025</option>
    </select>

    <button class="btn btn-light border">🔍</button>
</div>

</div>
</div>

<div class="performance-card">

<?php
$search = $_GET['search'] ?? '';
$year = $_GET['year'] ?? '';

$sql = "SELECT employee_id, name, department FROM employees WHERE 'Human Resource'";

if($search != ''){
    $sql .= " AND name LIKE '%$search%'";
}

$result = $conn->query($sql);
?>

<?php if($result && $result->num_rows > 0): ?>

<table class="table table-striped">
<thead>
<tr>
<th>Employee ID</th>
<th>Name</th>
<th>Department</th>
</tr>
</thead>
<tbody>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['employee_id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['department'] ?></td>
</tr>
<?php endwhile; ?>

</tbody>
</table>

<?php else: ?>

<h4 style="color:#2c5cc5; font-weight:bold;">NO RESULTS FOUND.</h4>

<?php endif; ?>

</div>

</body>
</html>