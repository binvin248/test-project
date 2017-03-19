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

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-sm-12">
                        <form action="addgrade.inc.php" method="POST">
                            <br>
                            <div class="form-group">
                                <label>Grade for</label>
                                <select class="form-control" name="gradefor">
                                    <?php if(isset($_GET["lab"]) and $_GET["lab"] == 2){  ?>
                                    <option value="Laboratory Work">Laboratory work</option>
                                    <option value="Midterm">Midterm</option>
                                    <option value="Finals">Finals</option>
                                    <option value="Others">Others</option>
                                    <?php }else{ ?>
                                    <option value="Quiz">Quiz</option>
                                    <option value="Prelim">Prelim</option>
                                    <option value="Semi final">Semi final</option>
                                    <option value="Midterm">Midterm</option>
                                    <option value="Finals">Finals</option>
                                    <option value="Others">Others</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Grade</label>
                                <input type="hidden" name="id" class="form-control" value="<?php echo $_GET['id']; ?>" required>
                                <input type="hidden" name="com" class="form-control" value="<?php echo $_GET['lab']; ?>" required>
                                <input type="text" name="grade" class="form-control" required>
                            </div>
                            <input type="submit" value="Submit" class="btn btn-primary">
                            <a href="viewinfostudsubj.php?id=<?php echo $_GET["id"];?>"><input type="button" value="Back" class="btn btn-default"></a>
                    
                            <br>
                            <br>
                        </form>
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
