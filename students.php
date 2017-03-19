
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

    <link href="datatable/media/css/jquery.dataTables.css" rel="stylesheet">

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
            <div id="tbl_container"> 
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                    <h3>List of students<small><a href="addstudent.php"> Add student</a></small></h3>
                    <hr>
                    <?php include_once 'flash.php'; ?>
                    <div class="col-sm-12">
                        <form action="" method="post">
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Student no.</th>
                                    <th>Full name</th>
                                    <th>Contact no.</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <?php 
                                    include_once 'connect.php';
                                    
                                    $sql = "SELECT * FROM tb_students WHERE user_id = $user_id";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $x = 0;
                                        while($row = $result->fetch_assoc()) {
                                            $student_id = $row["student_id"];
                                            $student_no = $row["student_no"];
                                            $lname = $row["lname"];
                                            $fname = $row["fname"];
                                            $mname = $row["mname"];
                                            $contact_no = $row["contact_no"];
                                            ?>
                                <tr>
                                    <td><?php echo $student_no; ?></td>
                                    <td><?php echo "$lname, $fname"; ?></td>
                                    <td><?php echo $contact_no; ?></td>
                                    <td><a href="addstudent.php?act=edit&id=<?php echo $student_id; ?>">Edit</a></td>
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

    <script src="datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>

</body>

</html>
