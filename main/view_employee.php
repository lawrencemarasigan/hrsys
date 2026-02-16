<?php
$conn = new mysqli("localhost", "root", "", "hrsys_db");
if ($conn->connect_error) { die("DB Error"); }

$id = (int)$_GET['id'];
$success = false;

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $sss = $_POST['sss'];
    $tin = $_POST['tin'];
    $pagibig = $_POST['pagibig'];

    $stmt = $conn->prepare("UPDATE employees SET name=?, department=?, position=?, sss=?, tin=?, pagibig=? WHERE id=?");
    $stmt->bind_param("ssssssi",$name,$department,$position,$sss,$tin,$pagibig,$id);
    $stmt->execute();

    $success = true;
}

$res = $conn->query("SELECT * FROM employees WHERE id=$id");
$emp = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Employee Details</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script>
function enableEdit(){
    document.querySelectorAll(".edit").forEach(e => e.removeAttribute("readonly"));
    document.getElementById("saveBtn").style.display="inline-block";
}
</script>
</head>

<body class="p-3 bg-light">

<h5>Employee Details</h5>

<?php if($success): ?>
<div class="alert alert-success alert-dismissible fade show">
    ✅ Employee details updated successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<form method="POST">

<table class="table table-bordered">
<tr><th>Name</th><td><input class="form-control edit" name="name" readonly value="<?= htmlspecialchars($emp['name']) ?>"></td></tr>
<tr><th>Department</th><td><input class="form-control edit" name="department" readonly value="<?= htmlspecialchars($emp['department']) ?>"></td></tr>
<tr><th>Position</th><td><input class="form-control edit" name="position" readonly value="<?= htmlspecialchars($emp['position']) ?>"></td></tr>
<tr><th>SSS</th><td><input class="form-control edit" name="sss" readonly value="<?= htmlspecialchars($emp['sss']) ?>"></td></tr>
<tr><th>TIN</th><td><input class="form-control edit" name="tin" readonly value="<?= htmlspecialchars($emp['tin']) ?>"></td></tr>
<tr><th>Pag-IBIG</th><td><input class="form-control edit" name="pagibig" readonly value="<?= htmlspecialchars($emp['pagibig']) ?>"></td></tr>
</table>

<div class="text-end">
    <button type="button" onclick="enableEdit()" class="btn btn-warning">Edit</button>
    <button type="submit" name="update" id="saveBtn" class="btn btn-success" style="display:none;">Save</button>
    <button type="button" onclick="window.close()" class="btn btn-secondary">Close</button>
</div>

</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
setTimeout(() => {
  document.querySelector('.alert')?.remove();
}, 3000);
</script>
</body>
</html>
