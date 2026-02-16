$(document).ready(function () {
    $('#employeeTable').DataTable();
});

let currentEmployeeId = null;


function showViewEmployee(id)
{
    currentEmployeeId = id;

    $.ajax({
        url: 'get_employee.php',
        method: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function(data)
        {
            if(data)
            {
                $("#view_name").val(data.name);
                $("#view_department").val(data.department);
                $("#view_position").val(data.position);
                $("#view_civil_status").val(data.civil_status);
                $("#view_philhealth").val(data.philhealth);
                $("#view_sss").val(data.sss);
                $("#view_gsis").val(data.gsis);
                $("#view_tin").val(data.tin);
                $("#view_pagibig").val(data.pagibig);

                $("#file_employee_id").val(data.id);

                $("#viewEmployeePanel").css("display", "flex");
            }
        }
    });
}


function showEditEmployee()
{
    if(currentEmployeeId == null)
    {
        alert("No employee selected");
        return;
    }

    $.ajax({
        url: "get_employee.php",
        type: "GET",
        data: { id: currentEmployeeId },
        dataType: "json",
        success: function(data)
        {
            console.log(data);

            $("#edit_id").val(data.id);

            $("#edit_name").val(data.name);
            $("#edit_department").val(data.department);
            $("#edit_position").val(data.position);
            $("#edit_civil_status").val(data.civil_status);
            $("#edit_philhealth").val(data.philhealth);
            $("#edit_sss").val(data.sss);
            $("#edit_gsis").val(data.gsis);
            $("#edit_tin").val(data.tin);
            $("#edit_pagibig").val(data.pagibig);

            $("#editEmployeePanel").css("display", "flex");
        }
    });
}


function updateEmployee()
{
    var id = $("#edit_id").val();

    console.log("ID:", id);

    $.ajax({
        url: "edit_employee.php",
        type: "POST",
        data: {
            id: id,
            name: $("#edit_name").val(),
            department: $("#edit_department").val(),
            position: $("#edit_position").val(),
            civil_status: $("#edit_civil_status").val(),
            philhealth: $("#edit_philhealth").val(),
            sss: $("#edit_sss").val(),
            gsis: $("#edit_gsis").val(),
            tin: $("#edit_tin").val(),
            pagibig: $("#edit_pagibig").val()
        },
        success: function(response)
        {
            console.log(response);

            if(response.trim() == "success")
            {
                alert("Updated successfully");
                location.reload();
            }
            else
            {
                alert("Server says: " + response);
            }
        },
        error: function()
        {
            alert("Update failed");
        }
    });
}


function deleteEmployee()
{
    if(currentEmployeeId == null)
    {
        alert("No employee selected");
        return;
    }

    if(confirm("Are you sure you want to delete this employee?"))
    {
        window.location.href =
        "delete_employee.php?id=" + currentEmployeeId;
    }
}


function hideViewEmployee()
{
    $("#viewEmployeePanel").hide();
}


function showAddEmployeeForm()
{
    $("#addEmployeePanel").css("display", "flex");
}


function hideAddEmployeeForm()
{
    $("#addEmployeePanel").hide();
}


function showAddFilePanel()
{
    $("#addFilePanel").css("display", "flex");
}


function hideAddFilePanel()
{
    $("#addFilePanel").hide();
}


function hideEditEmployee()
{
    $("#editEmployeePanel").hide();
}
