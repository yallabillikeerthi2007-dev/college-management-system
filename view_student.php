<?php
include("db.php");

$id = $_GET['id'];

$query = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Student</title>
    <style>
        body{
            font-family: Arial;
            background:#f2f2f2;
        }

        .box{
            width:50%;
            margin:50px auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0px 0px 10px gray;
        }

        h2{
            text-align:center;
            color:#004aad;
        }

        p{
            font-size:16px;
            padding:8px;
            border-bottom:1px solid #ddd;
        }

        .btns{
            text-align:center;
            margin-top:20px;
        }

        .btns a button{
            padding:10px 20px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-size:15px;
            margin:5px;
        }

        .back-btn{
            background:#004aad;
            color:white;
        }

        .print-btn{
            background:green;
            color:white;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Student Details</h2>

    <p><b>Pin No:</b> <?php echo $row['pin_no']; ?></p>
    <p><b>Name:</b> <?php echo $row['name']; ?></p>
    <p><b>Branch:</b> <?php echo $row['branch']; ?></p>
    <p><b>Year:</b> <?php echo $row['year']; ?></p>
    <p><b>Phone:</b> <?php echo $row['phone']; ?></p>
    <p><b>Total Fee:</b> <?php echo $row['total_fee']; ?></p>
    <p><b>Due Fee:</b> <?php echo $row['due_fee']; ?></p>
    <p><b>Due Date:</b> <?php echo $row['due_date']; ?></p>
    <p><b>Balance Fee:</b> <?php echo $row['balance_fee']; ?></p>

    <div class="btns">
        <a href="admin_dashboard.php">
            <button class="back-btn">⬅ Back</button>
        </a>

        <a href="print_receipt.php?id=<?php echo $row['id']; ?>">
            <button class="print-btn">🖨 Print Receipt</button>
        </a>
    </div>
</div>

</body>
</html>