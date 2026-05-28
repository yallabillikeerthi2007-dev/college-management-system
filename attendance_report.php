<?php
error_reporting(0);
include "db_connect.php";
?>

<!DOCTYPE html>
<html>

<head>

<title>Attendance Report</title>

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

/* MAIN BOX */

.container{
    width:90%;
    margin:30px auto;
}

/* FILTER FORM */

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

.form-group{
    margin-bottom:20px;
}

label{
    font-weight:bold;
    display:block;
    margin-bottom:8px;
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
    background:#0d47c7;
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#08389c;
}

/* TABLE */

.table-box{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#0d47c7;
    color:white;
    padding:14px;
    font-size:15px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f5f5f5;
}

/* STATUS */

.low{
    color:red;
    font-weight:bold;
}

.ok{
    color:green;
    font-weight:bold;
}

/* RESPONSIVE */

@media(max-width:768px){

.header{
    font-size:22px;
}

.filter-box{
    padding:20px;
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
    ATTENDANCE REPORT SYSTEM
</div>

<div class="container">

    <!-- FILTER FORM -->

    <div class="filter-box">

        <h2>View Attendance Report</h2>

        <form method="GET">

            <div class="form-group">

                <label>Select Branch</label>

                <select name="branch" required>
                    <option value="">-- Select Branch --</option>
                    <option value="CME">CME</option>
                    <option value="ECE">ECE</option>
                </select>

            </div>

            <div class="form-group">

                <label>Select Year</label>

                <select name="year" required>
                    <option value="">-- Select Year --</option>
                    <option value="2024-2027">1st Year</option>
                    <option value="2023-2026">2nd Year</option>
                    <option value="2022-2025">3rd Year</option>
                </select>

            </div>

            <button type="submit">
                View Report
            </button>

        </form>

    </div>

    <!-- REPORT TABLE -->

    <?php

    if(isset($_GET["branch"]) && $_GET["branch"]!="")
    {

        $branch=$_GET["branch"];
        $year=$_GET["year"];

        $students=mysqli_query($conn,
        "SELECT * FROM students 
         WHERE dept='$branch' 
         AND year='$year'");

    ?>

    <div class="table-box">

        <table>

            <tr>
                <th>Student Name</th>
                <th>Present Days</th>
                <th>Total Days</th>
                <th>Percentage</th>
                <th>Status</th>
            </tr>

            <?php

            while($stu=mysqli_fetch_assoc($students))
            {

                $sid=$stu["id"];

                $total=mysqli_num_rows(
                mysqli_query($conn,
                "SELECT * FROM attendance 
                 WHERE student_id='$sid'")
                );

                $present=mysqli_num_rows(
                mysqli_query($conn,
                "SELECT * FROM attendance 
                 WHERE student_id='$sid' 
                 AND status='Present'")
                );

                $percentage=($total>0)
                ? round(($present/$total)*100,2)
                : 0;

                if($percentage<=75)
                {
                    $alert="<span class='low'>
                            LOW ATTENDANCE
                            </span>";
                }
                else
                {
                    $alert="<span class='ok'>
                            GOOD
                            </span>";
                }

            ?>

            <tr>

                <td><?php echo $stu["name"]; ?></td>

                <td><?php echo $present; ?></td>

                <td><?php echo $total; ?></td>

                <td><?php echo $percentage; ?>%</td>

                <td><?php echo $alert; ?></td>

            </tr>

            <?php
            }
            ?>

        </table>

    </div>

    <?php
    }
    ?>

</div>

</body>
</html>