<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ASSUMPTION Editor</title>

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
        <iframe src="../../assets/forms/assumption.pdf" width="100%" height="100%"></iframe>
    </div>

    <!-- RIGHT SIDE: EDIT PANEL -->
    <div class="edit-panel">
        <h3>Edit Form Details</h3>

        <form method="POST" action="../print/assumptionform_print.php" target="_blank">

    <label>Full Name</label>
    <input type="text" name="fullname" required>

    <label>Position Title</label>
    <input type="text" name="postitle1" required>

    <label>Office Name</label>
    <input type="text" name="officename" required>

    <label>Date of Assumption</label>
    <input type="date" name="assump" required>

    <label>Surname</label>
    <input type="text" name="surname" required>

    <label>Position Title</label>
    <input type="text" name="postitle2" required>

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
