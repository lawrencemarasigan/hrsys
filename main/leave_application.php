<?php
require_once "authorization.php";
$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* =================== AJAX ================== */
if (isset($_POST['action'])) {

    if ($_POST['action'] == "get") {
        $id = $_POST['id'];

        $stmt = $conn->prepare("SELECT * FROM leave_application WHERE leave_app_no=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        echo json_encode($result->fetch_assoc());
        exit;
    }

    if ($_POST['action'] == "update") {
        $id = $_POST['leave_app_no'];
        $status = $_POST['status'];

        $stmt = $conn->prepare("UPDATE leave_application SET status=? WHERE leave_app_no=?");
        $stmt->bind_param("si", $status, $id);

        echo $stmt->execute() ? "success" : "error";
        exit;
    }
}

$sql = "SELECT leave_app_no, employee_id, employee_name, department, position, type_of_leave, status FROM leave_application";
$result = $conn->query($sql);

function active($page) {
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employee Records</title>

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
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
}

.sidebar-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    margin-bottom: 10px;
}

.sidebar-logo img {
    width: 45px;
    height: 45px;
}

.logo-title {
    font-size: 18px;
    font-weight: bold;
    color: #2c5cc5;
}

.logo-sub {
    font-size: 12px;
    color: #666;
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
</style>
</head>

<body>
<div class="overlay">
<div class="wrapper">

<!------------------------ SIDEBAR ------------------------------------>
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
    <h3 class="fw-bold text-dark">Leave Application</h3>
    <button class="btn btn-warning fw-semibold" onclick="window.print()">Print Leave</button>
</div>

<table id="employeeTable" class="table table-bordered table-striped">
<thead class="table-primary">
<tr>
    <th>Leave App. No.</th>
    <th>Employee ID</th>
    <th>Employee Name</th>
    <th>Department</th>
    <th>Position</th>
    <th>Type of Leave</th>
    <th>Status</th>
    <th width="120">Action</th>
</tr>
</thead>

<tbody>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= "LN" . str_pad($row['leave_app_no'], 3, "0", STR_PAD_LEFT); ?></td>
    <td><?= htmlspecialchars($row['employee_id']) ?></td>
    <td><?= htmlspecialchars($row['employee_name']) ?></td>
    <td><?= htmlspecialchars($row['department']) ?></td>
    <td><?= htmlspecialchars($row['position']) ?></td>
    <td><?= htmlspecialchars($row['type_of_leave']) ?></td>
    <td><?= htmlspecialchars($row['status']) ?></td>
    <td>
        <button class="btn btn-sm btn-view"
        onclick="showViewEmployee('<?= $row['leave_app_no'] ?>')">
        View
        </button>
        <button class="btn btn-sm btn-print">Print</button>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<!------------------ VIEW MODAL ------------------->
<div class="modal fade" id="viewModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Leave Details</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form id="updateForm">
<div class="modal-body">

<input type="hidden" name="leave_app_no" id="leave_app_no">

<label>Employee Name</label>
<input type="text" id="employee_name" class="form-control mb-2" readonly>

<label>Department</label>
<input type="text" id="department" class="form-control mb-2" readonly>

<label>Position</label>
<input type="text" id="position" class="form-control mb-2" readonly>

<label>Type of Leave</label>
<input type="text" id="type_of_leave" class="form-control mb-2" readonly>

<label>Status</label>
<select name="status" id="status" class="form-control">
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Rejected">Rejected</option>
</select>

</div>

<div class="modal-footer">
<button type="submit" class="btn btn-primary">Update Status</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</form>

</div>
</div>
</div>

<!------------------- SUCCESS MODAL ------------------------->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Update Successful</h5>
      </div>

      <div class="modal-body">
        Status has been updated successfully.
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
        pageLength: 10
    });
});

// view function
function showViewEmployee(id) {
    $.ajax({
        url: "",
        method: "POST",
        data: { action: "get", id: id },
        dataType: "json",
        success: function(data) {

            $("#leave_app_no").val(data.leave_app_no);
            $("#employee_name").val(data.employee_name);
            $("#department").val(data.department);
            $("#position").val(data.position);
            $("#type_of_leave").val(data.type_of_leave);
            $("#status").val(data.status);

            new bootstrap.Modal(document.getElementById('viewModal')).show();
        }
    });
}

function updateRow(id, status){
    $("#employeeTable tbody tr").each(function(){

        let rowText = $(this).find("td:first").text().trim();
        let rowId = parseInt(rowText.replace("LN",""));

        if (rowId === parseInt(id)){
            $(this).find("td:eq(6)").text(status);
        }
    });
}

$("#updateForm").submit(function(e){
    e.preventDefault();

    $.ajax({
        url: "",
        method: "POST",
        data: $(this).serialize() + "&action=update",
        success: function(){

            let id = $("#leave_app_no").val();
            let status = $("#status").val();

            updateRow(id, status);

            let viewModalEl = document.getElementById('viewModal');
            let viewModal = bootstrap.Modal.getInstance(viewModalEl);
            viewModal.hide();

            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            $("#successOkBtn").off("click").on("click", function(){
                let successModalEl = document.getElementById('successModal');
                let successModal = bootstrap.Modal.getInstance(successModalEl);
                successModal.hide();
            });
        }
    });
});
</script>

</body>
</html>