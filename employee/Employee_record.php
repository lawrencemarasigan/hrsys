<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}

// Fetch employees
$result = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employee Records</title>

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

/* KEEP SIDEBAR AS IS */
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

.title{
    font-weight:700;
    color:#2c5cc5;
    margin-bottom:20px;
}

/* CARD */
.table-card{
    background:white;
    border-radius:14px;
    padding:20px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
}

/* TABLE HEADER */
.table thead th{
    font-size:13px;
    color:#6c757d;
}

/* VIEW BUTTON */
.btn-view{
    background:#0d6efd;
    color:white;
    border:none;
    border-radius:6px;
    padding:6px 12px;
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
    <a href="employee_records.php" class="menu-item active">👥 Employee Records</a>
    <a href="requests.php" class="menu-item">📝 Requests Application</a>
    <a href="leave_application.php" class="menu-item">📎 Leave Application</a>
    <a href="performance.php" class="menu-item">📈 Performance</a>
</div>

<!-- CONTENT -->
<div class="content">
    <h3 class="title">EMPLOYEE RECORDS</h3>

    <div class="table-card">

        <!-- TOP CONTROLS -->
        <div class="d-flex justify-content-between mb-3">
            <div>
                Show 
                <select class="form-select d-inline w-auto">
                    <option>10</option>
                    <option selected>15</option>
                    <option>25</option>
                </select> entries
            </div>

            <div>
                Search:
                <input type="text" class="form-control d-inline w-auto">
            </div>
        </div>

        <!-- TABLE -->
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>DEPARTMENT</th>
                    <th>POSITION</th>
                    <th>HIRED</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['department'] ?></td>
                    <td><?= $row['position'] ?></td>
                    <td><?= $row['date_hired'] ?></td>
                    <td>
                        <button class="btn-view">View</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- FOOTER -->
        <div class="d-flex justify-content-between">
            <small>Showing 1 to <?= $result->num_rows ?> entries</small>
            <div>
                <button class="btn btn-sm btn-light">Previous</button>
                <button class="btn btn-sm btn-primary">1</button>
                <button class="btn btn-sm btn-light">Next</button>
            </div>
        </div>

    </div>
</div>

</div>
</div>
</body>
</html>