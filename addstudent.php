<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add student</title>

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

    <div id="wrapper">
        <!-- Navigation -->
        <?php include_once 'nav.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">
                <?php include_once 'flash.php'; ?>
                <!-- Page Heading -->
                <div class="row">

                <?php 
                if(isset($_SESSION['flash_msg'])){ ?> 
                <div class="alert alert-danger">
                  <?php echo $_SESSION["flash_msg"];
                        unset($_SESSION["flash_msg"]);?>
                </div>
                <?php } ?>
                    <div class="col-sm-12">
                        <h2><?php
                        if(isset($_GET["act"])){
                            include_once 'connect.php';
                            echo "Edit";
                            $stud_id = $_GET["id"];
                            $sql = "SELECT *  FROM tb_students where student_id = $stud_id";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();

                            $student_no = $row["student_no"];
                            $lname = $row["lname"];
                            $fname = $row["fname"];
                            $mname = $row["mname"];
                            $contact_no = $row["contact_no"];

                        }else
                        {
                            echo "Add";
                        }

                        ?> student</h2>
                        <hr>
                        <form action="addstudent.inc.php" method="post">
                            <?php 
                            if(isset($_GET["act"])){
                            ?>
                            <div class="form-group">
                                <label>Student ID</label>
                                 <input type="text" class="form-control" name="stud_id" required readonly
                                value="<?php if(isset($stud_id)){ echo $stud_id; } ?>">
                            </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Student No.</label>
                                <input type="text" class="form-control" name="stud_no" required 
                                value="<?php if(isset($student_no)){ echo $student_no; } ?>"
                                >
                            </div>
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" class="form-control" name="lname" required
                                value="<?php if(isset($lname)){ echo $lname; } ?>">
                            </div>
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" class="form-control" name="fname" required
                                value="<?php if(isset($fname)){ echo $fname; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Middle name</label>
                                <input type="text" class="form-control" name="mname" required
                                value="<?php if(isset($mname)){ echo $mname; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Contact No.</label>
                                <input type="number" class="form-control" name="cnum" required
                                value="<?php if(isset($contact_no)){ echo $contact_no; } ?>">
                            </div>
                            <input type="submit" value="<?php if(isset($_GET["act"])){ echo "Update"; }else{ echo "Submit"; } ?>" class="btn btn-primary">
                        </form>
                        <br>
                    </h1>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
