<?php
session_start();

if(!isset($_SESSION["teacher_logged_in"]))
{
    header("Location: teacher_login.php");
    exit();
}

include "db.php";

/* FETCH TEACHER DETAILS */

$teacher_id=$_SESSION["teacher_id"];

$result=mysqli_query($con,
"SELECT * FROM teachers
 WHERE teacher_id='$teacher_id'");

$teacher=mysqli_fetch_assoc($result);

/* FETCH ATTENDANCE */

$attendance=mysqli_query($con,
"SELECT * FROM teacher_attendance
 WHERE teacher_id='$teacher_id'
 ORDER BY date DESC");

/* FETCH SUBJECTS */

$subjects=mysqli_query($con,
"SELECT * FROM subjects
 WHERE teacher_id='$teacher_id'");
?>

<!DOCTYPE html>
<html>

<head>

<title>Teacher Dashboard</title>

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
    padding:20px;
    text-align:center;
    font-size:30px;
    font-weight:bold;
    box-shadow:0 2px 10px rgba(0,0,0,0.2);
}

/* MAIN CONTAINER */

.container{
    width:90%;
    margin:30px auto;
}

/* WELCOME */

.welcome{
    text-align:center;
    margin-bottom:30px;
}

.welcome h2{
    color:#0d47c7;
    font-size:32px;
}

.welcome p{
    color:#666;
    margin-top:8px;
    font-size:15px;
}

/* PROFILE CARD */

.profile-card{
    background:white;
    border-radius:15px;
    padding:30px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
    margin-bottom:35px;
}

.profile-card h3{
    color:#0d47c7;
    margin-bottom:20px;
    font-size:24px;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:18px;
}

.info-box{
    background:#f8f9ff;
    padding:18px;
    border-radius:12px;
    border-left:5px solid #0d47c7;
}

.info-box strong{
    color:#0d47c7;
    display:block;
    margin-bottom:5px;
}

/* TABLE BOX */

.table-box{
    background:white;
    border-radius:15px;
    padding:20px;
    margin-bottom:35px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
    overflow-x:auto;
}

.table-box h3{
    color:#0d47c7;
    margin-bottom:20px;
    font-size:24px;
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
    color:#333;
}

tr:hover{
    background:#f5f5f5;
}

/* STATUS */

.present{
    color:#16a34a;
    font-weight:bold;
}

.absent{
    color:red;
    font-weight:bold;
}

/* LOGOUT BUTTON */

.logout-box{
    text-align:center;
}

button{
    padding:13px 35px;
    background:red;
    color:white;
    border:none;
    border-radius:10px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#cc0000;
    transform:scale(1.03);
}

/* RESPONSIVE */

@media(max-width:768px){

.header{
    font-size:22px;
}

.welcome h2{
    font-size:24px;
}

.table-box h3,
.profile-card h3{
    font-size:20px;
}

th,td{
    font-size:13px;
    padding:10px;
}

}

</style>

</head>

<body>

<!-- HEADER -->

<div class="header">
    TEACHER DASHBOARD
</div>

<div class="container">

    <!-- WELCOME -->

    <div class="welcome">

        <h2>
            Welcome,
            <?php echo $_SESSION["teacher_name"]; ?> !
        </h2>

        <p>
            Manage your profile, subjects and attendance
        </p>

    </div>

    <!-- PROFILE DETAILS -->

    <div class="profile-card">

        <h3>Teacher Information</h3>

        <div class="info-grid">

            <div class="info-box">
                <strong>Teacher ID</strong>
                <?php echo $teacher["teacher_id"]; ?>
            </div>

            <div class="info-box">
                <strong>Name</strong>
                <?php echo $teacher["name"]; ?>
            </div>

            <div class="info-box">
                <strong>Department</strong>
                <?php echo $teacher["dept"]; ?>
            </div>

            <div class="info-box">
                <strong>Qualification</strong>
                <?php echo $teacher["qualification"]; ?>
            </div>

            <div class="info-box">
                <strong>Phone Number</strong>
                <?php echo $teacher["phone"]; ?>
            </div>

            <div class="info-box">
                <strong>Email Address</strong>
                <?php echo $teacher["email"]; ?>
            </div>

        </div>

    </div>

    <!-- SUBJECTS -->

    <div class="table-box">

        <h3>My Subjects</h3>

        <table>

            <tr>
                <th>S.No</th>
                <th>Subject</th>
                <th>Semester</th>
                <th>Department</th>
            </tr>

            <?php
            $sno=1;

            while($row=mysqli_fetch_assoc($subjects))
            {
            ?>

            <tr>

                <td><?php echo $sno; ?></td>

                <td><?php echo $row["subject_name"]; ?></td>

                <td><?php echo $row["year"]; ?></td>

                <td><?php echo $row["dept"]; ?></td>

            </tr>

            <?php
            $sno++;
            }
            ?>

        </table>

    </div>

    <!-- ATTENDANCE -->

    <div class="table-box">

        <h3>My Attendance</h3>

        <table>

            <tr>
                <th>S.No</th>
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

                <td><?php echo $row["date"]; ?></td>

                <td class="<?php echo strtolower($row["status"]); ?>">

                    <?php echo $row["status"]; ?>

                </td>

            </tr>

            <?php
            $sno++;
            }
            ?>

        </table>

    </div>

    <!-- LOGOUT -->

    <div class="logout-box">

        <form method="POST"
              action="teacher_logout.php">

            <button type="submit">
                Logout
            </button>

        </form>

    </div>

</div>

</body>
</html>