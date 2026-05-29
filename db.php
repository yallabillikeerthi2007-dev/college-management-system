<?php
 //connecting to the database
    $con=mysqli_connect("127.0.0.1:3307","root","","college_management");
    if(!$con)
        {
            die("connection failed". mysqli_connect_error());
        }
       ?>