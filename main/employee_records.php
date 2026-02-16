<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, department, position, hired_at FROM employees";
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
.wrapper { height: 100vh; }
.sidebar {
    width: 260px;
    background: #ffffff;
    padding: 20px 12px;
    min-height: 100vh;
    position: fixed;
    box-shadow: 2px 0 8px rgba(0,0,0,0.05);
}
.content {
    margin-left: 280px;
    padding: 30px;
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
.menu-item.active { background: #0d6efd; color: #fff; }

.btn-view {
    background-color: #14532d;
    color: #fff;
    border: none;
}
.btn-view:hover { background-color: #166534; }

.btn-print {
    background-color: #fde047;
    color: #000;
    border: none;
}
.btn-print:hover {
    background-color: #facc15;
}
</style>
</head>
<body>
<div class="overlay">
<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="dashboard.php" class="menu-item <?= active('dashboard.php') ?>">📊 Dashboard</a>
    <a href="employee_records.php" class="menu-item <?= active('employee_records.php') ?>">👥 Employee Records</a>
    <a href="form201.php" class="menu-item <?= active('form201.php') ?>">🗂️ Form 201</a>
    <a href="requests.php" class="menu-item <?= active('requests.php') ?>">📝 Requests</a>
    <a href="leave_application.php" class="menu-item <?= active('leave_application.php') ?>">📎 Leave Application</a>
    <a href="performance.php" class="menu-item <?= active('performance.php') ?>">📈 Performance</a>
    <a href="work_calendar.php" class="menu-item <?= active('work_calendar.php') ?>">📅 Work Calendar</a>
</div>

<!-- CONTENT -->
<div class="content">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">EMPLOYEE RECORDS</h3>
        <button class="btn btn-success" onclick="openAddEmployeeWindow()">➕ Add Employee</button>
        <td>
    </td>
</div>


<table id="employeeTable" class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Position</th>
            <th>Hired</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['department']) ?></td>
            <td><?= htmlspecialchars($row['position']) ?></td>
            <td><?= date("m-d-Y", strtotime($row['hired_at'])) ?></td>
            <td>
                <button class="btn btn-sm btn-view" onclick="openViewWindow(<?= $row['id'] ?>)">View</button>
                <button class="btn btn-sm btn-print" onclick="printEmployee(<?= $row['id'] ?>)">Print</button>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="/assets/javascript/employee_records.js"></script>

</body>
</html>
