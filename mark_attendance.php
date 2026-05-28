<?php
session_start();

if (!isset($_SESSION["att_logged_in"])) {
    header("Location: attendance_login.php");
    exit();
}

include "db_connect.php";
?>

<!DOCTYPE html>
<html>

<head>

<title>Mark Attendance</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f2f5ff;
    min-height:100vh;
}

/* HEADER */

.header{
    background:#0d47c7;
    color:white;
    text-align:center;
    padding:20px;
    font-size:30px;
    font-weight:bold;
    letter-spacing:1px;
    box-shadow:0 2px 10px rgba(0,0,0,0.2);
}

/* MAIN CONTAINER */

.container{
    width:90%;
    margin:30px auto;
}

/* FILTER BOX */

.filter-box{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
    margin-bottom:30px;
}

.filter-box h2{
    text-align:center;
    color:#0d47c7;
    margin-bottom:25px;
}

/* FORM */

.form-group{
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
    color:#333;
}

select{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
    outline:none;
}

select:focus{
    border-color:#0d47c7;
}

/* BUTTON */

button{
    width:100%;
    padding:13px;
    border:none;
    border-radius:8px;
    background:#0d47c7;
    color:white;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#08389c;
}

/* STUDENT LIST */

#student_list{
    margin-top:25px;
}

/* TABLE DESIGN */

#student_list table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
}

#student_list th{
    background:#0d47c7;
    color:white;
    padding:15px;
    font-size:15px;
}

#student_list td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
    color:#333;
}

#student_list tr:hover{
    background:#f5f5f5;
}

/* RADIO BUTTONS */

input[type="radio"]{
    transform:scale(1.2);
    cursor:pointer;
}

/* RESPONSIVE */

@media(max-width:768px){

.header{
    font-size:22px;
}

.filter-box{
    padding:20px;
}

#student_list th,
#student_list td{
    font-size:13px;
    padding:10px;
}

}

</style>

</head>

<body>

<div class="header">
    ATTENDANCE MANAGEMENT SYSTEM
</div>

<div class="container">

    <!-- FILTER BOX -->

    <div class="filter-box">

        <h2>Mark Attendance</h2>

        <div class="form-group">

            <label>Select Branch</label>

            <select id="branch">
                <option value="">-- Select Branch --</option>
                <option value="CME">CME</option>
                <option value="ECE">ECE</option>
            </select>

        </div>

        <div class="form-group">

            <label>Select Year</label>

            <select id="year">
                <option value="">-- Select Year --</option>
                <option value="2024-2027">1st Year</option>
                <option value="2023-2026">2nd Year</option>
                <option value="2022-2025">3rd Year</option>
            </select>

        </div>

        <button onclick="loadStudents()">
            Load Students
        </button>

    </div>

    <!-- STUDENT TABLE -->

    <div id="student_list"></div>

</div>

<script>

function loadStudents()
{
    var branch=document.getElementById("branch").value;
    var year=document.getElementById("year").value;

    if(branch=="" || year=="")
    {
        alert("Please select Branch and Year!");
        return;
    }

    var xhr=new XMLHttpRequest();

    xhr.open(
        "GET",
        "get_students.php?branch=" + branch + "&year=" + year,
        true
    );

    xhr.onload=function ()
    {
        document.getElementById("student_list").innerHTML=this.responseText;
    };

    xhr.send();
}

</script>

</body>
</html>