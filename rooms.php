<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add room</title>

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
                        <h2><?php
                        if(isset($_GET["act"])){
                            include_once 'connect.php';
                            echo "Edit";
                            $id = $_GET["id"];
                             $sql = "SELECT * FROM tb_rooms
                                                WHERE room_id = $id";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();

                            $room_id = $row["room_id"];
                            $room_desc= $row["room_desc"];
                            $room_type = $row["room_type"];

                        }else
                        {
                            echo "Add";
                        } ?> room </h2>
                        <hr>
                        <form action="rooms.inc.php" method="post">
                            <?php 
                            if(isset($_GET["act"])){
                            ?>
                            <div class="form-group">
                                <label>Room ID</label>
                                 <input type="text" class="form-control" name="room_id" required readonly
                                 value="<?php if(isset($id)){ echo $id; } ?>">
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label>Room No.</label>
                                <input type="text" class="form-control" name="room_no" required
                                value="<?php if(isset($room_desc)){ echo $room_desc; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Room Type</label>
                                <select class="form-control" name="rtype">
                                        <option value="Laboratory">Laboratory</option>
                                        <option value="Ordinary">Ordinary</option>
                                </select>
                            </div>
                            <input type="submit" value="Submit" class="btn btn-primary">
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
