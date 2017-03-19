<?php
include_once 'connect.php';
include_once 'sessions.php';
$sql = "SELECT * FROM tb_users WHERE user_id='$user_id'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $user_id = $row["user_id"];
  $u_lname = $row["u_lname"];
  $u_fname = $row["u_fname"];
  $u_mname = $row["u_mname"];
  $email = $row["email"];
  $user_name = $row["user_name"];
  $sec1 = $row["sec1"];
  $sec2 = $row["sec2"];
  $answer1 = $row["answer1"];
  $answer2 = $row["answer2"];
}

if(isset($_POST["lname"],$_POST["fname"],$_POST["mname"],$_POST["uname"],$_POST["email"])){
$lname = $_POST["lname"];
$fname = $_POST["fname"];
$mname = $_POST["mname"];
$uname = $_POST["uname"];
$email = $_POST["email"];
$sec1 = $_POST["sec1"];
$ans1 = $_POST["ans1"];
$sec2 = $_POST["sec2"];
$ans2 = $_POST["ans2"];
$sql = "UPDATE tb_users SET u_lname='$lname',u_fname='$fname',u_mname='$mname',email='$email',
                                  sec1='$sec1',answer1='$ans1',sec2='$sec2',answer2='$ans2'
                                    WHERE user_id = $user_id;";
if ($conn->query($sql) === TRUE) {
  $msg = "User profile update successful.";
}else{
  $msg = "Faile to update user profile.";
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
                        <h1>User Profile</h1>
                        <form method="POST">
                          <div class="form-group">
                            <label for="lname">Last name</label>
                            <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter last name" 
                            value="<?php echo $u_lname; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="fname">First name</label>
                            <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter first name" 
                            value="<?php echo $u_fname; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="mname">Middle Initial</label>
                            <input type="text" name="mname" class="form-control" id="mname" placeholder="Enter middle initial" 
                            value="<?php echo $u_mname; ?>">
                          </div>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email address" 
                            value="<?php echo $email; ?>" required >
                          </div>
                          <div class="form-group">
                            <label for="uname">Username</label>
                            <input type="text" name="uname" class="form-control" id="uname" placeholder="Enter username" 
                            value="<?php echo $user_name; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="cupass">First security question</label>
                            <select class="form-control" name="sec1">
                                <?php $sql_sec1  = "SELECT * FROM tb_security_questions";
                                      $result_sec1 = $conn->query($sql_sec1);
                                      while($row_sec1 = $result_sec1->fetch_assoc()) {
                                        $sec_ques_id1 = $row_sec1["sec_ques_id"];
                                        $security_question1 = $row_sec1["security_question"];
                                          ?>
                                        <option value="<?php echo $sec_ques_id1; ?>"
                                          <?php  if($sec_ques_id1 == $sec1){ echo "selected"; } ?>><?php echo $security_question1; ?></option>
                                      <?php
                                      }
                                 ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="ans1">Answer</label>
                            <input type="text" name="ans1" class="form-control" id="ans1"
                             value="<?php echo $answer1; ?>" required>
                          </div>
                          
                           <div class="form-group">
                            <label for="sec2">Second security question</label>
                            <select class="form-control" name="sec2">
                                <?php $sql_sec  = "SELECT * FROM tb_security_questions";
                                      $result_sec = $conn->query($sql_sec);
                                      while($row_sec = $result_sec->fetch_assoc()) {
                                        $sec_ques_id2 = $row_sec["sec_ques_id"];
                                        $security_question = $row_sec["security_question"];
                                          ?>
                                        <option value="<?php echo $sec_ques_id2; ?>"
                                        <?php  if($sec_ques_id2 == $sec2){ echo "selected"; } ?>><?php echo $security_question; ?></option>
                                      <?php
                                      }
                                 ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="ans2">Answer</label>
                            <input type="text" name="ans2" class="form-control" id="ans2" 
                            value="<?php echo $answer2; ?>" required>
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
