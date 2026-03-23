<?php
require_once "authorization.php";
$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* ===== AJAX HANDLER ===== */
if (isset($_POST['action'])) {

    if ($_POST['action'] == "get") {
        $id = $_POST['id'];

        $stmt = $conn->prepare("SELECT * FROM requests WHERE request_no=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        echo json_encode($result->fetch_assoc());
        exit;
    }

    if ($_POST['action'] == "update") {
        $id = $_POST['request_no'];
        $status = $_POST['status'];

        $stmt = $conn->prepare("UPDATE requests SET status=? WHERE request_no=?");
        $stmt->bind_param("si", $status, $id);

        echo $stmt->execute() ? "success" : "error";
        exit;
    }
}

$sql = "SELECT request_no, employee_id, employee_name, department, position, request_type, status FROM requests";
$result = $conn->query($sql);

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employee Requests</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>

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
    height: 100vh;
}

.sidebar {
    width: 260px;
    background: #ffffff;
    padding: 20px 12px;
    min-height: 100vh;
    position: fixed;
    box-shadow: 2px 0 8px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
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
    height:45px;
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

.menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    margin-bottom: 8px;
    border-radius: 12px;
    text-decoration: none;
    color: #1e40af;
    font-weight: 500;
}

.menu-item.active {
    background: #0d6efd;
    color: #fff;
}

.content {
    margin-left: 280px;
    padding: 30px;
}

.btn-view {
    background-color: #14532d;
    color: #fff;
}

.btn-view:hover {
    background-color: #166534;
    color: #fff;
}

.btn-print {
    background-color: #fde047;
    color: #000;
}

.btn-print:hover {
    background-color: #facc15;
    color: #000;
}

.add-panel {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.add-panel-content {
    background: #fff;
    width: 800px;
    max-width: 95%;
    border-radius: 10px;
    padding: 25px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.panel-header h4 {
    color: #0d6efd;
}

.panel-overlay{
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.4);
    display:flex;
    justify-content:center;
    align-items:center;
}

.panel-container{
    background:#fff;
    padding:20px;
    width:500px;
    border-radius:8px;
}

.view-field{
    background:#e9ecef;
    padding:10px;
    border-radius:6px;
}

.panel-buttons{
    margin-top:15px;
    text-align:right;
}

.btn{
    padding:8px 15px;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

.btn-primary{background:#0d6efd;color:#fff;}
.btn-danger{background:#dc3545;color:#fff;}
.btn-secondary{background:#6c757d;color:#fff;}

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

    <a href="dashboard.php" class="menu-item <?= active('dashboard.php') ?>">📊 Dashboard</a>
    <a href="employee_records.php" class="menu-item <?= active('employee_records.php') ?>">👥 Employee Records</a>
    <a href="form201.php" class="menu-item <?= active('form201.php') ?>">🗂️ Form 201</a>
    <a href="requests.php" class="menu-item <?= active('requests.php') ?>">📝 Requests</a>
    <a href="leave_application.php" class="menu-item <?= active('leave_application.php') ?>">📎 Leave Application</a>
    <a href="performance.php" class="menu-item <?= active('performance.php') ?>">📈 Performance</a>
    <a href="work_calendar.php" class="menu-item <?= active('work_calendar.php') ?>">📅 Work Calendar</a>
</div>

<div class="content">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-dark">EMPLOYEE REQUESTS</h3>
    <button class="btn btn-warning fw-semibold" onclick="window.print()">
        Print Requests
    </button>
</div>

<table id="employeeTable" class="table table-bordered table-striped">
<thead class="table-primary">
<tr>
    <th>Request No.</th>
    <th>Employee ID</th>
    <th>Employee Name</th>
    <th>Department</th>
    <th>Position</th>
    <th>Request Type</th>
    <th>Status</th>
    <th width="120">Action</th>
</tr>
</thead>

<tbody>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= "Req" . str_pad($row['request_no'], 3, "0", STR_PAD_LEFT); ?></td>
    <td><?= htmlspecialchars($row['employee_id']) ?></td>
    <td><?= htmlspecialchars($row['employee_name']) ?></td>
    <td><?= htmlspecialchars($row['department']) ?></td>
    <td><?= htmlspecialchars($row['position']) ?></td>
    <td><?= htmlspecialchars($row['request_type']) ?></td>
    <td><?= htmlspecialchars($row['status']) ?></td>
    <td>
        <button class="btn btn-sm btn-view"
            onclick="showViewEmployee('<?= $row['request_no'] ?>')">
            View
        </button>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<!-- VIEW MODAL -->
<div class="modal fade" id="viewModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Request Details</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form id="updateForm">
<div class="modal-body">

<input type="hidden" name="request_no" id="request_no">

<label>Employee Name</label>
<input type="text" id="employee_name" class="form-control mb-2" readonly>

<label>Department</label>
<input type="text" id="department" class="form-control mb-2" readonly>

<label>Position</label>
<input type="text" id="position" class="form-control mb-2" readonly>

<label>Request Type</label>
<input type="text" id="request_type" class="form-control mb-2" readonly>

<label>Status</label>
<select name="status" id="status" class="form-control">
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Rejected">Rejected</option>
</select>

</div>

<div class="modal-footer">
<button type="submit" class="btn btn-primary">Update</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</form>

</div>
</div>
</div>

<!-- SUCCESS MODAL -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Update Successful</h5>
      </div>

      <div class="modal-body">
        Status updated successfully.
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="successOkBtn">
          OK
        </button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#employeeTable').DataTable({
        pageLength: 10,
        order: [[0, 'desc']]
    });
});

// VIEW
function showViewEmployee(id) {
    $.post("", { action: "get", id: id }, function(data) {
        data = JSON.parse(data);

        $("#request_no").val(data.request_no);
        $("#employee_name").val(data.employee_name);
        $("#department").val(data.department);
        $("#position").val(data.position);
        $("#request_type").val(data.request_type);
        $("#status").val(data.status);

        new bootstrap.Modal(document.getElementById('viewModal')).show();
    });
}

// UPDATE
$("#updateForm").submit(function(e){
    e.preventDefault();

    $.post("", $(this).serialize() + "&action=update", function(){

        // CLOSE VIEW MODAL
        let viewModal = bootstrap.Modal.getInstance(document.getElementById('viewModal'));
        viewModal.hide();

        // UPDATE TABLE (NO RELOAD)
        updateRow($("#request_no").val(), $("#status").val());

        // SHOW SUCCESS MODAL
        let successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();

        $("#successOkBtn").off("click").on("click", function(){
            successModal.hide();
        });

    });
});

function updateRow(id, status){
    $("#employeeTable tbody tr").each(function(){
        let rowId = $(this).find("td:first").text().replace("Req","").trim();

        if (parseInt(rowId) == id){
            $(this).find("td:eq(6)").text(status);
        }
    });
}
</script>

</body>
</html>