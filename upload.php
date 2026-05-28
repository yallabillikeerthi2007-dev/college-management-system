<?php

session_start();
include "dbl.php";

if(!isset($_SESSION['student_pin'])){
    header("Location: loginpage.html");
    exit();
}

$pin = $_SESSION['student_pin'];


$name         = trim($_POST['name']         ?? '');
$role         = trim($_POST['role']         ?? '');
$dept         = trim($_POST['dept']         ?? '');
$year_of_join = trim($_POST['year_of_join'] ?? '');
$dob          = trim($_POST['dob']          ?? '');
$phone        = trim($_POST['phone']        ?? '');
$address      = trim($_POST['address']      ?? '');
$old_pic      = trim($_POST['old_pic']      ?? '');


$profile_pic = $old_pic; 

if(!empty($_FILES['profile_pic']['name'])){
    $file      = $_FILES['profile_pic'];
    $allowed   = ['image/jpeg','image/png','image/gif','image/webp'];
    $max_size  = 2 * 1024 * 1024;

    if(!in_array($file['type'], $allowed)){
        header("Location: profile.php?status=error&msg=invalid_type");
        exit();
    }
    if($file['size'] > $max_size){
        header("Location: profile.php?status=error&msg=too_large");
        exit();
    }

    $upload_dir = __DIR__ . '/uploads/';
if(!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

$ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$filename = 'profile_' . preg_replace('/\D/', '', $pin) . '_' . time() . '.' . $ext;
$dest_abs = $upload_dir . $filename;        
$dest_rel = 'uploads/' . $filename;         

if(move_uploaded_file($file['tmp_name'], $dest_abs)){
      
        if(!empty($old_pic) && $old_pic !== 'uploads/default.png' && file_exists($old_pic)){
            unlink($old_pic);
        }
        $profile_pic = $dest_rel;
    } else {
        header("Location: profile.php?status=error&msg=upload_fail");
        exit();
    }
}


$check = $conn->prepare("SELECT id FROM profile WHERE pin_no = ?");
$check->bind_param("s", $pin);
$check->execute();
$exists = $check->get_result()->num_rows > 0;
$check->close();


if($exists){
    $stmt = $conn->prepare(
        "UPDATE profile
         SET name=?, role=?, dept=?, year_of_join=?, dob=?, phone=?, address=?, profile_pic=?
         WHERE pin_no=?"
    );
    $stmt->bind_param("sssssssss",
        $name, $role, $dept, $year_of_join,
        $dob, $phone, $address, $profile_pic, $pin
    );
} else {
    $stmt = $conn->prepare(
        "INSERT INTO profile (name, pin_no, role, dept, year_of_join, dob, phone, address, profile_pic)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssssss",
        $name, $pin, $role, $dept,
        $year_of_join, $dob, $phone, $address, $profile_pic
    );
}

if($stmt->execute()){
    header("Location: profile.php?status=success");
} else {
    header("Location: profile.php?status=error&msg=db_fail");
}

$stmt->close();
$conn->close();
exit();