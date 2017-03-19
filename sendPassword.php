<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>


	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>

<?php
include_once 'connect.php';
include 'PHPMailer/PHPMailerAutoload.php';
$email = $_POST["email"];
$sec1 = $_POST["sec1"];
$ans1 = $_POST["ans1"];
$sec2 = $_POST["sec2"];
$ans2 = $_POST["ans2"];
$sql = "SELECT * FROM tb_users WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
$sql = "SELECT * FROM tb_users WHERE email='$email' and (sec1 = $sec1 and answer1 = '$ans1')";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
	$sql = "SELECT * FROM tb_users WHERE email='$email' and (sec1 = $sec1 and answer1 = '$ans1') and (sec2 = $sec2 and answer2 = '$ans2')";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
	$row = $result->fetch_assoc();
	$user_pass = $row["user_pass"];
	$mailer= new PHPMailer;

	$mailer->isSMTP();
	$mailer->SMTPAuth = true;

	$mailer->Host='smtp.gmail.com';
	$mailer->Username = 'ubss@ub.edu.ph';
	$mailer->Password= 'brahman2016';
	$mailer->SMTPSecure = 'ssl';
	$mailer->Port = 465;

	$mailer->FromName = 'MCRPT';
	$mailer->addAddress("$email",'Auto generated password retrieving');

	$mailer->Subject='Request password';
	$mailer->Body="Your password is $user_pass. Please change it immediately.";

	$mailer->send();

	//send the message, check for errors
	if (!$mailer->send()) {
	    $out_msg =  "Mailer Error: " . $mailer->ErrorInfo;
	} else {
	    $out_msg = "Password sent to your email.";
	}
	echo "<div class='alert alert-success' role='alert'>$out_msg</div>";
    echo "<div class='text-center'><a href='login.php'><button type='button' class='btn btn-default'>Login</button></a></div>"; 
}
}
}
?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>



