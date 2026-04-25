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
<title>Leave Application</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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

/* CONTENT */
.content{
    margin-left:280px;
    padding:40px;
    width:100%;
}

.page-title{
    text-align:center;
    font-weight:700;
    color:#1f5fae;
    margin-bottom:20px;
}

/* CARD LIKE IN IMAGE */
.leave-card{
    background:#e9ecef;
    border-radius:14px;
    padding:50px;
    max-width:900px;
    margin:0 auto;
    box-shadow:0 6px 18px rgba(0,0,0,0.1);
    text-align:center;
}

.btn-custom{
    background:#2f66c7;
    color:white;
    padding:12px 20px;
    border-radius:8px;
    margin:10px;
    font-weight:500;
    border:none;
    transition:0.3s;
}

.btn-custom:hover{
    background:#1d4ea3;
}
</style>
</head>

<body>
<div class="overlay">
<div class="wrapper">

<!-- SIDEBAR (UNCHANGED) -->
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="/assets/images/sannic.png">
        <div>
            <div class="logo-title">San Nicolas</div>
            <div class="logo-sub">HR Management System</div>
        </div>
    </div>

    <a href="dashboard.php" class="menu-item">📊 Dashboard</a>
    <a href="employee_records.php" class="menu-item">👥 Employee Records</a>
    <a href="requests.php" class="menu-item">📝 Requests Application</a>
    <a href="leave_application.php" class="menu-item active">📎 Leave Application</a>
    <a href="performance.php" class="menu-item">📈 Performance</a>
</div>

<!-- CONTENT -->
<div class="content">

    <h2 class="page-title">LEAVE APPLICATION</h2>

    <div class="leave-card">
        <button class="btn-custom">Fill Up Leave Application Form</button>
        <button class="btn-custom">List of Approved/Disapproved Leave</button>
    </div>

</div>

</div>
</div>
</body>
</html>