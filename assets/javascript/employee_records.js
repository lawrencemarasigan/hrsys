$(function () {
    $('#employeeTable').DataTable({
        pageLength: 10
    });
});

function openViewWindow(id) {
    window.open(
        'view_employee.php?id=' + id,
        'viewEmployee',
        'width=700,height=700,scrollbars=yes,resizable=yes'
    );
}


function openAddEmployeeWindow() {
    window.open(
        'add_employee.php',
        'addEmployee',
        'width=1000,height=800,scrollbars=yes,resizable=yes'
    );
}
function printEmployee(id) {
    window.open("print_employee.php?id=" + id, "_blank", "width=800,height=600");
}

$(document).ready(function () {
    $('#employeeTable').DataTable();
});

function openAddEmployeeWindow() {
    window.open("add_employee.php", "Add Employee", "width=700,height=600");
}

function openViewWindow(id) {
    window.open("view_employee.php?id=" + id, "View Employee", "width=700,height=600");
}

function printSelected() {
    const selected = document.querySelector('input[name="selected_employee"]:checked');
    if (!selected) {
        alert("Please select an employee to print.");
        return;
    }
    window.open("print_employee.php?id=" + selected.value, "_blank");
}

