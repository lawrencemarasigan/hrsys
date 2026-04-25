<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");

// Insert request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $purpose = $_POST['purpose'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO requests (purpose, message, status) VALUES (?, ?, 'Pending')");
    $stmt->bind_param("ss", $purpose, $message);
    $stmt->execute();
}

// Fetch requests
$requests = $conn->query("SELECT * FROM requests ORDER BY id DESC");

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Requests</title>

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

/* SIDEBAR (UNCHANGED) */
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

.title{
    font-weight:700;
    color:#2c5cc5;
    margin-bottom:20px;
}

/* CARD */
.request-card{
    background:white;
    border-radius:14px;
    padding:30px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
    max-width:900px;
    margin:auto;
}

/* FORM */
.form-control{
    border-radius:10px;
    padding:12px;
}

/* BUTTON */
.btn-send{
    background:#1c6ea4;
    color:white;
    border:none;
    padding:10px 25px;
    border-radius:8px;
}

.btn-send:hover{
    background:#155a86;
}

/* TABLE */
.table thead{
    background:#f1f3f5;
}

/* STATUS */
.status{
    padding:6px 12px;
    border-radius:6px;
    font-size:12px;
    font-weight:600;
}

.status.pending{
    background:#fff3cd;
    color:#856404;
}

.status.approved{
    background:#d4edda;
    color:#155724;
}

.status.rejected{
    background:#f8d7da;
    color:#721c24;
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
            <div class="logo-sub">HR Management System</div>
        </div>
    </div>

    <a href="dashboard.php" class="menu-item">📊 Dashboard</a>
    <a href="employee_records.php" class="menu-item">👥 Employee Records</a>
    <a href="requests.php" class="menu-item active">📝 Request Validation</a>
    <a href="leave_application.php" class="menu-item">📎 Leave Application</a>
    <a href="performance.php" class="menu-item">📈 Performance</a>
</div>

<!-- CONTENT -->
<div class="content">

    <h3 class="title">REQUESTS</h3>

    <div class="request-card">

        <!-- FORM -->
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Purpose of Request</label>
                <textarea name="purpose" class="form-control" placeholder="Enter your purpose..." required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Message to Admin</label>
                <textarea name="message" class="form-control" placeholder="Enter your message..." required></textarea>
            </div>

            <div class="text-center mb-4">
                <button type="submit" class="btn-send">SEND REQUEST</button>
            </div>
        </form>

        <!-- TABLE -->
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>REQUEST NOTE</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php if($requests->num_rows > 0): ?>
                    <?php while($row = $requests->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['purpose']) ?></td>
                        <td>
                            <span class="status <?= strtolower($row['status']) ?>">
                                <?= $row['status'] ?>
                            </span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center text-muted">No requests yet</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

</div>

</div>
</div>
</body>
</html>