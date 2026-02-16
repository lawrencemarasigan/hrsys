<?php
$current = basename($_SERVER['PHP_SELF']);

function active($page) {
    return $GLOBALS['current'] === $page ? 'active' : '';
}

date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Form 201</title>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    background:url("/assets/images/bgsannic.png") no-repeat center fixed;
    background-size:cover;
}

/* Sidebar */
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
    object-fit:contain;
}

.logo-text{
    display:flex;
    flex-direction:column;
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

.sidebar{
    width:260px;
    height:100vh;
    background:#e9e9e9;
    padding-top:20px;
    position:fixed;
    left:0;
    top:0;
}

.sidebar a{
    display:block;
    padding:14px 20px;
    margin:6px 10px;
    text-decoration:none;
    color:#2c5cc5;
    font-size:16px;
    border-radius:10px;
    transition:0.2s;
}

.sidebar a:hover{
    background:#d6e4ff;
}

.sidebar a.active{
    background:linear-gradient(90deg,#2c5cc5,#1e73e8);
    color:white;
}

.main{
    margin-left:260px;
    min-height:100vh;
    padding:30px;
    background:
    linear-gradient(rgba(120,170,190,0.75), rgba(120,170,190,0.75)),
    url('/hrsys/assets/images/bgsannic.png');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
}

.box-container{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap:40px;
    padding-top:20px;
}

.box-item{
    text-align:center;
}

.box-image{
    width:100%;
    max-width:220px;
    height:300px;
    object-fit:cover;
    border:2px solid #333;
    background:#eee;
}

/* Title */
.box-title{
    font-weight:bold;
    margin-bottom:10px;
    font-size:16px;
    color:#222;
}

/* USE button */
.use-btn{
    margin-top:10px;
    padding:7px 22px;
    border:1px solid #888;
    background:#e0e0e0;
    cursor:pointer;
}

.use-btn:hover{
    background:#cfcfcf;
}
</style>

</head>
<body>

<!-- Sidebar -->
<div class="sidebar">

    <!-- Logo Section -->
    <div class="sidebar-logo">
        <img src="/assets/images/sannic.png" alt="LGU Logo">
        <div class="logo-text">
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

<!-- Main Content -->
<div class="main">

<div class="box-container">
    <div class="box-item">
        <div class="box-title">Oath of Office</div>

        <img src="/assets/images/oath.jpg"
             class="box-image">

        <button class="use-btn">USE</button>
    </div>



    <div class="box-item">
        <div class="box-title">Availability of Funds</div>

        <img src="/assets/images/sannic.png"
             class="box-image">

        <button class="use-btn">USE</button>
    </div>

    <div class="box-item">
        <div class="box-title">Assumption</div>

        <img src="/assets/images/assumption.jpg"
             class="box-image">

        <button class="use-btn">USE</button>
    </div>

    <div class="box-item">
        <div class="box-title">Certificate</div>
        <img src="/assets/images/sannic.png"
             class="box-image">

        <button class="use-btn">USE</button>
    </div>

    <div class="box-item">
        <div class="box-title">CS-Form No. 33-A</div>

        <img src="/assets/images/csform.jpg"
             class="box-image">

        <button class="use-btn">USE</button>
    </div>

    <div class="box-item">
        <div class="box-title">Appointment</div>

        <img src="/assets/images/appointment.jpg"
             class="box-image">

        <button class="use-btn">USE</button>
    </div>

</div>

</div>

</body>
</html>