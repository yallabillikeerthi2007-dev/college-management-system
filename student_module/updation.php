<?php   
              include 'db.php';
        //updation
          $id   = $_POST['id'];
          $name  = $_POST['stname'];
          $gen   = $_POST['gender'];
          $dep   = $_POST['dept'];
          $year  = $_POST['y'];
          $phno  = $_POST['phno']; 
          $sql = "UPDATE student SET Name='$name', Id='$id',Gender='$gen', Department='$dep', Year='$year', Phno='$phno' WHERE Id='$id'";
             if(mysqli_query($con,$sql))
                {
                    header("Location: admin_dashboard.php");
                    exit;
                }
               else
                {
                    die("not updated".mysqli_error($con));
                } 
             mysqli_close($con);
            ?>