<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add New Employee</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-3">
<h4 class="text-center mb-3">Add New Employee</h4>

<form action="save_employee.php" method="POST">

<div class="row">
    <div class="col-md-4 mb-2">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="col-md-4 mb-2">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="col-md-4 mb-2">
        <label>Middle Name</label>
        <input type="text" name="middle_name" class="form-control">
    </div>
</div>

<div class="mb-2">
    <label>Address</label>
    <input type="text" name="address" class="form-control">
</div>

<div class="row">
    <div class="col-md-6 mb-2">
        <label>Civil Status</label>
        <input type="text" name="civil_status" class="form-control">
    </div>
    <div class="col-md-6 mb-2">
        <label>Blood Type</label>
        <input type="text" name="blood_type" class="form-control">
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-2">
        <label>PhilHealth No.</label>
        <input type="text" name="philhealth" class="form-control">
    </div>
    <div class="col-md-4 mb-2">
        <label>SSS No.</label>
        <input type="text" name="sss" class="form-control">
    </div>
    <div class="col-md-4 mb-2">
        <label>GSIS No.</label>
        <input type="text" name="gsis" class="form-control">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-2">
        <label>Pag-IBIG No.</label>
        <input type="text" name="pagibig" class="form-control">
    </div>
    <div class="col-md-6 mb-2">
        <label>TIN No.</label>
        <input type="text" name="tin" class="form-control">
    </div>
</div>

<div class="mb-2">
    <label>Department</label>
    <input type="text" name="department" class="form-control">
</div>

<div class="mb-2">
    <label>Position</label>
    <input type="text" name="position" class="form-control">
</div>

<div class="mb-2">
    <label>Employee Status</label>
    <input type="text" name="employee_status" class="form-control">
</div>

<div class="mb-2">
    <label>Salary Grade</label>
    <input type="text" name="salary_grade" class="form-control">
</div>

<div class="mb-2">
    <label>Date Hired</label>
    <input type="date" name="hired_at" class="form-control">
</div>

<div class="row">
    <div class="col-md-6 mb-2">
        <label>Date of Appointment</label>
        <input type="date" name="appointment_date" class="form-control">
    </div>
    <div class="col-md-6 mb-2">
        <label>Has Appointment Ended?</label>
        <select name="appointment_ended" class="form-control">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-2">
        <label>Role</label>
        <input type="text" name="role" class="form-control">
    </div>
    <div class="col-md-4 mb-2">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="col-md-4 mb-2">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>
</div>

<div class="text-end mt-3">
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" onclick="window.close()" class="btn btn-secondary">Close</button>
</div>

</form>
</div>
</body>
</html>
