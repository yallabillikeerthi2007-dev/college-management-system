<?php

include 'db.php';

$id = $_POST['id'];

$sql = "SELECT * FROM student WHERE Id='$id'";

$result = mysqli_query($con,$sql);

$row = mysqli_fetch_assoc($result);

?>

<html>

<head>

<title>Update Student</title>

<style>

body
{
margin:0;
font-family:Arial,sans-serif;
background:#f2f2f2;
}

/* Header */

.header
{
background:#004aad;
color:white;
padding:15px;
text-align:center;
font-size:24px;
font-weight:bold;
}

/* Box */

.box
{
width:50%;
margin:40px auto;
background:white;
padding:20px;
border-radius:12px;
box-shadow:0px 0px 10px rgba(0,0,0,0.2);
}

h2
{
text-align:center;
color:#004aad;
}

/* Inputs */

input
{
width:95%;
padding:10px;
margin:8px 0;
border:1px solid #ccc;
border-radius:8px;
}

/* Button */

button
{
width:100%;
padding:12px;
background:orange;
border:none;
color:white;
font-size:16px;
border-radius:8px;
cursor:pointer;
font-weight:bold;
}

button:hover
{
background:darkorange;
}

.back
{
text-align:center;
margin-top:15px;
}

.back a
{
text-decoration:none;
color:#004aad;
font-weight:bold;
}

</style>

</head>

<body>

<div class="header">

GOVT POLYTECHNIC ANAKAPALLI

</div>

<div class="box">

<h2>Update Student Details</h2>

<form method="POST"
action="updation.php">

Id:<br>

<input type="text"
name="id"
value="<?php echo $row['Id']; ?>">

<br>

Name:<br>

<input type="text"
name="stname"
value="<?php echo $row['Name']; ?>">

<br>

Gender:<br>

<input type="text"
name="gender"
value="<?php echo $row['Gender']; ?>">

<br>

Department:<br>

<input type="text"
name="dept"
value="<?php echo $row['Department']; ?>">

<br>

Year:<br>

<input type="text"
name="y"
value="<?php echo $row['Year']; ?>">

<br>

Phone:<br>

<input type="text"
name="phno"
value="<?php echo $row['Phno']; ?>">

<br><br>

<button type="submit">

Save Update

</button>

</form>

<div class="back">

<a href="admin_dashboard.php">

← Back to Dashboard

</a>

</div>

</div>

</body>

</html>