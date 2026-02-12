<?php

$current = basename($_SERVER['PHP_SELF']);
function active($page) {
    return $GLOBALS['current'] === $page ? 'active' : '';
}
function inactive($page) {
    return $GLOBALS['current'] !== $page ? '' : '';
}

date_default_timezone_set('Asia/Manila');

$todayDate = date('F d, Y');
$todayTime = date('h:i A');

$year = 2026;
$month = 2;

$firstDayOfMonth = mktime(0,0,0,$month,1,$year);
$daysInMonth = date('t', $firstDayOfMonth);
$startDay = date('w', $firstDayOfMonth);
$monthName = date('F Y', $firstDayOfMonth);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>LGU Dashboard</title>
<style>
* { box-sizing: border-box; font-family: Arial, sans-serif; }

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
    display: flex;
    height: 100vh;
}

/* Sidebar */
.sidebar {
    width: 260px;
    background: #fff;
    padding: 15px 10px;
}

.menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 15px;
    margin-bottom: 8px;
    text-decoration: none;
    color: #333;
    border-radius: 10px;
}

.menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    margin-bottom: 8px;
    text-decoration: none;
    border-radius: 10px;
    font-size: 16px;
    color: #0b5ed7;
    background: #ffffff;
}

.menu-item .icon {
    width: 20px;
    text-align: center;
    opacity: 0.6;
}

.menu a.active {
    background: #0d6efd;
    color: #fff;
}

.menu-item.dashboard {
    background: #7fb3dc;
    color: #e6f2ff;
}

.menu-item.active {
    background: #0b5ed7;
    color: #ffffff;
}

.menu-item.active .icon {
    opacity: 1;
}
.menu-item:hover {
    background: #0b5ed7;
    color: #fff;
}

/* Main */
.main {
    flex: 1;
    padding: 25px;
}

.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.topbar h2 {
    margin: 0;
    color: #0d6efd;
}

/* Cards */
.cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin: 20px 0 30px;
}

.card {
    background: #ffffff;
    padding: 20px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.card .icon {
    width: 55px;
    height: 55px;
    border-radius: 12px;
    background: #e6eef5;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #0d6efd;
}

.card h3 {
    margin: 0;
    font-size: 16px;
    color: #777;
}

.card strong {
    font-size: 22px;
    color: #0d6efd;
}

/* Calendar */
.calendar-box {
    background: #ffffff;
    border-radius: 14px;
    padding: 20px;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.calendar-header h2 {
    margin: 0;
    color: #0d6efd;
}

.calendar-controls button {
    padding: 6px 12px;
    border: 1px solid #ccc;
    background: #f5f5f5;
    border-radius: 6px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    border: 1px solid #ddd;
    height: 90px;
    text-align: right;
    padding: 10px;
    font-size: 14px;
}

th {
    text-align: center;
    background: #f1f6fb;
}

.today {
    background: #fff7dc;
}

.admin-menu {
    position: relative;
}

.admin-btn {
    cursor: pointer;
    font-weight: bold;
    color: #0d6efd;
}

.admin-btn:hover {
    background: #d1e6f6;
    color: #0d6efd;
}

.admin-btn {
    cursor: pointer;
    font-weight: bold;
    color: #0d6efd;
}

.admin-dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 35px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    min-width: 140px;
    overflow: hidden;
    z-index: 1000;
}

.admin-dropdown a {
    display: block;
    padding: 10px 14px;
    text-decoration: none;
    color: #333;
}

.admin-dropdown a:hover {
    background: #f1f6fb;
}
</style>
</head>
<body>
<div class="overlay">
    <div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="/main/dashboard.php" 
            class="menu-item dashboard <?= active('dashboard.php') ?>">
            <span class="icon">📊</span>
            <span>Dashboard</span>
        </a>

    <a href="/main/employee_records.php" 
       class="menu-item <?= active('employee_records.php') ?>">
        <span class="icon">👥</span>
        <span>Employee Records</span>
    </a>

    <a href="/hrsys/main/form201.php" 
       class="menu-item <?= active('form201.php') ?>">
        <span class="icon">🗂️</span>
        <span>Form 201</span>
    </a>

    <a href="/hrsys/main/requests.php" 
       class="menu-item <?= active('requests.php') ?>">
        <span class="icon">📝</span>
        <span>Requests</span>
    </a>

        <a href="/hrsys/main/leave_application.php" 
            class="menu-item <?= active('leave_application.php') ?>">
            <span class="icon">📎</span>
            <span>Leave Application</span>
        </a>

        <a href="/hrsys/main/performance.php" 
            class="menu-item <?= active('performance.php') ?>">
            <span class="icon">📈</span>
            <span>Employee Performance</span>
        </a>

        <a href="/hrsys/main/work_calendar.php" 
            class="menu-item <?= active('work_calendar.php') ?>">
            <span class="icon">📅</span>
            <span>Work Calendar</span>
        </a>
    </div>
<!-------------------------------------------------------------------------------------------------------------------------->
    <!-- Main Content -->
    <div class="main">

        
        <div class="topbar">
        <h2>DASHBOARD</h2>

        <div class="admin-menu">
            <div class="admin-btn" onclick="toggleAdminMenu()">
                Admin
            </div>

            <div class="admin-dropdown" id="adminDropdown">
                <a href="/main/logout.php">Logout</a>
            </div>
        </div>
    </div>

        <!-- Cards -->
        <div class="cards">
            <div class="card">
                <div class="icon">🕘</div>
                <div>
                    <h3><?= $todayDate ?></h3>
                    <strong><?= $todayTime ?></strong>
                </div>
            </div>

            <div class="card">
                <div class="icon">👥</div>
                <div>
                    <h3>0</h3>
                    <strong>Leave Request</strong>
                </div>
            </div>

            <div class="card">
                <div class="icon">📊</div>
                <div>
                    <h3>Employee</h3>
                    <strong>Performance</strong>
                </div>
            </div>
        </div>

        <!-- Calendar -->
        <div class="calendar-box">
            <div class="calendar-header">
                <h2>WORK CALENDAR</h2>
                <div class="calendar-controls">
                    <button>today</button>
                    <button>&lt;</button>
                    <button>&gt;</button>
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

                $day = 1;
                while ($day <= $daysInMonth) {
                    if (($i % 7) == 0) echo "</tr><tr>";

                    $class = ($day == 12) ? "today" : "";
                    echo "<td class='$class'>$day</td>";

                    $day++;
                    $i++;
                }
                ?>
                </tr>
            </table>
        </div>
    </div>
    </div>
</div>
<script>
function toggleAdminMenu() {
    const dropdown = document.getElementById("adminDropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

// Close dropdown when clicking outside
document.addEventListener("click", function(e) {
    const menu = document.querySelector(".admin-menu");
    if (!menu.contains(e.target)) {
        document.getElementById("adminDropdown").style.display = "none";
    }
});
</script>
</body>
</html>
