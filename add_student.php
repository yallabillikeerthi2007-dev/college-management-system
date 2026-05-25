<?php
include("db.php");

if(isset($_POST['submit']))
{
    $pin_no = $_POST['pin_no'];
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $year = $_POST['year'];
    $phone = $_POST['phone'];
    $total_fee = $_POST['total_fee'];
    $due_fee = $_POST['due_fee'];
    $due_date = $_POST['due_date'];
    $balance_fee = $_POST['balance_fee'];

    $query = "INSERT INTO students(pin_no, name, branch, year, phone, total_fee, due_fee, due_date, balance_fee)
              VALUES('$pin_no','$name','$branch','$year','$phone','$total_fee','$due_fee','$due_date','$balance_fee')";

    if(mysqli_query($con,$query))
    {
        echo "<script>alert('Student Added Successfully'); window.location='admin_dashboard.php';</script>";
    }
    else
    {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>

    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
            background:#f2f2f2;
        }

        .header{
            background:#004aad;
            color:white;
            padding:15px;
            text-align:center;
            font-size:25px;
            font-weight:bold;
        }

        .box{
            width:45%;
            margin:30px auto;
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0px 0px 10px rgba(0,0,0,0.2);
        }

        label{
            font-weight:bold;
            display:block;
            margin-top:10px;
        }

        input, select{
            width:95%;
            padding:10px;
            margin-top:5px;
            border:1px solid #ccc;
            border-radius:8px;
        }

        button{
            width:100%;
            padding:12px;
            margin-top:20px;
            background:green;
            border:none;
            color:white;
            font-size:16px;
            border-radius:10px;
            cursor:pointer;
        }

        button:hover{
            background:darkgreen;
        }

        .back{
            text-align:center;
            margin-top:15px;
        }

        .back a{
            text-decoration:none;
            color:#004aad;
            font-weight:bold;
        }
    </style>
</head>

<body>

<div class="header">
    ADD STUDENT DETAILS
</div>

<div class="box">
    <form method="POST">

        <label>Pin No</label>
        <input type="text" name="pin_no" required>

        <label>Student Name</label>
        <input type="text" name="name" required>

        <label>Branch</label>
        <select name="branch" required>
            <option value="">--Select Branch--</option>
            <option value="CME">CME</option>
            <option value="ECE">ECE</option>
            <option value="EEE">EEE</option>
            <option value="CIVIL">CIVIL</option>
            <option value="MECH">MECH</option>
        </select>

        <label>Year</label>
        <select name="year" required>
            <option value="">--Select Year--</option>
            <option value="1st">1st Year</option>
            <option value="2nd">2nd Year</option>
            <option value="3rd">3rd Year</option>
        </select>

        <label>Phone Number</label>
        <input type="text" name="phone" required>

        <label>Total Fee</label>
        <input type="number" name="total_fee" required>

        <label>Due Fee</label>
        <input type="number" name="due_fee" required>

        <label>Due Date</label>
        <input type="date" name="due_date" required>

        <label>Balance Fee</label>
        <input type="number" name="balance_fee" required>

        <button type="submit" name="submit">Add Student</button>

        <div class="back">
            <a href="admin_dashboard.php">⬅ Back to Dashboard</a>
        </div>

    </form>
</div>

</body>
</html>