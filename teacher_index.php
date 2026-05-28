<?php
error_reporting(0);
include "db_connect.php";
?>

<!DOCTYPE html>
<html>

<head>

<title>Teacher Module</title>

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
    padding:25px;
    text-align:center;
    box-shadow:0 2px 10px rgba(0,0,0,0.2);
}

.header h1{
    font-size:38px;
    margin-bottom:10px;
}

.header p{
    font-size:17px;
    color:#dbe4ff;
}

/* MAIN CONTAINER */

.container{
    width:90%;
    margin:50px auto;
}

/* CARD GRID */

.card-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
}

/* CARD */

.card{
    background:white;
    border-radius:18px;
    padding:35px 25px;
    text-align:center;
    text-decoration:none;
    color:#333;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
    transition:0.3s;
    position:relative;
    overflow:hidden;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

/* ICON */

.icon{
    width:80px;
    height:80px;
    border-radius:50%;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:35px;
    color:white;
    margin-bottom:20px;
}

/* DIFFERENT COLORS */

.teacher-icon{
    background:#0d47c7;
}

.attendance-icon{
    background:#16a34a;
}

.subject-icon{
    background:#f59e0b;
}

.login-icon{
    background:#dc2626;
}

/* CARD TITLE */

.card h2{
    font-size:24px;
    margin-bottom:10px;
}

/* CARD TEXT */

.card p{
    color:#666;
    font-size:15px;
    line-height:22px;
}

/* FOOTER */

.footer{
    text-align:center;
    margin-top:50px;
    color:#666;
    font-size:14px;
}

/* RESPONSIVE */

@media(max-width:768px){

.header h1{
    font-size:28px;
}

.card{
    padding:30px 20px;
}

.card h2{
    font-size:20px;
}

}

</style>

</head>

<body>

<!-- HEADER -->

<div class="header">

    <h1>Teacher Module</h1>

    <p>
        College Management System
    </p>

</div>

<!-- MAIN CONTENT -->

<div class="container">

    <div class="card-grid">

        <!-- MANAGE TEACHERS -->

        <a href="add_teacher.php" class="card">

            <div class="icon teacher-icon">
                👨‍🏫
            </div>

            <h2>Manage Teachers</h2>

            <p>
                Add, edit and manage teacher details easily.
            </p>

        </a>

        <!-- ATTENDANCE -->

        <a href="mark_teacher_attendance.php" class="card">

            <div class="icon attendance-icon">
                📅
            </div>

            <h2>Attendance</h2>

            <p>
                Mark and manage teacher attendance records.
            </p>

        </a>

        <!-- SUBJECTS -->

        <a href="assign_subject.php" class="card">

            <div class="icon subject-icon">
                📘
            </div>

            <h2>Subjects</h2>

            <p>
                Assign subjects to teachers and semesters.
            </p>

        </a>

        <!-- LOGIN -->

        <a href="teacher_login.php" class="card">

            <div class="icon login-icon">
                🔐
            </div>

            <h2>Teacher Login</h2>

            <p>
                Login to teacher dashboard and access details.
            </p>

        </a>

    </div>

    <!-- FOOTER -->

    <div class="footer">

        Govt Polytechnic College Management Portal

    </div>

</div>

</body>
</html>