
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Assign</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/tbl_container.css" rel="stylesheet">
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
    <style>
    p {
  margin: 1.5em 0;
  padding: 0;
}
input[type="checkbox"] {
  display: none;
}
label {
  cursor: pointer;
}
input[type="checkbox"] + label:before {
  border: 1px solid #000;
  content: "\00a0";
  display: inline-block;
  font: 16px/1em sans-serif;
  height: 16px;
  margin: 0 .25em 0 0;
  padding:0;
  vertical-align: top;
  width: 16px;
}
input[type="checkbox"]:checked + label:before {
  background: #fff;
  color: #666;
  content: "\2713";
  text-align: center;
}
input[type="checkbox"]:checked + label:after {
  font-weight: bold;
}
    </style>
</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include_once 'nav.php'; ?>
        <div id="page-wrapper">
            <div id="tbl_container"> 
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                <?php if(isset($_SESSION['flash_msg'])){ ?> 
                <div class="alert alert-success">
                  <?php echo $_SESSION["flash_msg"];
                        unset($_SESSION["flash_msg"]);?>
                </div>
                <?php } ?>
                    <h3>List of room</h3>

               
                    <div class="col-sm-12">
                        <form action="" method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <?php 
                                    include_once 'connect.php';
                                    
                                    $sql = "SELECT * FROM tb_rooms
                                                WHERE tb_rooms.user_id = $user_id";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $x = 0;
                                        while($row = $result->fetch_assoc()) {
                                            $room_id = $row["room_id"];
                                            $room_desc= $row["room_desc"];
                                            $room_type = $row["room_type"];
                                            $room_capacity = $row["room_capacity"];
                                            ?>
                                <tr>
                                    <td><?php echo $room_desc; ?></td>
                                    <td><?php echo $room_type; ?></td>
                                    <td><a href="rooms.php?act=edit&id=<?php echo $room_id; ?>">Edit</a></td>
                                </tr>
                                <?php
                                       $x++; }
                                    } ?>   
                                   
                                    
                                    
                            </tbody>
                        </table>
                    </form> 
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
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
