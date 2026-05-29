<?php
include("db.php");

$id = $_GET['id'];

$query = "SELECT * FROM studs WHERE id='$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fees Receipt</title>

    <style>
        body{
            font-family: Arial;
            background:white;
        }

        .receipt{
            width:70%;
            margin:30px auto;
            border:2px solid black;
            padding:20px;
        }

        .head{
            text-align:center;
            border-bottom:2px solid black;
            padding-bottom:10px;
        }

        .head h1{
            margin:0;
            font-size:22px;
        }

        .head p{
            margin:3px;
            font-size:14px;
        }

        .title{
            text-align:center;
            font-size:18px;
            font-weight:bold;
            margin:15px 0;
            text-decoration:underline;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        }

        td{
            padding:10px;
            border:1px solid black;
            font-size:15px;
        }

        .btns{
            text-align:center;
            margin-top:20px;
        }

        button{
            padding:10px 20px;
            background:green;
            border:none;
            color:white;
            border-radius:8px;
            cursor:pointer;
            font-size:15px;
        }

        @media print {
            .btns{
                display:none;
            }
        }
    </style>
</head>

<body>

<div class="receipt">

    <div class="head">
        <h1>GOVT POLYTECHNIC ANAKAPALLI</h1>
        <p>College Code: AKP24173</p>
        <p>Email: govtpolytechnicakp@gmail.com</p>
    </div>

    <div class="title">FEES RECEIPT</div>

    <table>
        <tr>
            <td><b>Pin No</b></td>
            <td><?php echo $row['pin_no']; ?></td>
        </tr>

        <tr>
            <td><b>Name</b></td>
            <td><?php echo $row['name']; ?></td>
        </tr>

        <tr>
            <td><b>Branch</b></td>
            <td><?php echo $row['branch']; ?></td>
        </tr>

        <tr>
            <td><b>Year</b></td>
            <td><?php echo $row['year']; ?></td>
        </tr>

        <tr>
            <td><b>Phone</b></td>
            <td><?php echo $row['phone']; ?></td>
        </tr>

        <tr>
            <td><b>Total Fee</b></td>
            <td>₹<?php echo $row['total_fee']; ?></td>
        </tr>

        <tr>
            <td><b>Balance Fee</b></td>
            <td>₹<?php echo $row['balance_fee']; ?></td>
        </tr>

        <tr>
            <td><b>Balance Fee</b></td>
            <td>₹<?php echo $row['balance_fee']; ?></td>
        </tr>

        <tr>
            <td><b>Due Date</b></td>
            <td><?php echo $row['due_date']; ?></td>
        </tr>

        <tr>
            <td><b>Receipt Date</b></td>
            <td><?php echo date("d-m-Y"); ?></td>
        </tr>
    </table>

    <br><br>
    <p><b>Authorized Signature:</b> ______________________</p>

    <div class="btns">
        <button onclick="window.print()">🖨 Print Now</button>
    </div>

</div>

</body>
</html>