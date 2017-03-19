
<?php
require_once 'connect.php';

$username = $_POST["uname"];
$password = $_POST["upass"];
$sql = "SELECT * FROM tb_users where email = '$username' and user_pass='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
	echo "<div class='alert alert-success' role='alert'>
			  <a href='home.php' class='alert-link'>START USING MCRPT</a>
			</div>";
	session_start();

	$row = $result->fetch_assoc();
    $user_id =  $row["user_id"];
  echo  $user_name =  $row["user_name"];
   
	$_SESSION["user_id"] = $user_id;
	$_SESSION["uname"] = $user_name;

    header("Location: home.php");
    exit();

} else {
  $_SESSION['flash_err'] = 'error';
  $_SESSION['flash_msg'] = 'Wrong username or password';
  header("Location: login.php");
  exit();
}
$conn->close();
?>

