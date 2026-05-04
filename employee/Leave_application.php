<?php
 require_once 'user_authorization.php';

$employee_id = $_SESSION['employee_id'];

$conn = new mysqli("localhost", "root", "", "hrsys_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = false;

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employee_name = $_POST['employee_name'] ?? '';
    $department    = $_POST['department'] ?? '';
    $position      = $_POST['position'] ?? '';
    $type_of_leave = $_POST['leave_type'] ?? '';
    $start_date    = $_POST['start_date'] ?? '';
    $end_date      = $_POST['end_date'] ?? '';

    $stmt = $conn->prepare("INSERT INTO leave_application
        (employee_id, employee_name, department, position, type_of_leave, start_date, end_date, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')");

    $stmt->bind_param("issssss",
        $employee_id,
        $employee_name,
        $department,
        $position,
        $type_of_leave,
        $start_date,
        $end_date
    );

    if ($stmt->execute()) {
    $success = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$query = "SELECT department, position, type_of_leave, start_date, end_date, status 
          FROM leave_application 
          WHERE employee_id = ?
          ORDER BY start_date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();
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

/* CARD */
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
.modal {
    z-index: 1055 !important;
}

.leave-history {
  margin-top: 30px;
  background: #ffffff;
  padding: 20px;
  border-radius: 10px;
}

.leave-history table {
  width: 100%;
  border-collapse: collapse;
}

.leave-history th, .leave-history td {
  padding: 10px;
  text-align: center;
  border-bottom: 1px solid #ddd;
}

.approved {
  color: green;
  font-weight: bold;
}

.disapproved {
  color: red;
  font-weight: bold;
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

    <a href="user_dashboard.php" class="menu-item">📊 Dashboard</a>
    <a href="employee_record.php" class="menu-item">👥 Employee Records</a>
    <a href="request_application.php" class="menu-item">📝 Requests Application</a>
    <a href="leave_application.php" class="menu-item active">📎 Leave Application</a>
    <a href="employee_performance.php" class="menu-item">📈 Performance</a>
</div>

<!-- CONTENT -->
<div class="content">

    <h2 class="page-title">LEAVE APPLICATION</h2>

    <div class="leave-card">
        <button class="btn-custom" data-bs-toggle="modal" data-bs-target="#leaveModal">
            Fill Up Leave Application Form
        </button>
        <div class="leave-history">
    <h3>Your Leave Records</h3>

    <table>
        <thead>
        <tr>
            <th>Department</th>
            <th>Position</th>
            <th>Type of Leave</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['department'] ?></td>
            <td><?= $row['position'] ?></td>
            <td><?= $row['type_of_leave'] ?></td>
            <td><?= $row['start_date'] ?></td>
            <td><?= $row['end_date'] ?></td>
            <td class="<?= strtolower($row['status']) ?>">
                <?= $row['status'] ?>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    </div>
</div>
    </div>
<div class="modal fade" id="leaveModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Leave Application Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST">
        <div class="modal-body">

          <div class="mb-3">
            <label>Employee Name</label>
            <input type="text" name="employee_name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Department</label>
            <input type="text" name="department" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Position</label>
            <input type="text" name="position" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Type of Leave</label>
            <select name="leave_type" class="form-control" required>
              <option value="">Select Leave Type</option>
              <option>Sick Leave</option>
              <option>Vacation Leave</option>
              <option>Emergency Leave</option>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Start Date</label>
              <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label>End Date</label>
              <input type="date" name="end_date" class="form-control" required>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit Application</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content text-center p-4">
      <h4 class="text-success">Success!</h4>
      <p>Your leave application has been submitted.</p>
      <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
    </div>
  </div>
</div>

</div>

</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php if ($success): ?>
<script>
    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();
</script>
<?php endif; ?>

</body>
</html>