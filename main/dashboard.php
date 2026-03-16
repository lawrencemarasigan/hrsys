<?php
require_once "authorization.php";
$current = basename($_SERVER['PHP_SELF']);
function active($page) {
    return $GLOBALS['current'] === $page ? 'active' : '';
}

$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selectedDept = isset($_GET['department']) ? $_GET['department'] : '';

$deptQuery = $conn->query("SELECT DISTINCT department FROM employees");

$sql = "SELECT name, department, position, employee_status FROM employees";

if (!empty($selectedDept)) {
    $sql .= " WHERE department = ?";
}

$sql .= " LIMIT 10";

$stmt = $conn->prepare($sql);

if (!empty($selectedDept)) {
    $stmt->bind_param("s", $selectedDept);
}

$stmt->execute();
$result = $stmt->get_result();


$pendingRequestQuery = $conn->query("SELECT COUNT(*) AS total_requests FROM requests WHERE status='Pending'");
$pendingRequest = $pendingRequestQuery ? $pendingRequestQuery->fetch_assoc()['total_requests'] : 0;

$pendingLeaveQuery = $conn->query("SELECT COUNT(*) AS total_leave FROM leave_application WHERE status='Pending'");
$pendingLeave = $pendingLeaveQuery ? $pendingLeaveQuery->fetch_assoc()['total_leave'] : 0;

$totalEmployees = $conn->query("SELECT COUNT(*) AS total_employees FROM employees");
$totalEmployees = $totalEmployees ? $totalEmployees->fetch_assoc()['total_employees'] : 0;

date_default_timezone_set('Asia/Manila');

$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$year  = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

$todayDay   = date('j');
$todayMonth = date('n');
$todayYear  = date('Y');

$firstDayOfMonth = mktime(0,0,0,$month,1,$year);
$daysInMonth = date('t', $firstDayOfMonth);
$startDay = date('w', $firstDayOfMonth);
$monthName = date('F Y', $firstDayOfMonth);

$prevMonth = $month - 1;
$prevYear = $year;
$nextMonth = $month + 1;
$nextYear = $year;

if ($prevMonth == 0) { $prevMonth = 12; $prevYear--; }
if ($nextMonth == 13) { $nextMonth = 1; $nextYear++; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>LGU Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/*----- CSS -----*/
*{
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    margin:0;
    background:url("/assets/images/bgsannic.png") no-repeat center fixed;
    background-size:cover;
}

.overlay{
    background:rgba(173,216,230,.85);
    min-height:100vh;
}

.wrapper{
    display:flex;
}

/* SIDEBAR */

.sidebar{
    width:260px;
    min-height:100vh;
    background:#e9e9e9;
    padding-top:20px;
    position:fixed;
    left:0;
    top:0;
}

.sidebar-logo{
    display:flex;
    gap:12px;
    padding:15px 20px;
    align-items:center;
}

.sidebar-logo img{
    width:45px;
    height:45px;
}

.logo-title{
    font-weight:bold;
    color:#2c5cc5;
}

.menu-item{
    display:flex;
    gap:12px;
    padding:14px;
    margin:10px;
    border-radius:10px;
    text-decoration:none;
    color:#0b5ed7;
}

.menu-item.active,
.menu-item:hover{
    background:#0b5ed7;
    color:#fff;
}

/* MAIN */

.main{
    margin-left:260px;
    width:calc(100% - 260px);
}

/* TOPBAR */

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:#e9e9e9;
    padding:15px 25px;
    border-bottom:1px solid #ddd;
}

.topbar h2{
    color:#1c6fb7;
    font-weight:700;
    margin:0;
}

.topbar-right{
    display:flex;
    align-items:center;
    gap:8px;
    color:#333;
    font-size:14px;
}

.user-icon{
    font-size:18px;
}

/* CARDS */

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    padding:25px;
}

.card-modern{
    background:#fff;
    padding:22px;
    border-radius:18px;
    display:flex;
    align-items:center;
    gap:18px;
    box-shadow:0 4px 12px rgba(0,0,0,0.12);
    transition:0.2s;
}

.card-modern:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 22px rgba(0,0,0,0.18);
}

.card-icon{
    width:55px;
    height:55px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}

.green{
    background:#e7f5ec;
    color:#2e7d32;
}

.yellow{
    background:#fff6d6;
    color:#e6b800;
}

.blue{
    background:#d0ebff;
    color:#1c7ed6;
    font-size:15px;
}

.card-number{
    font-size:14px;
    font-weight:500;
}

.card-label{
    font-size:14px;
    color:#666;
}

/* LOWER SECTION */

.bottom-row{
    display:flex;
    gap:25px;
    padding:0 25px 25px 25px;
    flex-wrap:wrap;
}

/* BOXES */

.employee-box,
.calendar-box{
    background:#fff;
    padding:25px;
    border-radius:20px;
    box-shadow:0 6px 18px rgba(0,0,0,0.12);
    transition:0.2s;
}

.employee-box:hover,
.calendar-box:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(0,0,0,0.18);
}

.employee-box{
    flex:2.2;
}

.calendar-box{
    flex:1;
    height: 370px;
}

