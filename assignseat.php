<?php
include_once 'sessions.php';
include_once 'connect.php';
 include_once 'assignchair.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Students in subject</title>

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
                <h3>Assign seat no.</h3>
                <hr>
                <?php include_once 'flash.php'; ?>
                <!-- Page Heading -->
                <div class="row">

                    <div class="col-sm-12">
                       
                       <form method="POST">
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Student No.</th>
                                    <th>Full Name</th>
                                    <th>Seat no.</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <?php 
                                    $subject_id = $_GET["id"];
                                   

                                    $sql = "SELECT * FROM tb_students_subjects 
                                                INNER JOIN tb_students ON tb_students_subjects.student_id = tb_students.student_id
                                                INNER JOIN tb_subjects ON tb_students_subjects.subject_id = tb_subjects.subject_id
                                                WHERE tb_students_subjects.subject_id = $subject_id  AND tb_students_subjects.user_id = $user_id
                                                ORDER BY tb_students.lname ";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $x = 0;
                                        while($row = $result->fetch_assoc()) {
                                            $student_subject_id = $row["student_subject_id"];
                                            $student_id = $row["student_id"];
                                            $student_no = $row["student_no"];
                                            $subject_id  = $row["subject_id"];
                                            $school_year = $row["school_year"];
                                            $subj_code   = $row["subj_code"];
                                            $subj_desc   = $row["subj_desc"];

                                            $lname = $row["lname"];
                                            $fname = $row["fname"];
                                            $mname = $row["mname"];

                                            $room_id = $row["room_no"];

                                            $sql_s_chair = "SELECT * FROM tb_room_chairs
                                                    WHERE student_subject_id = $student_subject_id";
                                                $res_chair = $conn->query($sql_s_chair);
                                                if ($res_chair->num_rows == 1) {
                                                    $row_c = $res_chair->fetch_assoc();
                                                    $chair_no = $row_c["chair_no"];
                                                }else
                                                {
                                                    $chair_no = 0;  
                                                }
                                            ?>

                                <tr>
                                    <td><?php echo $student_no; ?></td>
                                    <td><?php echo "$lname, $fname"; ?></td>
                                    <td><input type="number" class="form-control" name="room_chair_no[]" min="0" max="60"
                                        value="<?php if(isset($chair_no)) { echo $chair_no; } ?>"></td>
                                    <td>
                                        <input type="hidden" value="<?php echo $room_id; ?>" name="room_id">
                                        <input type="hidden" value="<?php echo $student_subject_id; ?>" name="student_subject_id2[]">
                                    </td>
                                   
                                   
                                </tr>
                                <?php
                                       $x++; }
                                    } ?>   

                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <!-- /.row -->

                <br>
                 <div class="row">
                     <div class="col-sm-6">
                       
                     </div>

                     <div class="col-sm-6 pull-right">
                        <input type="submit" class="btn btn-primary" name="submit_chair" value="Assign chair">
                     </div>
                                   
                                       
                 </div>
                 </form>
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
