<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fees Management Login</title>

    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box{
            width: 400px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.3);
        }

        .login-box h1{
            text-align: center;
            margin-bottom: 10px;
            color: darkblue;
        }

        .login-box h2{
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label{
            font-weight: bold;
            color: #444;
        }

        input, select{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        input:focus, select:focus{
            outline: none;
            border-color: #4facfe;
            box-shadow: 0px 0px 5px #4facfe;
        }

        button{
            width: 25%;
            padding: 8px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover{
            background: #0056b3;
        }

        .footer-text{
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: gray;
        }

    </style>
</head>

<body>

<div class="login-box">

    <h1>FEES MANAGEMENT SYSTEM</h1>
    <h2>College Login</h2>

    <form action="login.php" method="POST">

        <label>Select Role</label>
        <select name="role" id="role" onchange="showPinField()" required>
            <option value="">-- Select Role --</option>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
        </select>

        <label>Username</label>
        <input type="text" name="username" placeholder="Enter Username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter Password" required>

        <div id="pinField" style="display:none;">

         <label>PIN NO</label>

          <input type="text"
           name="pin"
           placeholder="Enter PIN No">
        </div>

        

        <div style="text-align:center; margin-top:10px; ">
            <button type="submit">Login</button> <button type="reset">Clear</button>
        </div>

        <div class="footer-text">
            © 2026 Fees Management System
        </div>

    </form>

</div>


<script>

function showPinField()
{
    var role = document.getElementById("role").value;

    var pinField = document.getElementById("pinField");

    if(role == "student")
    {
        pinField.style.display = "block";
    }
    else
    {
        pinField.style.display = "none";
    }
}

</script>

</script>

</script>

</body>
</html>