/* EMPLOYEE TABLE */

.employee-table{
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}

.employee-table th{
    background:#0b5ed7;
    color:#fff;
    padding:10px;
}

.employee-table td{
    padding:10px;
    border-bottom:1px solid #ddd;
}

/* CALENDAR */

.calendar-box table{
    width:100%;
    table-layout:fixed;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th,td{
    border:1px solid #ddd;
    height:40px;
    padding:5px;
    text-align:right;
}

th{
    text-align:center;
    background:#f1f6fb;
}

.today-date{
    display:inline-block;
    width:26px;
    height:26px;
    line-height:26px;
    background:#0b5ed7;
    color:#fff;
    border-radius:50%;
    font-weight:bold;
    text-align:center;
}

.calendar-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:10px;
}

#monthTitle{
    color:#0d6efd;
    margin:0;
}

/* BUTTONS */

.calendar-controls{
    display:flex;
    gap:8px;
}

.cal-btn{
    text-decoration:none;
    padding:6px 10px;
    background:#0b5ed7;
    color:#fff;
    border-radius:6px;
    font-size:13px;
}

.cal-btn:hover{
    background:#084298;
}

select{
    padding:6px;
}
</style>
</head>
<!----- HTML ----->
<body>
<div class="overlay">
<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="/assets/images/sannic.png">
        <div>
            <div class="logo-title">San Nicolas</div>
            <div style="font-size:12px;">HR Management System</div>
        </div>
    </div>

    <a href="dashboard.php" class="menu-item active">📊 Dashboard</a>
    <a href="employee_records.php" class="menu-item">👥 Employee Records</a>
    <a href="form201.php" class="menu-item">🗂️ Form 201</a>
    <a href="requests.php" class="menu-item">📝 Requests</a>
    <a href="leave_application.php" class="menu-item">📎 Leave Application</a>
    <a href="performance.php" class="menu-item">📈 Performance</a>
    <a href="work_calendar.php" class="menu-item">📅 Calendar</a>
    <a href="#" class="menu-item logout" data-bs-toggle="modal" data-bs-target="#logoutModal">
        🚪 Logout
    </a>
</div>

<!-- MAIN -->
<div class="main">

<div class="topbar">
    <div class="topbar-left">
        <h2>DASHBOARD</h2>
    </div>

    <div class="topbar-right">
        <span class="user-icon">👤</span>
        <span class="username">Admin</span>
    </div>
</div>

<div class="topbar-line"></div>

<!-- CARDS -->
<div class="cards">

<div class="card-modern">
    <div class="card-icon blue">📅</div>
    <div class="card-info">
        <div class="card-number" id="currentTimeSmall"></div>
        <div class="card-label">Current Time&Date</div>
    </div>
</div>
<div class="card-modern">
    <div class="card-icon yellow">👥</div>
    <div class="card-info">
        <div class="card-number"><?= $totalEmployees ?></div>
        <div class="card-label">Total Employees</div>
    </div>
</div>
<div class="card-modern">
    <div class="card-icon green">📝</div>
    <div class="card-info">
        <div class="card-number"><?= $pendingRequest ?></div>
        <div class="card-label">Pending Requests</div>
    </div>
</div>
<div class="card-modern">
    <div class="card-icon yellow">📎</div>
    <div class="card-info">
        <div class="card-number"><?= $pendingLeave ?></div>
        <div class="card-label">Pending Leave</div>
    </div>
</div>
</div>

<div class="bottom-row">

<!-- EMPLOYEE LIST -->
<div class="employee-box">
<h2>EMPLOYEE LIST</h2>

<form method="GET" style="margin-bottom:10px;">
    <input type="hidden" name="month" value="<?= $month ?>">
    <input type="hidden" name="year" value="<?= $year ?>">

    <select name="department" onchange="this.form.submit()">
        <option value="">All Departments</option>
        <?php while($dept = $deptQuery->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($dept['department']) ?>"
                <?= ($selectedDept == $dept['department']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($dept['department']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</form>

<table class="employee-table">
<tr>
    <th>Name</th>
    <th>Department</th>
    <th>Position</th>
    <th>Status</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['department']) ?></td>
    <td><?= htmlspecialchars($row['position']) ?></td>
    <td><?= htmlspecialchars($row['employee_status']) ?></td>
</tr>
<?php endwhile; ?>

</table>
</div>

<!-- CALENDAR -->
<div class="calendar-box">

<div class="calendar-header">

    <h3 id="monthTitle"><?= $monthName ?></h3>

    <div class="calendar-controls">
        <button class="cal-btn" onclick="goToday()">Today</button>
        <button class="cal-btn" onclick="changeMonth(-1)">◀</button>
        <button class="cal-btn" onclick="changeMonth(1)">▶</button>
    </div>

</div>
<table>
    <tr>
        <th>Sun</th>
        <th>Mon</th>
        <th>Tue</th>
        <th>Wed</th>
        <th>Thu</th>
        <th>Fri</th>
        <th>Sat</th>
    </tr>
<tbody id="calendarBody"></tbody>
</table>
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
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/javascript/dashboard.js"></script>

</div>
</div>
</div>
</body>
</html>