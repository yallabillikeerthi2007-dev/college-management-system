<?php
include "db_connect.php";
error_reporting(0);
$branch=$_POST["branch"];
$year=$_POST["year"];
$date=$_POST["date"];
$status=$_POST["status"];

foreach($status as $student_id =>$att_status)
{
$name_query="SELECT * FROM students WHERE student_id='$student_id'";
$name_result=mysqli_query($conn,$name_query);
$name_row=mysqli_fetch_assoc($name_result);
$student_name=$name_row["name"];
$check="SELECT * FROM attendance WHERE student_id='student_id'";
$check_result=mysqli_query($conn,$check);
if(mysqli_num_rows($check_result)==0)
{
$insert="INSERT INTO attendance(student_id,student_name,dept,year,date,status) VALUES ('$student_id','$student_name','$branch','$year','$date','$att_status')";

mysqli_query($conn,$insert);
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Attendance Saved</title>
<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(to right,#4facfe,#00f2fe);
}

.box{
    width:400px;
    background:white;
    padding:40px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    animation:fadeIn 1s ease;
}

h2{
    color:#16a34a;
    font-size:32px;
    margin-bottom:20px;
}

a{
    display:inline-block;
    margin:10px;
    padding:13px 30px;
    border-radius:10px;
    font-size:16px;
    font-weight:bold;
    color:white;
    text-decoration:none;
    transition:0.3s;
}

.mark-btn{
    background:#0d47c7;
}

.mark-btn:hover{
    background:#08389c;
    transform:scale(1.02);
}

.report-btn{
    background:#16a34a;
}

.report-btn:hover{
    background:#15803d;
    transform:scale(1.02);
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(-20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

</style>
</head>
<body>

<div class="box">
    <h2>Attendance Saved Successfully!</h2>
    <a href="mark_attendance.php" class="mark-btn">Mark Again</a>
    <a href="attendance_report.php" class="report-btn">View Report</a>
</div>

</body>
</html>