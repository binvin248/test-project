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
if(isset($_POST["aca_year"])){
	$sql = "SELECT * FROM tb_users WHERE user_name='$uname'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
	$aca_year_cur = $_POST["aca_year"];
	$aca_year_next = $_POST["aca_year"]+1;
	$aca_year = "$aca_year_cur-$aca_year_next";
	$sql = "INSERT INTO tb_school_years VALUES ('$aca_year_cur','$aca_year','')";
	if ($conn->query($sql) === TRUE) {
    header("Location: addacademicyear.php?res=1");
    exit();
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}else{
	echo "<div class='alert alert-danger' role='alert'>Existing academic year.</div>";
    echo "<div class='text-center'><a href='addacademicyear.php'><button type='button' class='btn btn-default'>Back</button></a></div>"; 

}
}
?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>