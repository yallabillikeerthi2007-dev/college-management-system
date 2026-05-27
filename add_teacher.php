<?php
error_reporting(0);
include "db_connect.php";

if(isset($_POST["add"]))
{
    $teacher_id=$_POST["teacher_id"];
    $name=$_POST["name"];
    $dept=$_POST["dept"];
    $qualification=$_POST["qualification"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];

    $insert="INSERT INTO teachers
    (teacher_id,name,dept,qualification,phone,email)

    VALUES
    ('$teacher_id',
    '$name',
    '$dept',
    '$qualification',
    '$phone',
    '$email')";

    mysqli_query($conn,$insert);

    echo "<script>alert('Teacher Added Successfully')</script>";
}

$teachers=mysqli_query($conn,"SELECT * FROM teachers");
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

/* INPUTS */

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

/* TABLE STYLE */

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

/* ACTION BUTTONS */

.edit-btn{
    background:#f59e0b;
    color:white;
    padding:7px 14px;
    border-radius:6px;
    text-decoration:none;
    font-size:14px;
    margin-right:5px;
}

.edit-btn:hover{
    background:#d97706;
}

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
    TEACHER MANAGEMENT SYSTEM
</div>

<div class="container">

    <!-- ADD TEACHER FORM -->

    <div class="form-box">

        <h2>Add Teacher</h2>

        <form method="POST">

            <div class="form-group">

                <label>Teacher ID</label>

                <input type="text"
                       name="teacher_id"
                       placeholder="Enter Teacher ID"
                       required>

            </div>

            <div class="form-group">

                <label>Teacher Name</label>

                <input type="text"
                       name="name"
                       placeholder="Enter Teacher Name"
                       required>

            </div>

            <div class="form-group">

                <label>Department</label>

                <select name="dept">

                    <option value="">-- Select Department --</option>

                    <option value="CME">CME</option>

                    <option value="ECE">ECE</option>

                </select>

            </div>

            <div class="form-group">

                <label>Qualification</label>

                <input type="text"
                       name="qualification"
                       placeholder="Enter Qualification">

            </div>

            <div class="form-group">

                <label>Phone Number</label>

                <input type="text"
                       name="phone"
                       placeholder="Enter Phone Number">

            </div>

            <div class="form-group">

                <label>Email Address</label>

                <input type="email"
                       name="email"
                       placeholder="Enter Email Address">

            </div>

            <button type="submit" name="add">
                Add Teacher
            </button>

        </form>

    </div>

    <!-- TEACHER LIST -->

    <div class="table-box">

        <h2>Teacher List</h2>

        <table>

            <tr>
                <th>S.No</th>
                <th>Teacher ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Qualification</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

            <?php

            $sno=1;

            while($row=mysqli_fetch_assoc($teachers))
            {
            ?>

            <tr>

                <td><?php echo $sno; ?></td>

                <td><?php echo $row["teacher_id"]; ?></td>

                <td><?php echo $row["name"]; ?></td>

                <td><?php echo $row["dept"]; ?></td>

                <td><?php echo $row["qualification"]; ?></td>

                <td><?php echo $row["phone"]; ?></td>

                <td><?php echo $row["email"]; ?></td>

                <td>

                    <a href="edit_teacher.php?id=<?php echo $row['id']; ?>"
                       class="edit-btn">
                       Edit
                    </a>

                    <a href="delete_teacher.php?id=<?php echo $row['id']; ?>"
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

</body>
</html>