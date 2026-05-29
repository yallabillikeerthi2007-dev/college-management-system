<?php
error_reporting(0);
include "db.php";

if(isset($_POST["assign"]))
{
    $teacher_id=$_POST["teacher_id"];
    $teacher_name=$_POST["teacher_name"];
    $dept=$_POST["dept"];
    $year=$_POST["year"];
    $subject_name=$_POST["subject_name"];

    $insert="INSERT INTO subjects
    (teacher_id,teacher_name,dept,year,subject_name)

    VALUES
    ('$teacher_id',
    '$teacher_name',
    '$dept',
    '$year',
    '$subject_name')";

    mysqli_query($con,$insert);

    echo "<script>alert('Subject Assigned Successfully')</script>";
}

$teachers=mysqli_query($con,"SELECT * FROM teachers");
$subjects=mysqli_query($con,"SELECT * FROM subjects");
?>

<!DOCTYPE html>
<html>

<head>

<title>Assign Subjects</title>

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

/* TABLE */

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

/* DELETE BUTTON */

.delete-btn{
    background:red;
    color:white;
    padding:7px 14px;
    border-radius:6px;
    text-decoration:none;
    font-size:14px;
}

.delete-btn:hover{
    background:darkred;
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
    SUBJECT ASSIGNMENT SYSTEM
</div>

<div class="container">

    <!-- ASSIGN SUBJECT FORM -->

    <div class="form-box">

        <h2>Assign Subject</h2>

        <form method="POST">

            <div class="form-group">

                <label>Select Teacher</label>

                <select name="teacher_id"
                        id="teacher_select"
                        onchange="fillTeacher()"
                        required>

                    <option value="">
                        -- Select Teacher --
                    </option>

                    <?php
                    while($t=mysqli_fetch_assoc($teachers))
                    {
                    ?>

                    <option
                    value="<?php echo $t['teacher_id']; ?>"

                    data-name="<?php echo $t['name']; ?>"

                    data-dept="<?php echo $t['dept']; ?>">

                    <?php echo $t['name']; ?>

                    </option>

                    <?php
                    }
                    ?>

                </select>

            </div>

            <!-- HIDDEN INPUTS -->

            <input type="hidden"
                   name="teacher_name"
                   id="teacher_name">

            <input type="hidden"
                   name="dept"
                   id="dept">

            <div class="form-group">

                <label>Select Semester</label>

                <select name="year">

                    <option value="sem1">
                        1st Year
                    </option>

                    <option value="sem3">
                        2nd Year - 3rd Sem
                    </option>

                    <option value="sem4">
                        2nd Year - 4th Sem
                    </option>

                    <option value="sem5">
                        3rd Year - 5th Sem
                    </option>

                    <option value="sem6">
                        3rd Year - 6th Sem
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>Subject Name</label>

                <input type="text"
                       name="subject_name"
                       placeholder="Enter Subject Name"
                       required>

            </div>

            <button type="submit" name="assign">
                Assign Subject
            </button>

        </form>

    </div>

    <!-- SUBJECT LIST -->

    <div class="table-box">

        <h2>Assigned Subjects</h2>

        <table>

            <tr>
                <th>S.No</th>
                <th>Teacher</th>
                <th>Department</th>
                <th>Semester</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>

            <?php

            $sno=1;

            while($row=mysqli_fetch_assoc($subjects))
            {
            ?>

            <tr>

                <td><?php echo $sno; ?></td>

                <td><?php echo $row["teacher_name"]; ?></td>

                <td><?php echo $row["dept"]; ?></td>

                <td><?php echo $row["year"]; ?></td>

                <td><?php echo $row["subject_name"]; ?></td>

                <td>

                    <a href="delete_subject.php?id=<?php echo $row['id']; ?>"
                       class="delete-btn"
                       onclick="return confirm('Are you sure?')">

                       Delete

                    </a>

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

        <a href="teacher_index.php" class="back-btn">
            Back to Home
        </a>

    </center>

</div>

<!-- JAVASCRIPT -->

<script>

function fillTeacher()
{
    var select=document.getElementById("teacher_select");

    var option=select.options[select.selectedIndex];

    document.getElementById("teacher_name").value=
    option.getAttribute("data-name");

    document.getElementById("dept").value=
    option.getAttribute("data-dept");
}

</script>

</body>
</html>