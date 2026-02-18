<?php
$current = basename($_SERVER['PHP_SELF']);

function active($page) {
    return $GLOBALS['current'] === $page ? 'active' : '';
}

$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT name, department, position, employee_status FROM employees");

date_default_timezone_set('Asia/Manila');

$todayDate = date('F d, Y');
$todayTime = date('h:i A');

/* ===== DYNAMIC CALENDAR ===== */
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$year  = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

$firstDayOfMonth = mktime(0,0,0,$month,1,$year);
$daysInMonth = date('t', $firstDayOfMonth);
$startDay = date('w', $firstDayOfMonth);
$monthName = date('F Y', $firstDayOfMonth);

/* Navigation */
$prevMonth = $month - 1;
$prevYear = $year;
$nextMonth = $month + 1;
$nextYear = $year;

if ($prevMonth == 0) {
    $prevMonth = 12;
    $prevYear--;
}
if ($nextMonth == 13) {
    $nextMonth = 1;
    $nextYear++;
}
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
.overlay{background:rgba(173,216,230,.85);min-height:100vh;}
.wrapper{display:flex;}
.sidebar{
    width:260px;min-height:100vh;background:#e9e9e9;
    padding-top:20px;position:fixed;left:0;top:0;
}
.sidebar-logo{display:flex;gap:12px;padding:15px 20px;}
.sidebar-logo img{width:45px;height:45px;}
.logo-title{font-weight:bold;color:#2c5cc5;}
.menu-item{
    display:flex;gap:12px;padding:14px;margin:10px;
    border-radius:10px;text-decoration:none;color:#0b5ed7;
}
.menu-item.active,.menu-item:hover{background:#0b5ed7;color:#fff;}
.main{margin-left:260px;padding:25px;width:calc(100% - 260px);}
.topbar{display:flex;justify-content:space-between;}
.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;}
.card{background:#fff;padding:20px;border-radius:14px;display:flex;gap:15px;}
.bottom-row{display:flex;gap:20px;flex-wrap:wrap;}
.employee-box,.calendar-box{
    background:#fff;padding:20px;border-radius:14px;
}
.employee-box{flex:2;min-width:400px;}
.calendar-box{flex:1;min-width:300px;}
.employee-table{width:100%;border-collapse:collapse;font-size:13px;}
.employee-table th{background:#0b5ed7;color:#fff;padding:10px;}
.employee-table td{padding:10px;border-bottom:1px solid #ddd;}
table{width:100%;border-collapse:collapse;margin-top:10px;}
th,td{border:1px solid #ddd;height:40px;padding:5px;text-align:right;}
th{text-align:center;background:#f1f6fb;}
.today{background:#fff7dc;}

/* CALENDAR BUTTONS */
.calendar-controls{display:flex;gap:8px;}
.cal-btn{
    text-decoration:none;
    padding:6px 10px;
    background:#0b5ed7;
    color:#fff;
    border-radius:6px;
    font-size:13px;
}
.cal-btn:hover{background:#084298;}
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

<div class="cards">
    <div class="card">
        <div>🕘</div>
        <div>
            <h3><?= $todayDate ?></h3>
            <strong><?= $todayTime ?></strong>
        </div>
    </div>
</div>

<div class="bottom-row">

<!-- EMPLOYEE LIST -->
<div class="employee-box">
<h2>EMPLOYEE LIST</h2>
<table class="employee-table">
<tr>
    <th>Name</th><th>Department</th><th>Position</th><th>Status</th>
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
        <a class="cal-btn" href="?month=<?= date('n') ?>&year=<?= date('Y') ?>">Today</a>
        <a class="cal-btn" href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>">◀</a>
        <a class="cal-btn" href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>">▶</a>
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
for ($i = 0; $i < $startDay; $i++) {
    echo "<td></td>";
}

for ($day = 1; $day <= $daysInMonth; $day++) {

    if (($startDay + $day - 1) % 7 == 0 && $day != 1) {
        echo "</tr><tr>";
    }

    $class = ($day == date('j') && $month == date('n') && $year == date('Y'))
        ? "today" : "";

    echo "<td class='$class'>$day</td>";
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