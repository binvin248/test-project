<?php
require_once 'connect.php';
session_start();
$lname = $_POST["lname"];
$fname = $_POST["fname"];
$mname = $_POST["mname"];
$uname = $_POST["uname"];
$upass = $_POST["upass"];
$email = $_POST["email"];
$cupass = $_POST["cupass"];
$sec1 = $_POST["sec1"];
$ans1 = $_POST["ans1"];
$sec2 = $_POST["sec2"];
$ans2 = $_POST["ans2"];
if($upass == $cupass)
{
$sql = "SELECT * FROM tb_users WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $_SESSION['flash_err'] = 'error';
	$_SESSION['flash_msg'] = 'Email invalid.';
    header("Location: register.php");
    exit();
}else{

$sql = "INSERT INTO tb_users VALUES (0,'$lname','$fname','$mname','$email','$uname','$upass','teacher',NOW(),$sec1,'$ans1',$sec2,'$ans2')";
if ($conn->query($sql) === TRUE) {

    $_SESSION['flash_msg'] = 'Registration successful.';
    header("Location: login.php");
    exit();
}

}
}else{
    $_SESSION['flash_err'] = 'error';
    $_SESSION['flash_msg'] = 'Password not match.';
    header("Location: register.php");
    exit();
}
