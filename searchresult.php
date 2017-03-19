<?php
include_once 'sessions.php';
?>
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
                    <div class="col-sm-12">
                        <h3>Searc result for <i><?php echo $_GET["key"]; ?></i></h3>
                        <form action="" method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Academic Year</th>
                                    <th>Subject</th>
                                    <th>Schedule</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <?php 
                                    include_once 'connect.php';
                                    $key = $_GET["key"];
                                    $sql = "SELECT * FROM tb_students
                                                INNER JOIN tb_students_subjects ON tb_students.student_id = tb_students_subjects.student_id
                                                INNER JOIN tb_subjects ON tb_students_subjects.subject_id = tb_subjects.subject_id
                                                INNER JOIN tb_rooms ON tb_subjects.room_id = tb_rooms.room_id
                                                WHERE tb_students.student_no = '$key' OR tb_students.lname = '$key'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $x = 0;
                                        while($row = $result->fetch_assoc()) {
                                            $student_subject_id = $row["student_subject_id"];
                                            $student_id = $row["student_id"];
                                            $student_no = $row["student_no"];
                                            $lname = $row["lname"];
                                            $fname = $row["fname"];
                                            $mname = $row["mname"];
                                            $subject_id = $row["subject_id"];
                                            $school_year= $row["school_year"];
                                            $subj_code = $row["subj_code"];
                                            $subj_desc = $row["subj_desc"];
                                            $schedule = $row["schedule"];
                                            $room = $row["room_desc"];
                                            ?>
                                <tr>
                                    <td><?php echo $school_year; ?></td>
                                    <td><?php echo $subj_desc; ?></td>
                                    <td><?php echo $room."/".$schedule; ?></td> 
                                    <td><a href="viewinfostudsubj.php?id=<?php echo $student_subject_id; ?>">View info</a> </td>
                                </tr>
                                <?php
                                       $x++; }
                                    }else{
                                       echo "<div class='alert alert-danger' role='alert'>
                                          No data found.
                                        </div>";
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
