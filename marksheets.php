<?php

session_start();

/* LOGIN CHECK */

if(!isset($_SESSION['admin']))
{
    header("Location: login1.php");
    exit();
}

/* DATABASE CONNECTION */

$conn = new mysqli("localhost", "root", "", "college_management");

if($conn->connect_error)
{
    die("Connection Failed : " . $conn->connect_error);
}

/* RESET ALL DATA */

if(isset($_POST['clear']))
{
    $conn->query("TRUNCATE TABLE results");
}

/* ADD RESULT */

if(isset($_POST['add']))
{
    $name = $_POST['name'];
    $pin  = $_POST['pin'];

    $sub1 = $_POST['sub1'];
    $sub2 = $_POST['sub2'];
    $sub3 = $_POST['sub3'];
    $sub4 = $_POST['sub4'];
    $sub5 = $_POST['sub5'];

    $total = $sub1 + $sub2 + $sub3 + $sub4 + $sub5;

    $percentage = $total / 5;

    /* GRADE */

    if($percentage >= 90)
    {
        $grade = "A+";
    }
    elseif($percentage >= 75)
    {
        $grade = "A";
    }
    elseif($percentage >= 60)
    {
        $grade = "B";
    }
    elseif($percentage >= 40)
    {
        $grade = "C";
    }
    else
    {
        $grade = "Fail";
    }

    /* RESULT */

    if($percentage >= 35)
    {
        $result = "Pass";
    }
    else
    {
        $result = "Fail";
    }

    /* INSERT */

    $sql = "INSERT INTO results
    (student_name, pin, sub1, sub2, sub3, sub4, sub5, total, percentage, grade, result)

    VALUES

    ('$name','$pin','$sub1','$sub2','$sub3','$sub4','$sub5','$total','$percentage','$grade','$result')";

    if($conn->query($sql) == TRUE)
    {
        echo "";
    }
    else
    {
        echo "Error : " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Student Result System</title>

<style>

<style>

body{
    margin:0;
    padding:30px;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg,#0d47a1,#42a5f5);
}

.container{
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0px 5px 20px rgba(0,0,0,0.3);
}

h1{
    text-align:center;
    font-size:50px;
    color:#1565c0;
    margin-bottom:25px;
    font-weight:bold;
}

.top-button{
    text-align:right;
    margin-bottom:20px;
}

form{
    text-align:center;
    margin-bottom:40px;
}

input{
    padding:15px;
    margin:8px;
    font-size:17px;
    border:2px solid #90caf9;
    border-radius:8px;
    outline:none;
    transition:0.3s;
}

input:focus{
    border-color:#1565c0;
    box-shadow:0px 0px 8px rgba(21,101,192,0.4);
}

.name-box{
    width:250px;
}

.pin-box{
    width:220px;
}

.mark-box{
    width:120px;
}

.add-btn{
    background:linear-gradient(to right,#2e7d32,#43a047);
    color:white;
    border:none;
    padding:15px 35px;
    font-size:18px;
    border-radius:8px;
    cursor:pointer;
    margin-top:15px;
    transition:0.3s;
    font-weight:bold;
}

.add-btn:hover{
    transform:scale(1.03);
}

.reset-btn{
    background:linear-gradient(to right,#c62828,#e53935);
    color:white;
    border:none;
    padding:15px 35px;
    font-size:18px;
    border-radius:8px;
    cursor:pointer;
    margin-top:15px;
    transition:0.3s;
    font-weight:bold;
}

.reset-btn:hover{
    transform:scale(1.03);
}

/* STUDENT STYLE YELLOW LOGOUT */

.logout-btn{
    background:linear-gradient(to right,#f9a825,#fdd835);
    color:black;
    padding:12px 25px;
    font-size:16px;
    font-weight:bold;
    border-radius:8px;
    text-decoration:none;
    display:inline-block;
    transition:0.3s;
    box-shadow:0px 4px 10px rgba(0,0,0,0.2);
}

.logout-btn:hover{
    background:linear-gradient(to right,#f57f17,#fbc02d);
    transform:scale(1.05);
}

/* TABLE DESIGN SAME AS STUDENT PAGE */

table{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:12px;
    background:white;
}

th{
    background:linear-gradient(to right,#1565c0,#1e88e5);
    color:white;
    padding:16px;
    font-size:17px;
}

td{
    padding:15px;
    text-align:center;
    border:1px solid #ddd;
    background:#f9fbff;
    font-size:16px;
}

tr:nth-child(even) td{
    background:#eef5ff;
}

tr:hover td{
    background:#dbeeff;
}

.pass{
    color:green;
    font-weight:bold;
}

.fail{
    color:red;
    font-weight:bold;
}

</style>
   

   
  
</style>

</head>

<body>

<div class="container">

<h1>Student Result System</h1>

<div class="top-button">

<a href="logout1.php" class="logout-btn">
Logout
</a>

</div>

<form method="POST">

<input type="text"
       name="name"
       class="name-box"
       placeholder="Student Name"
       required>

<input type="text"
       name="pin"
       class="pin-box"
       placeholder="Student PIN"
       required>

<br>

<input type="number"
       name="sub1"
       class="mark-box"
       placeholder="CM-101"
       required>

<input type="number"
       name="sub2"
       class="mark-box"
       placeholder="CM-102"
       required>

<input type="number"
       name="sub3"
       class="mark-box"
       placeholder="CM-103"
       required>

<input type="number"
       name="sub4"
       class="mark-box"
       placeholder="CM-104"
       required>

<input type="number"
       name="sub5"
       class="mark-box"
       placeholder="CM-105"
       required>

<br>

<button type="submit"
        name="add"
        class="add-btn">
        Add Result
</button>

<button type="submit"
        name="clear"
        class="reset-btn">
        Reset
</button>

</form>

<table>

<tr>
    <th>Name</th>
    <th>PIN</th>
    <th>CM-101</th>
    <th>CM-102</th>
    <th>CM-103</th>
    <th>CM-104</th>
    <th>CM-105</th>
    <th>Total</th>
    <th>Percentage</th>
    <th>Result</th>
    <th>Grade</th>
</tr>

<?php

$data = $conn->query("SELECT * FROM results");

while($row = $data->fetch_assoc())
{

?>

<tr>

<td><?php echo $row['student_name']; ?></td>

<td><?php echo $row['pin']; ?></td>

<td><?php echo $row['sub1']; ?></td>

<td><?php echo $row['sub2']; ?></td>

<td><?php echo $row['sub3']; ?></td>

<td><?php echo $row['sub4']; ?></td>

<td><?php echo $row['sub5']; ?></td>

<td><?php echo $row['total']; ?></td>

<td><?php echo round($row['percentage'],1); ?>%</td>

<td class="<?php echo strtolower($row['result']); ?>">
<?php echo $row['result']; ?>
</td>

<td><?php echo $row['grade']; ?></td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>