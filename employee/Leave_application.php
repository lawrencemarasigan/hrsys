<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Work Calendar</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<style>

body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: url("/assets/images/bgsannic.png") no-repeat center center fixed;
    background-size: cover;
}

.overlay{
    background: rgba(173,216,230,0.85);
    min-height:100vh;
}
.wrapper{
    display:flex;
}

.sidebar{
    width:260px;
    background:#fff;
    padding:20px 12px;
    min-height:100vh;
    position:fixed;
    box-shadow:2px 0 10px rgba(0,0,0,0.08);
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
}

.logo-title{
    font-size:18px;
    font-weight:700;
    color:#2c5cc5;
}

.logo-sub{
    font-size:12px;
    color:#777;
}

.menu-item{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 16px;
    margin-bottom:6px;
    border-radius:10px;
    text-decoration:none;
    color:#333;
    font-weight:500;
    transition:all .25s ease;
}

.menu-item:hover{
    background:#eef4ff;
    transform:translateX(4px);
}

.menu-item.active{
    background:#0d6efd;
    color:#fff;
}

.content{
    margin-left:280px;
    padding:40px;
    width:100%;
}

.page-header{
    background:white;
    padding:20px 25px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    margin-bottom:25px;
}

.page-header h3{
    margin:0;
    font-weight:600;
}

.calendar-card{
    background:white;
    border-radius:14px;
    padding:20px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
}

.fc-daygrid-day:hover{
    background:#f3f7ff;
    cursor:pointer;
}

.fc-event{
    border:none;
    padding:3px;
    border-radius:6px;
    transition:.2s;
}

.fc-event:hover{
    transform:scale(1.05);
}

.modal-content{
    border-radius:12px;
}

.modal-header{
    background:#0d6efd;
    color:white;
    border-top-left-radius:12px;
    border-top-right-radius:12px;
}

.btn-primary{
    border-radius:8px;
    padding:8px 18px;
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

<a href="dashboard.php" class="menu-item active">📊 Dashboard</a>
<a href="employee_records.php" class="menu-item">👥 Employee Records</a>
<a href="requests.php" class="menu-item">📝 Requests Application</a>
<a href="leave_application.php" class="menu-item">📎 Leave Application</a>
<a href="performance.php" class="menu-item">📈 Performance</a>


</body>
</html>