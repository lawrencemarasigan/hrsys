document.addEventListener("DOMContentLoaded", function () {

    if (document.getElementById("employeeTable")) {
        $('#employeeTable').DataTable();
    }
});

function showAddEmployeeForm()
{
    const panel = document.getElementById("addEmployeePanel");
    if(panel)
    {
        panel.style.display = "flex";
    }
}

function hideAddEmployeeForm()
{
    const panel = document.getElementById("addEmployeePanel");
    if(panel)
    {
        panel.style.display = "none";
    }
}
