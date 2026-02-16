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

.wrapper {
    height: 100vh;
}

/* SIDEBAR */
.sidebar {
    width: 260px;
    background: #ffffff;
    padding: 20px 12px;
    min-height: 100vh;
    position: fixed;
    box-shadow: 2px 0 8px rgba(0,0,0,0.05);
}

.sidebar-logo{
    display:flex;
    align-items:center;
    gap:12px;
    padding:15px 20px;
    margin-bottom:10px;
}

.sidebar-logo img{
    width:45px;
    height:45px;
}

.logo-title{
    font-size:18px;
    font-weight:bold;
    color:#2c5cc5;
}

.logo-sub{
    font-size:12px;
    color:#666;
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

/* CONTENT */
.content {
    margin-left: 280px;
    padding: 30px;
}

/* BUTTONS */
.btn-view {
    background-color: #14532d;
    color: #fff;
}

.btn-print {
    background-color: #fde047;
    color: #000;
}

.add-panel {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.add-panel-content {
    background: #fff;
    width: 800px;
    max-width: 95%;
    border-radius: 10px;
    padding: 25px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.panel-header h4 {
    color: #0d6efd;
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

<div class="content">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>EMPLOYEE RECORDS</h3>
    <button class="btn btn-success" onclick="showAddEmployeeForm()">
        ➕ Add Employee
    </button>
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
    <button class="btn btn-sm btn-view">
        View
    </button>
    <button class="btn btn-sm btn-print">
        Print
    </button>
</td>
</tr>

<?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="addEmployeePanel" class="add-panel">
    <div class="add-panel-content">
        <div class="panel-header">
        <h4>Add New Employee</h4>
    <button class="btn-close" onclick="hideAddEmployeeForm()"></button>
</div>

<form action="add_employee.php" method="POST">

<div class="row mb-3">
<div class="col">
    <label>First Name</label>
    <input type="text" name="first_name" class="form-control" required>
</div>

<div class="col">
    <label>Last Name</label>
    <input type="text" name="last_name" class="form-control" required>
</div>

<div class="col">
    <label>Middle Name</label>
        <input type="text" name="middle_name" class="form-control">
    </div>
</div>

<div class="mb-3">
    <label>Address</label>
    <input type="text" name="address" class="form-control">
</div>

<div class="row mb-3">
<div class="col">
    <label>Civil Status</label>
        <select name="civil_status" class="form-control">
            <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Widowed">Widowed</option>
            <option value="Separated">Separated</option>
    </select>
</div>

<div class="col">
    <label>Blood Type</label>
        <select name="blood_type" class="form-control">
            <option>A</option>
            <option>A-</option>
            <option>A+</option>
            <option>B</option>
            <option>B-</option>
            <option>B+</option>
            <option>AB-</option>
            <option>AB+</option>
            <option>O+</option>
            <option>O+</option>
        </select>
    </div>
</div>

<div class="row mb-3">
<div class="col">
    <label>Philhealth No.</label>
    <input type="text" name="philhealth" class="form-control">
</div>

<div class="col">
    <label>SSS No.</label>
    <input type="text" name="sss" class="form-control">
</div>

<div class="col">
    <label>GSIS No.</label>
        <input type="text" name="gsis" class="form-control">
    </div>
</div>

<div class="row mb-3">
<div class="col">
    <label>Pagibig No.</label>
    <input type="text" name="pagibig" class="form-control">
</div>

<div class="col">
    <label>Tin No.</label>
        <input type="text" name="tin" class="form-control">
    </div>
</div>

<div class="mb-3">
<label>Department</label>
<select name="department" class="form-control">
    <option value="">Select</option>
            <option>HR</option>
            <option>Accounting</option>
            <option>IT</option>
            <option>Administration</option>
    </select>
</div>


<!-- POSITION -->
<div class="mb-3">
<label>Position</label>
<input type="text" name="position" class="form-control">
</div>


<!-- EMPLOYEE STATUS -->
<div class="mb-3">
    <label>Employee Status</label>
        <select name="employee_status" class="form-control">
            <option value="">Select Status</option>
                <option>Permanent</option>
                <option>Contractual</option>
                <option>Casual</option>
                <option>Job Order</option>
        </select>
</div>

<div class="mb-3">
<label>Salary Grade</label>
<input type="text" name="salary_grade" class="form-control">
</div>

<div class="mb-3">
<label>Date Hired</label>
<input type="date" name="date_hired" class="form-control">
</div>

<div class="row mb-3">

<div class="col">
<label>Date of Appointment</label>
<input type="date" name="date_appointment" class="form-control">
</div>

<div class="col">
    <label>Has Appointment Ended?</label>
        <select name="appointment_ended" class="form-control">
        <option value="">Select</option>
            <option>No</option>
            <option>Yes</option>
        </select>
    </div>
</div>


<!-- ROLE + EMAIL + PASSWORD -->
<div class="row mb-3">
    <div class="col">
        <label>Role</label>
            <select name="role" class="form-control">
            <option value="">Role</option>
            <option>Admin</option>
            <option>HR</option>
        <option>Employee</option>
</select>
</div>

<div class="col">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<div class="col">
<label>Password</label>
<input type="password" name="password" class="form-control">
</div>

</div>


<!-- BUTTONS -->
<div class="text-end">

            <button type="submit" class="btn btn-primary">
            Save
            </button>

<button type="button"
class="btn btn-secondary"
onclick="hideAddEmployeeForm()">
                Close
            </button>
        </div>
    </form>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="/assets/javascript/employee_records.js"></script>


</body>
</html>
