<?php
include("db.php");

$id = $_GET['id'];

$query = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
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

    $updateQuery = "UPDATE students SET 
        pin_no='$pin_no',
        name='$name',
        branch='$branch',
        year='$year',
        phone='$phone',
        total_fee='$total_fee',
        due_fee='$due_fee',
        due_date='$due_date',
        balance_fee='$balance_fee'
        WHERE id='$id'";

    if(mysqli_query($con, $updateQuery))
    {
        echo "<script>alert('Updated Successfully'); window.location='admin_dashboard.php';</script>";
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
    <title>Update Student</title>
    <style>
        body{
            font-family: Arial;
            background:#f2f2f2;
        }

        .box{
            width:50%;
            margin:40px auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0px 0px 10px gray;
        }

        h2{
            text-align:center;
            color:#004aad;
        }

        input{
            width:95%;
            padding:10px;
            margin:8px 0;
            border:1px solid #ccc;
            border-radius:6px;
        }

        button{
            width:100%;
            padding:12px;
            background:orange;
            border:none;
            color:white;
            font-size:16px;
            border-radius:8px;
            cursor:pointer;
        }

        button:hover{
            background:darkorange;
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

<div class="box">
    <h2>Update Student Details</h2>

    <form method="POST">
        <input type="text" name="pin_no" value="<?php echo $row['pin_no']; ?>" required>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
        <input type="text" name="branch" value="<?php echo $row['branch']; ?>" required>
        <input type="text" name="year" value="<?php echo $row['year']; ?>" required>
        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>
        <input type="number" name="total_fee" value="<?php echo $row['total_fee']; ?>" required>
        <input type="number" name="due_fee" value="<?php echo $row['due_fee']; ?>" required>
        <input type="date" name="due_date" value="<?php echo $row['due_date']; ?>" required>
        <input type="number" name="balance_fee" value="<?php echo $row['balance_fee']; ?>" required>

        <button type="submit" name="update">Update Student</button>
          <div class="back">
            <a href="admin_dashboard.php">⬅ Back to Dashboard</a>
        </div>

    </form>
</div>

</body>
</html>