<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CS Form 13 Editor</title>

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
        <iframe src="../../assets/forms/csform.pdf" width="100%" height="100%"></iframe>
    </div>

    <!-- RIGHT SIDE: EDIT PANEL -->
    <div class="edit-panel">
        <h3>Edit Form Details</h3>

        <form method="POST" action="../print/csform_print.php" target="_blank">

    <label>Date of Assumption</label>
    <input type="date" name="assumption" required>

    <label>Appropriation Ordinance No.</label>
    <input type="text" name="ordinance" required>

    <label>Series Year</label>
    <input type="text" name="year" required>

    <label>Mayor Signature Date</label>
    <input type="date" name="mayorDate" required>

    <label>Accountant Signature Date</label>
    <input type="date" name="acctDate" required>

    <button type="submit">Generate & Print</button>

        </form>
    </div>
</div>

</body>
</html>
