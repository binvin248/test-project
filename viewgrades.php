<?php
include_once 'sessions.php';
include_once 'connect.php';
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

    <link href="datatable/media/css/jquery.dataTables.css" rel="stylesheet">

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
        <?php include_once 'nav.php'; 

        $student_subject_id = $_GET["id"];
        $sql = "SELECT * FROM tb_students
                    INNER JOIN tb_students_subjects ON tb_students.student_id = tb_students_subjects.student_id
                    INNER JOIN tb_subjects ON tb_students_subjects.subject_id = tb_subjects.subject_id
                    WHERE tb_students_subjects.student_subject_id = $student_subject_id
                    ORDER BY tb_students.lname ";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
                $student_id = $row["student_id"];
                $student_no = $row["student_no"];
                $subject_id  = $row["subject_id"];
                $school_year = $row["school_year"];
                $subj_code   = $row["subj_code"];
                $subj_desc   = $row["subj_desc"];

                $lname = $row["lname"];
                $lname = ucfirst(strtolower($lname));
                $fname = $row["fname"];
                $fname = ucfirst(strtolower($fname));
                $mname = $row["mname"];
                
                $room_id = $row["room_no"];

                $crse_type_one = $row["crse_type_one"];

                $crse_type_two = $row["crse_type_two"];

                if($crse_type_two=="leclab" or $crse_type_two=="sb")
                {
                    $show = "true";
                }else
                {
                    $show = "false";
                }
            }
             include_once 'getsubjectdetails.php'; 
        ?>

        <div id="page-wrapper">
   <div id="tbl_container"> 
            <div class="container-fluid">
                <h3><?php echo strtoupper($subj_code)."-".$lname .", " .$fname; ?> <small><a href="addgrade2.php?id=<?php echo $student_subject_id;?>&mj=<?php echo $show; ?>">Add grade</a></small></h3>
                <hr>
                <?php include_once 'flash.php'; ?>
                <!-- Page Heading -->
                <div class="row">

                    <div class="col-sm-12">
                       
                       <form method="POST">
                        
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Area</th>
                                    <th>Grade for</th>
                                    <th>Exam for</th>
                                    <th>Grade</th>
                                    <th>Date inserted</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <?php 
                                     

                                    $sql = "SELECT * FROM tb_students_subjects 
                                                INNER JOIN tb_students ON tb_students_subjects.student_id = tb_students.student_id
                                                INNER JOIN tb_subjects ON tb_students_subjects.subject_id = tb_subjects.subject_id
                                                INNER JOIN tb_grades ON tb_students_subjects.student_subject_id = tb_grades.student_subject_id
                                                WHERE tb_students_subjects.student_subject_id = $student_subject_id";
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

                                            $grade_id = $row["grade_id"];
                                            $area = $row["area"];
                                            $grade_for = $row["grade_for"];
                                            $exam = $row["exam"];
                                            $grade = $row["grade"];
                                            $date_in = $row["date_in"];


                                           
                                            ?>

                                <tr>
                                    <td><?php echo $area; ?></td>
                                    <td><?php echo $grade_for; ?></td>
                                    <td><?php echo $exam;?>  </td>
                                    <td><?php echo $grade;?>  </td>
                                    <td><?php echo $date_in;?>  </td>
                                    <td><a href="verifydelgrade.php?id=<?php echo $grade_id; ?>">Delete</a></td>
                                </tr>


                                <?php
                                       $x++; }
                                    }


                                     ?>   

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
            $('#example').DataTable( {
                "paging":   false
            } );
        } );
    </script>

</body>

</html>
