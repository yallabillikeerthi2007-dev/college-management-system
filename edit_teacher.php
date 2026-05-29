<?php
error_reporting(0);
include "db.php";

/* UPDATE TEACHER */

if(isset($_POST["update"]))
{
    $id=$_POST["id"];
    $teacher_id=$_POST["teacher_id"];
    $name=$_POST["name"];
    $dept=$_POST["dept"];
    $qualification=$_POST["qualification"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];

    $update="UPDATE teachers SET
    teacher_id='$teacher_id',
    name='$name',
    dept='$dept',
    qualification='$qualification',
    phone='$phone',
    email='$email'

    WHERE id='$id'";

    mysqli_query($con,$update);

    echo "<script>
    alert('Teacher Updated Successfully');
    window.location='add_teacher.php';
    </script>";
}

/* FETCH DATA */

$id=$_GET["id"];

$result=mysqli_query($conn,
"SELECT * FROM teachers WHERE id='$id'");

$row=mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Teacher</title>

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
    margin:40px auto;
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

/* BACK BUTTON */

.back-btn{
    display:inline-block;
    margin-top:20px;
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

}

</style>

</head>

<body>

<div class="header">
    EDIT TEACHER DETAILS
</div>

<div class="container">

    <div class="form-box">

        <h2>Update Teacher</h2>

        <form method="POST">

            <!-- HIDDEN ID -->

            <input type="hidden"
                   name="id"
                   value="<?php echo $row['id']; ?>">

            <!-- TEACHER ID -->

            <div class="form-group">

                <label>Teacher ID</label>

                <input type="text"
                       name="teacher_id"
                       value="<?php echo $row['teacher_id']; ?>"
                       required>

            </div>

            <!-- NAME -->

            <div class="form-group">

                <label>Teacher Name</label>

                <input type="text"
                       name="name"
                       value="<?php echo $row['name']; ?>"
                       required>

            </div>

            <!-- DEPARTMENT -->

            <div class="form-group">

                <label>Department</label>

                <select name="dept">

                    <option value="CME"
                    <?php
                    if($row['dept']=='CME')
                    echo 'selected';
                    ?>>

                    CME

                    </option>

                    <option value="ECE"
                    <?php
                    if($row['dept']=='ECE')
                    echo 'selected';
                    ?>>

                    ECE

                    </option>

                </select>

            </div>

            <!-- QUALIFICATION -->

            <div class="form-group">

                <label>Qualification</label>

                <input type="text"
                       name="qualification"
                       value="<?php echo $row['qualification']; ?>">

            </div>

            <!-- PHONE -->

            <div class="form-group">

                <label>Phone Number</label>

                <input type="text"
                       name="phone"
                       value="<?php echo $row['phone']; ?>">

            </div>

            <!-- EMAIL -->

            <div class="form-group">

                <label>Email Address</label>

                <input type="email"
                       name="email"
                       value="<?php echo $row['email']; ?>">

            </div>

            <!-- UPDATE BUTTON -->

            <button type="submit" name="update">
                Update Teacher
            </button>

        </form>

        <!-- BACK BUTTON -->

        <center>

            <a href="add_teacher.php"
               class="back-btn">

               Back to Teacher List

            </a>

        </center>

    </div>

</div>

</body>
</html>