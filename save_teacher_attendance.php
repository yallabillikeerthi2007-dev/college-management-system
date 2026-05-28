<?php
include "db_connect.php";

if(isset($_POST["save"])){
    $dept = $_POST["dept"];
    $date = $_POST["date"];
    $statuses = $_POST["status"];
    $names = $_POST["teacher_name"];

    $duplicate = false;

    foreach($statuses as $teacher_id => $status){
        $teacher_name = $names[$teacher_id];

        $check = mysqli_query($conn, "SELECT * FROM teacher_attendance WHERE teacher_id='$teacher_id' AND date='$date'");
        if(mysqli_num_rows($check) > 0){
            $duplicate = true;
            continue;
        }

        $insert = "INSERT INTO teacher_attendance (teacher_id,teacher_name,dept,date,status) 
                   VALUES ('$teacher_id','$teacher_name','$dept','$date','$status')";
        mysqli_query($conn, $insert);
    }

    if($duplicate){
        echo "<script>alert('Some teachers already had attendance marked for this date. Others saved successfully.');window.location='mark_teacher_attendance.php';</script>";
    } else {
        echo "<script>alert('Attendance saved successfully!');window.location='mark_teacher_attendance.php';</script>";
    }
}
?>