<?php
include_once 'connect.php';
include_once 'sessions.php';

if(isset($_POST["upass"],$_POST["cupass"])){
$upass = $_POST["upass"];
$cupass = $_POST["cupass"];
if($upass==$cupass){
$sql = "UPDATE tb_users SET user_pass='$upass'
                                    WHERE user_id = $user_id;";
if ($conn->query($sql) === TRUE) {
  $msg = "User password update successful.";
}else{
  $msg = "Faile to update user profile.";
}
}else{
  $msg = "Password not matched.";
}
}
?>
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

    <style type="text/css">
    /*label{
      color: blue;
    }*/
    body{
      background-color: white;
    }
    </style>

</head>

<body>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                      <?php 
                      if(isset($msg)){
                        echo "<div class='alert alert-success' role='alert'>$msg.</div>";
                      } ?>
                        <h2>Change password</h2>
                        <form method="POST">
                          <div class="form-group">
                            <label for="upass">Password</label>
                            <input type="password" name="upass" class="form-control" id="upass" placeholder="Enter password" required>
                          </div>
                          <div class="form-group">
                            <label for="cupass">Confirm password</label>
                            <input type="password" name="cupass" class="form-control" id="upass" placeholder="Enter password" required>
                          </div>
                          <button type="submit" class="btn btn-default">Update</button>
                          <a href="home.php"><button type="button" class="btn btn-default">Back</button></a>
                        </form>
                        <br>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
