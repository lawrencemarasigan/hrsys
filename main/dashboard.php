<?php
$current = basename($_SERVER['PHP_SELF']);

function active($page) {
    return $GLOBALS['current'] === $page ? 'active' : '';
}

$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* ===============================
   EMPLOYEE FILTER + LIMIT 10
=================================*/

$selectedDept = isset($_GET['department']) ? $_GET['department'] : '';

// Get department list
$deptQuery = $conn->query("SELECT DISTINCT department FROM employees");

// Employee query
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
<style>
*{box-sizing:border-box;font-family:Arial,sans-serif;}
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
.sidebar{
    width:260px;
    min-height:100vh;
    background:#e9e9e9;
    padding-top:20px;
    position:fixed;
    left:0;top:0;
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
.menu-item.active,.menu-item:hover{
    background:#0b5ed7;
    color:#fff;
}
.main{
    margin-left:260px;
    padding:25px;
    width:calc(100% - 260px);
}
.topbar{
    display:flex;
    justify-content:space-between;
}
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin:20px 0;
}
.card{
    background:#fff;
    padding:20px;
    border-radius:14px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:14px;
    box-shadow:0 3px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    cursor:pointer;
}
.card:hover{
    box-shadow:0 6px 20px rgba(0,0,0,0.3);
    transform: translateY(-3px);
    border-left:4px solid #0b5ed7;
}
.bottom-row{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}
.employee-box,.calendar-box{
    background:#fff;
    padding:20px;
    border-radius:14px;
}
.employee-box{
    flex:2;
    min-width:400px;
}
.calendar-box{
    flex:1;
    min-width:300px;
}
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
table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}
th,td{
    border:1px solid #ddd;
    height:40px;padding:5px;
    text-align:right;
}
th{
    text-align:center;
    background:#f1f6fb;
}
/* Small circular highlight for today */
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
.calendar-controls{
    display:flex;gap:8px;
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
</div>

<!-- MAIN -->
<div class="main">

<div class="topbar">
    <h2>DASHBOARD</h2>
    <strong>Admin</strong>
</div>

<!-- PENDING CARDS -->
<div class="cards">
    <div class="card" onclick="window.location.href='requests.php'">
        <div>📝 Pending Request</div>
        <div><?= $pendingRequest ?></div>
    </div>
    <div class="card" onclick="window.location.href='leave_application.php'">
        <div>📎 Pending Leave</div>
        <div><?= $pendingLeave ?></div>
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
<div style="display:flex;justify-content:space-between;align-items:center;">
    <h2>WORK CALENDAR</h2>
    <div class="calendar-controls">
        <a class="cal-btn" href="?month=<?= $todayMonth ?>&year=<?= $todayYear ?>&department=<?= urlencode($selectedDept) ?>">Today</a>
        <a class="cal-btn" href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>&department=<?= urlencode($selectedDept) ?>">◀</a>
        <a class="cal-btn" href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>&department=<?= urlencode($selectedDept) ?>">▶</a>
    </div>
</div>

<h3 style="color:#0d6efd"><?= $monthName ?></h3>

<table>
<tr>
    <th>Sun</th><th>Mon</th><th>Tue</th>
    <th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
</tr>
<tr>
<?php
for ($i = 0; $i < $startDay; $i++) echo "<td></td>";

for ($day = 1; $day <= $daysInMonth; $day++) {
    if (($startDay + $day - 1) % 7 == 0 && $day != 1) echo "</tr><tr>";
    if ($day == $todayDay && $month == $todayMonth && $year == $todayYear) {
        echo "<td><span class='today-date'>$day</span></td>";
    } else {
        echo "<td>$day</td>";
    }
}
echo "</tr>";
?>
</table>
</div>

</div>
</div>
</div>
</body>
</html>