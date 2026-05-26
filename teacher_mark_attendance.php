<?php
include "db_connect.php";

$attendance = mysqli_query($conn,
"SELECT * FROM teacher_attendance
 ORDER BY date DESC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Teacher Attendance</title>

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

/* CONTAINER */

.container{
    width:90%;
    margin:30px auto;
}

/* FORM BOX */

.form-box{
    width:450px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
}

.form-box h2{
    text-align:center;
    color:#0d47c7;
    margin-bottom:25px;
}

/* FORM GROUP */

.form-group{
    margin-bottom:18px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
    color:#333;
}

input,select{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
    outline:none;
}

input:focus,
select:focus{
    border-color:#0d47c7;
    box-shadow:0 0 8px rgba(13,71,199,0.2);
}

/* BUTTON */

button{
    width:100%;
    padding:13px;
    background:#16a34a;
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#15803d;
}

/* TEACHER LIST */

#teacher_list{
    margin-top:30px;
}

/* TABLE BOX */

.table-box{
    margin-top:40px;
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
    overflow-x:auto;
}

.table-box h2{
    color:#0d47c7;
    margin-bottom:20px;
}

/* TABLE */

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#0d47c7;
    color:white;
    padding:14px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f5f5f5;
}

/* STATUS COLORS */

.present{
    color:#16a34a;
    font-weight:bold;
}

.absent{
    color:red;
    font-weight:bold;
}

/* BACK BUTTON */

.back-btn{
    display:inline-block;
    margin-top:25px;
    background:#0d47c7;
    color:white;
    padding:12px 25px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}

.back-btn:hover{
    background:#08389c;
}

/* RESPONSIVE */

@media(max-width:768px){

.form-box{
    width:100%;
}

.header{
    font-size:22px;
}

th,td{
    font-size:13px;
    padding:10px;
}

}

</style>

</head>

<body>

<div class="header">
    TEACHER ATTENDANCE SYSTEM
</div>

<div class="container">

    <!-- MARK ATTENDANCE -->

    <div class="form-box">

        <h2>Mark Teacher Attendance</h2>

        <div class="form-group">

            <label>Select Department</label>

            <select id="dept">

                <option value="">
                    -- Select Department --
                </option>

                <option value="CME">CME</option>

                <option value="ECE">ECE</option>

            </select>

        </div>

        <div class="form-group">

            <label>Select Date</label>

            <input type="date"
                   id="date"
                   required>

        </div>

        <button onclick="loadTeachers()">
            Load Teachers
        </button>

    </div>

    <!-- DYNAMIC TEACHER LIST -->

    <div id="teacher_list"></div>

    <!-- ATTENDANCE RECORDS -->

    <div class="table-box">

        <h2>Attendance Records</h2>

        <table>

            <tr>
                <th>S.No</th>
                <th>Teacher ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Date</th>
                <th>Status</th>
            </tr>

            <?php

            $sno=1;

            while($row=mysqli_fetch_assoc($attendance))
            {
            ?>

            <tr>

                <td><?php echo $sno; ?></td>

                <td><?php echo $row['teacher_id']; ?></td>

                <td><?php echo $row['teacher_name']; ?></td>

                <td><?php echo $row['dept']; ?></td>

                <td><?php echo $row['date']; ?></td>

                <td class="<?php echo strtolower($row['status']); ?>">

                    <?php echo $row['status']; ?>

                </td>

            </tr>

            <?php
            $sno++;
            }
            ?>

        </table>

    </div>

    <!-- BACK BUTTON -->

    <center>

        <a href="index.php" class="back-btn">
            Back to Home
        </a>

    </center>

</div>

<!-- JAVASCRIPT -->

<script>

function loadTeachers()
{
    var dept=document.getElementById("dept").value;

    var date=document.getElementById("date").value;

    if(dept=="" || date=="")
    {
        alert("Please select Department and Date!");
        return;
    }

    var xhr=new XMLHttpRequest();

    xhr.open(
        "GET",
        "get_teachers_by_dept.php?dept=" + dept,
        true
    );

    xhr.onload=function()
    {
        document.getElementById("teacher_list").innerHTML=
        this.responseText;

        document.getElementById("date_val").value=date;
    };

    xhr.send();
}

</script>

</body>
</html>