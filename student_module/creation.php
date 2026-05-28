<?php
      include "db.php";
//creating the table
         $sql = "CREATE TABLE student(SNo INT AUTO_INCREMENT PRIMARY KEY,Name VARCHAR(20),Id varchar(10) UNIQUE,Gender VARCHAR(10),
                    Department VARCHAR(15), Year VARCHAR(10),Phno VARCHAR(15))";

$ct = mysqli_query($con, $sql);

if($ct){
    echo "Table created successfully";
} else {
    echo "Not created: ".mysqli_error($con);
}

?> 