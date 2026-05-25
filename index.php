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
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            align-items:center;
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
        <h1>Fees Management System</h1>
        <h2>Login</h2>

        <form action="login.php" method="POST">

            <label>SELECT ROLE</label>
            <select name="role" required>
                <option value="">-- Select Role --</option>
                <option value="admin">Admin</option>
                <option value="student">Student</option>
            </select>

            <label>USERNAME</label>
            <input type="text" name="username" placeholder="Enter Username or Roll No" required>

            <label>PIN NO/PASSWORD</label>
            <input type="password" name="pinno" placeholder="Enter Pin no/password" required>

            <div style="text-align:center;margin-top:10px;">
            <button type="submit">Login</button>
            <button type="reset" >clear</button>
            </div>


            <div class="footer-text">
                © 2026 Fees Management System
            </div>
        </form>
    </div>

</body>
</html>