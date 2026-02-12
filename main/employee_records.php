<?php
// employee_records.php
$conn = new mysqli("localhost", "root", "", "hrsys_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, department, position, hired_at FROM employees";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// helper for active sidebar
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
        body { background: #e9f6ff; }

        .sidebar {
            width: 260px;
            background: #ffffff;
            padding: 20px 12px;
            min-height: 100vh;
            position: fixed;
            box-shadow: 2px 0 8px rgba(0,0,0,0.05);
        }

        .content {
            margin-left: 280px;
            padding: 30px;
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
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            background: #eef4ff;
        }

        .menu-item.active {
            background: #0d6efd;
            color: #ffffff;
        }

        .menu-item .icon {
            font-size: 18px;
        }

        .menu-item.active .icon {
            filter: brightness(0) invert(1);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="dashboard.php" class="menu-item <?= active('dashboard.php') ?>">
        <span class="icon">📊</span>
        <span>Dashboard</span>
    </a>

    <a href="employee_records.php" class="menu-item <?= active('employee_records.php') ?>">
        <span class="icon">👥</span>
        <span>Employee Records</span>
    </a>

    <a href="form201.php" class="menu-item <?= active('form201.php') ?>">
        <span class="icon">🗂️</span>
        <span>Form 201</span>
    </a>

    <a href="requests.php" class="menu-item <?= active('requests.php') ?>">
        <span class="icon">📝</span>
        <span>Requests</span>
    </a>

    <a href="leave_application.php" class="menu-item <?= active('leave_application.php') ?>">
        <span class="icon">📎</span>
        <span>Leave Application</span>
    </a>

    <a href="performance.php" class="menu-item <?= active('performance.php') ?>">
        <span class="icon">📈</span>
        <span>Employee Performance</span>
    </a>

    <a href="work_calendar.php" class="menu-item <?= active('work_calendar.php') ?>">
        <span class="icon">📅</span>
        <span>Work Calendar</span>
    </a>
</div>

<div class="content">
    <div class="d-flex justify-content-between mb-3">
        <h3>EMPLOYEE RECORDS</h3>
        <div>
            <a href="add_record.php" class="btn btn-primary">Add Employee</a>
            <button onclick="window.print()" class="btn btn-secondary">Print</button>
        </div>
    </div>

    <table id="employeeTable" class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Position</th>
                <th>Hired</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['department']) ?></td>
                        <td><?= htmlspecialchars($row['position']) ?></td>
                        <td><?= date("m-d-Y", strtotime($row['hired_at'])) ?></td>
                        <td>
                            <a href="view_record.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">View</a>
                            <a href="print_record.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-secondary">Print</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#employeeTable').DataTable({
            pageLength: 15
        });
    });
</script>

</body>
</html>
