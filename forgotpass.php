<?php include_once 'connect.php'; ?>
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

    <?php include_once "bg.php"; ?>

</head>
<body>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Forgot password</h1>
                        <form action="sendPassword.php" method="POST">
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter email address">
                          </div>
                          <div class="form-group">
                            <label for="cupass">First security question</label>
                            <select class="form-control" name="sec1">
                                <?php $sql_sec  = "SELECT * FROM tb_security_questions";
                                      $result_sec = $conn->query($sql_sec);
                                      while($row_sec = $result_sec->fetch_assoc()) {
                                        $sec_ques_id = $row_sec["sec_ques_id"];
                                        $security_question = $row_sec["security_question"];
                                          ?>
                                        <option value="<?php echo $sec_ques_id; ?>"><?php echo $security_question; ?></option>
                                      <?php
                                      }
                                 ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="ans1">Answer</label>
                            <input type="text" name="ans1" class="form-control" id="ans1" placeholder="Enter answer" required>
                          </div>
                          
                          <div class="form-group">
                            <label for="sec2">Second security question</label>
                            <select class="form-control" name="sec2">
                                <?php $sql_sec  = "SELECT * FROM tb_security_questions";
                                      $result_sec = $conn->query($sql_sec);
                                      while($row_sec = $result_sec->fetch_assoc()) {
                                        $sec_ques_id = $row_sec["sec_ques_id"];
                                        $security_question = $row_sec["security_question"];
                                          ?>
                                        <option value="<?php echo $sec_ques_id; ?>"><?php echo $security_question; ?></option>
                                      <?php
                                      }
                                 ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="ans2">Answer</label>
                            <input type="text" name="ans2" class="form-control" id="ans2" placeholder="Enter answer" required>
                          </div>
                          
                          <button type="submit" class="btn btn-default">Request password</button>
                          <a href="index.php"><button type="button" class="btn btn-default">Back</button></a>
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
