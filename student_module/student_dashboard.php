<?php 
include 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM student WHERE Id='$id'";
$result = mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>

<style>

body{
    font-family:Arial;
    background:#f2f2f2;
    margin:0;
}

/* Header */
.header{
    background:darkblue;
    color:white;
    padding:15px;
    text-align:center;
    font-size:22px;
    font-weight:bold;
}

/* Main box */
.student-card{
    width:650px;
    background:white;
    padding:25px;
    margin:50px auto;
    border-radius:12px;
    box-shadow:0px 0px 15px rgba(0,0,0,0.3);
}

/* Profile image */
.profile-pic{
    width:130px;
    height:130px;
    border-radius:50%;
    display:block;
    margin:auto;
    margin-bottom:20px;
    border:4px solid #007bff;
}

/* Heading */
.student-card h2{
    text-align:center;
    color:darkblue;
    margin-bottom:25px;
}

/* Student details */
.details{
    width:100%;
    border-collapse:collapse;
}

.details td{
    padding:12px;
    border:1px solid gray;
}

.label{
    background:lightblue;
    font-weight:bold;
    width:35%;
}

/* Logout button */
.logout-btn{
    width:100%;
    background-color:indigo;
    padding:12px;
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    font-weight:bold;
    margin-top:20px;
}

.logout-btn:hover{
    background:#0056b3;
}

.msg{
    text-align:center;
    color:red;
    font-weight:bold;
    margin-top:20px;
}

</style>

</head>

<body>

<div class="header">
GOVT POLYTECHNIC ANAKAPALLI
</div>

<?php

if(mysqli_num_rows($result)>0)
{
$row=mysqli_fetch_assoc($result);

echo "<div class='student-card'>";

echo "<img src='images/".$row['Photo']."' class='profile-pic'>";

echo "<h2>Student Details</h2>";

echo "<table class='details'>";

echo "<tr>
<td class='label'>Name</td>
<td>".$row['Name']."</td>
</tr>";

echo "<tr>
<td class='label'>Id</td>
<td>".$row['Id']."</td>
</tr>";

echo "<tr>
<td class='label'>Gender</td>
<td>".$row['Gender']."</td>
</tr>";

echo "<tr>
<td class='label'>Department</td>
<td>".$row['Department']."</td>
</tr>";

echo "<tr>
<td class='label'>Year</td>
<td>".$row['Year']."</td>
</tr>";

echo "<tr>
<td class='label'>Phone No</td>
<td>".$row['Phno']."</td>
</tr>";

echo "</table>";

echo "<br>";

echo "<a href='logout.php'>
<button class='logout-btn'>Logout</button>
</a>";

echo "</div>";
}
else
{
echo "<div class='msg'>No student found</div>";
}

?>

</body>
</html>