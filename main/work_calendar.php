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
<title>Work Calendar</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

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

.content{
    margin-left:280px;
    padding:40px;
    width:100%;
}

.page-header{
    background:white;
    padding:20px 25px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    margin-bottom:25px;
}

.page-header h3{
    margin:0;
    font-weight:600;
}

.calendar-card{
    background:white;
    border-radius:14px;
    padding:20px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
}

.fc-daygrid-day:hover{
    background:#f3f7ff;
    cursor:pointer;
}

.fc-event{
    border:none;
    padding:3px;
    border-radius:6px;
    transition:.2s;
}

.fc-event:hover{
    transform:scale(1.05);
}

.modal-content{
    border-radius:12px;
}

.modal-header{
    background:#0d6efd;
    color:white;
    border-top-left-radius:12px;
    border-top-right-radius:12px;
}

.btn-primary{
    border-radius:8px;
    padding:8px 18px;
}
</style>
</head>

<body>
<div class="overlay">
<div class="wrapper">

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
        <div class="page-header">
        <h3>📅 Work Calendar</h3>
    </div>

        <div class="calendar-card">
        <div id="calendar"></div>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="eventModal">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
    <h5>Add Event</h5>
</div>

<div class="modal-body">
<form id="eventForm">
    <input type="text" name="title" class="form-control mb-3" placeholder="Event Title" required>
        <input type="date" name="date" class="form-control mb-3" required>
        <textarea name="description" class="form-control" placeholder="Description"></textarea>
    </form>
</div>

<div class="modal-footer">
<button class="btn btn-primary" onclick="saveEvent()">Save Event</button>
</div>

        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
initialView: 'dayGridMonth',
headerToolbar: {
left: 'prev,next today',
center: 'title',
right: 'dayGridMonth,timeGridWeek'
},
events: 'fetch_events.php',
dateClick: function(info) {
document.querySelector("input[name=date]").value = info.dateStr;
new bootstrap.Modal(document.getElementById('eventModal')).show();
}
});
calendar.render();
});
function saveEvent(){
var formData = new FormData(document.getElementById("eventForm"));
fetch("save_event.php",{
method:"POST",
body:formData
})
.then(res=>res.text())
.then(data=>{
location.reload();
});
}
</script>

</body>
</html>