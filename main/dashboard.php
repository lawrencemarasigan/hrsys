<?php
$current = basename($_SERVER['PHP_SELF']);

function active($page) {
    return $GLOBALS['current'] === $page ? 'active' : '';
}

date_default_timezone_set('Asia/Manila');

$todayDate = date('F d, Y');
$todayTime = date('h:i A');

/* Dynamic calendar */
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
.wrapper{display:flex;height:100vh}

/* Sidebar */
.sidebar{width:260px;background:#fff;padding:15px}
.menu-item{
display:flex;
gap:12px;
padding:14px;
margin-bottom:10px;
border-radius:10px;
text-decoration:none;
color:#0b5ed7;
}
.menu-item.active,
.menu-item:hover{background:#0b5ed7;color:#fff}

/* Main */
.main{flex:1;padding:25px}

.topbar{display:flex;justify-content:space-between}

.cards{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
margin:20px 0;
}

.card{
background:#fff;
padding:20px;
border-radius:14px;
display:flex;
gap:15px;
}

.calendar-box{
background:#fff;
padding:20px;
border-radius:14px;
}

.calendar-controls a{
padding:6px 12px;
border:1px solid #ccc;
border-radius:6px;
text-decoration:none;
margin-left:4px;
color:#333;
}

table{
width:100%;
border-collapse:collapse;
margin-top:15px;
}

th,td{
border:1px solid #ddd;
height:90px;
padding:10px;
text-align:right;
}

th{text-align:center;background:#f1f6fb}

.today{background:#fff7dc}
</style>
</head>

<body>
<div class="overlay">
    <div class="wrapper">

<!-- SIDEBAR -->
    <div class="sidebar">
        <a href="dashboard.php" class="menu-item active">📊 Dashboard</a>
        <a href="employee_records.php" class="menu-item">👥 Employee Records</a>
        <a href="form201.php" class="menu-item">🗂️ Form 201</a>
        <a href="requests.php" class="menu-item">📝 Requests</a>
        <a href="leave_application.php" class="menu-item">📎 Leave</a>
        <a href="performance.php" class="menu-item">📈 Performance</a>
        <a href="work_calendar.php" class="menu-item">📅 Calendar</a>
    </div>

<!-- MAIN -->
    <div class="main">
        <div class="topbar">
        <h2>DASHBOARD</h2>
        <strong>Admin</strong>
    </div>

<!-- CARDS -->
    <div class="cards">
        <div class="card">
            <div>🕘</div>
            <div>
            <h3><?= $todayDate ?></h3>
            <strong><?= $todayTime ?></strong>
        </div>
    </div>

    <div class="card">
        <div>👥</div>
            <div>
            <h3>0</h3>
            <strong>Leave Request</strong>
        </div>
    </div>

    <div class="card">
        <div>📊</div>
            <div>
            <h3>Employee</h3>
            <strong>Performance</strong>
        </div>
        </div>
    </div>

<!-- CALENDAR -->
<div class="calendar-box">

    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h2>WORK CALENDAR</h2>

    <div class="calendar-controls">
        <a href="?month=<?= date('n') ?>&year=<?= date('Y') ?>">Today</a>
        <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>">&lt;</a>
        <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>">&gt;</a>
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
    for ($i=0; $i<$startDay; $i++) echo "<td></td>";
        $day = 1;
            while ($day <= $daysInMonth) {
            if ($i % 7 == 0) echo "</tr><tr>";
            $class = ($day == date('j') && $month == date('n') && $year == date('Y')) ? "today" : "";
        echo "<td class='$class'>$day</td>";
    $day++;
$i++;
}
?>
            </tr>
        </table>
    </div>
<script src="/assets/javascript/dashboard.js"></script>
                </div>
            </div>
        </div>
    </body>
</html>
