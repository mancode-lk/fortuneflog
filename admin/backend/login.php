<?php
include 'conn.php';
$email=$_REQUEST['email'];
$password=$_REQUEST['password'];

if($email=="admin" && $password=="123"){
    $_SESSION['admin_id']=true;
    header('location:../index.php');
    exit();
}else{
    $_SESSION['logged_in_failed']=true;
    header('location:../login.php');
    exit();
}

?>
