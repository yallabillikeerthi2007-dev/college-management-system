<?php
error_reporting(0);
include "db_connect.php";

if(isset($_POST["add"])){
$name=$_POST["name"];
$id=$_POST["id"];
$dept=$_POST["dept"];
$year=$_POST["year"];
$phno=$_POST["phno"];

$insert="INSERT INTO students (name,id,dept,year,phno) VALUES ('$name','$id','$dept','$year','$phno')";
mysqli_query($conn,$insert);

$sync="INSERT INTO attendance (student_id,student_name,dept,year,date,status) 
VALUES ('$id','$name','$dept','$year',CURDATE(),'Absent')";
mysqli_query($conn,$sync);

echo "<script>alert('Student added successfully!')</script>";
}

$students=mysqli_query($conn,"SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Students</title>

<style>

body{
    margin:0;
    padding:0;
    font-family:Arial, sans-serif;
    background:#f2f5ff;
}

/* HEADER */

.header{
    background:#0d47c7;
    color:white;
    padding:20px;
    text-align:center;
    font-size:28px;
    font-weight:bold;
    letter-spacing:1px;
    box-shadow:0 2px 8px rgba(0,0,0,0.2);
}

/* MAIN CONTAINER */

.container{
    width:90%;
    margin:30px auto;
}

/* FORM CARD */

.form-box{
    width:420px;
    background:white;
    margin:auto;
    padding:30px;
    border-radius:12px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
}

.form-box h2{
    text-align:center;
    margin-bottom:25px;
    color:#0d47c7;
}

label{
    font-weight:bold;
    display:block;
    margin-top:12px;
    margin-bottom:6px;
}

input,select{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:6px;
    outline:none;
    font-size:15px;
}

input:focus,select:focus{
    border-color:#0d47c7;
}

/* BUTTONS */

.btn{
    width:100%;
    padding:12px;
    border:none;
    border-radius:6px;
    margin-top:20px;
    font-size:16px;
    cursor:pointer;
    font-weight:bold;
}

.add-btn{
    background:#16a34a;
    color:white;
}

.add-btn:hover{
    background:#15803d;
}

/* TABLE */

.table-box{
    margin-top:40px;
    background:white;
    padding:20px;
    border-radius:12px;
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

table th{
    background:#0d47c7;
    color:white;
    padding:14px;
}

table td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

table tr:hover{
    background:#f5f5f5;
}

/* DELETE BUTTON */

.delete-btn{
    background:red;
    color:white;
    padding:8px 14px;
    text-decoration:none;
    border-radius:5px;
    font-size:14px;
}

.delete-btn:hover{
    background:darkred;
}

/* MOBILE */

@media(max-width:600px){

.form-box{
    width:90%;
    padding:20px;
}

.header{
    font-size:22px;
}

}

</style>
</head>

<body>

<div class="header">
    GOVT POLYTECHNIC ANAKAPALLI
</div>

<div class="container">

    <!-- ADD STUDENT FORM -->

    <div class="form-box">

        <h2>ADD STUDENT DETAILS</h2>

        <form method="POST">

            <label>Student Name</label>
            <input type="text" name="name" placeholder="Enter Student Name" required>

            <label>Student ID</label>
            <input type="text" name="id" placeholder="Enter Student ID" required>

            <label>Department</label>
            <select name="dept">
                <option value="">-- Select Department --</option>
                <option value="CME">CME</option>
                <option value="ECE">ECE</option>
            </select>

            <label>Year</label>
            <select name="year">
                <option value="">-- Select Year --</option>
                <option value="2024-2027">1st Year</option>
                <option value="2023-2026">2nd Year</option>
                <option value="2022-2025">3rd Year</option>
            </select>

            <label>Phone Number</label>
            <input type="text" name="phno" placeholder="Enter Phone Number">

            <button type="submit" name="add" class="btn add-btn">
                Add Student
            </button>

        </form>
    </div>

    <!-- STUDENT TABLE -->

    <div class="table-box">

        <h2>Student List</h2>

        <table>

            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>ID</th>
                <th>Department</th>
                <th>Year</th>
                <th>Phone</th>
                <th>Delete</th>
            </tr>

            <?php
            $sno=1;

            while($row=mysqli_fetch_assoc($students)){ ?>

            <tr>

                <td><?php echo $sno; ?></td>

                <td><?php echo $row["name"]; ?></td>

                <td><?php echo $row["id"]; ?></td>

                <td><?php echo $row["dept"]; ?></td>

                <td><?php echo $row["year"]; ?></td>

                <td><?php echo $row["phno"]; ?></td>

                <td>
                    <a class="delete-btn"
                    href="delete_student.php?id=<?php echo $row['sno']; ?>"
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

</div>

</body>
</html>