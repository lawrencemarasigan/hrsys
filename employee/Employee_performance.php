<?php
 require_once 'user_authorization.php';
$conn = new mysqli("localhost", "root", "", "hrsys_db");

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employee Performance</title>

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

/* SEARCH BAR */
.search-bar{
    display:flex;
    justify-content:flex-end;
    margin-bottom:15px;
}

.search-bar input{
    border-radius:8px 0 0 8px;
    border:1px solid #ccc;
    padding:8px 12px;
    width:180px;
}

.search-bar button{
    border-radius:0 8px 8px 0;
    border:none;
    background:#e9ecef;
    padding:8px 12px;
}

/* CARD */
.performance-card{
    background:#e9ecef;
    border-radius:14px;
    padding:30px;
    max-width:950px;
    margin:0 auto;
    box-shadow:0 6px 18px rgba(0,0,0,0.1);
}

/* PROFILE */
.profile-box{
    display:flex;
    align-items:center;
    gap:20px;
}

.profile-icon{
    width:80px;
    height:80px;
    background:#2f66c7;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:40px;
}

.profile-name{
    font-size:20px;
    font-weight:600;
    color:#1f5fae;
}

.profile-sub{
    font-size:16px;
    color:#333;
}

/* RIGHT SIDE TEXT */
.no-record{
    text-align:center;
    font-size:22px;
    color:#1f5fae;
    margin-top:30px;
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

    <a href="user_dashboard.php" class="menu-item">📊 Dashboard</a>
    <a href="employee_record.php" class="menu-item">👥 Employee Records</a>
    <a href="request_application.php" class="menu-item">📝 Requests Application</a>
    <a href="leave_application.php" class="menu-item">📎 Leave Application</a>
    <a href="employee_performance.php" class="menu-item active">📈 Performance</a>
</div>

<!-- CONTENT -->
<div class="content">

    <h2 class="page-title">EMPLOYEE PERFORMANCE</h2>

    <!-- SEARCH -->
    <div class="search-bar">
        <input type="text" placeholder="Select Year">
        <button>🔍</button>
    </div>

    <!-- CARD -->
    <div class="performance-card">

        <div class="row">
            <!-- LEFT PROFILE -->
            <div class="col-md-6">
                <div class="profile-box">
                    <div class="profile-icon">👤</div>
                    <div>
                        <div class="profile-name">NO USER</div>
                        <div class="profile-sub">No USER</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT TEXT -->
            <div class="col-md-6 text-center">
                <h3>2023</h3>
                <div class="no-record">No Record Found.</div>
            </div>
            
        </div>

    </div>

</div>

</div>
</div>
</body>
</html>