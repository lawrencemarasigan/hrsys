<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Oath of Office Editor</title>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
}

.container{
    display:flex;
    height:100vh;
}

.pdf-viewer{
    flex:2;
    border-right:1px solid #ccc;
}

.edit-panel{
    flex:1;
    padding:20px;
    background:#f4f6f9;
    overflow:auto;
}

h3{
    margin-top:0;
}

label{
    font-weight:bold;
}

input{
    width:100%;
    padding:8px;
    margin:5px 0 15px 0;
}

select{
    width:100%;
    padding:8px;
    margin:5px 0 15px 0;
}

button{
    padding:10px 15px;
    background:#0b5ed7;
    color:white;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#084298;
}
</style>
</head>
<body>

<div class="container">

    <!-- LEFT SIDE: SAN NIC PDF -->
    <div class="pdf-viewer">
        <iframe src="/assets/forms/oath.pdf" width="100%" height="100%"></iframe>
    </div>

    <!-- RIGHT SIDE: EDIT PANEL -->
    <div class="edit-panel">
        <h3>Edit Form Details</h3>

        <form method="POST" action="../print/oathform_print.php" target="_blank">

    <label>Name of Appointee</label>
    <input type="text" name="appointee" required>

    <label>Address</label>
    <input type="text" name="address" required>

    <label>Position Title</label>
    <input type="text" name="position" required>

    <label>Appointee</label>
    <input type="text" name="appointeesig" required>

    <label>Government ID</label>
        <select name="governmentid" required>
            <option value="">Select Government ID</option>
            <option value="PhilSys ID">PhilSys ID</option>
            <option value="SSS ID">SSS ID</option>
            <option value="GSIS ID">GSIS ID</option>
            <option value="TIN ID">TIN ID</option>
            <option value="PhilHealth ID">PhilHealth ID</option>
            <option value="Pag-IBIG ID">Pag-IBIG ID</option>
            <option value="Driver's License">Driver's License</option>
            <option value="Passport">Passport</option>
            <option value="Postal ID">Postal ID</option>
            <option value="Voter's ID">Voter's ID</option>
        </select>

    <label>ID Number</label>
    <input type="text" name="idnumber" required>

    <label>Date</label>
    <input type="date" name="date" required>

    <label>Day</label>
    <input type="text" name="day" required>

    <label>Month</label>
    <input type="text" name="month" required>

    <button type="submit">Generate & Print</button>

        </form>
    </div>
</div>

</body>
</html>
