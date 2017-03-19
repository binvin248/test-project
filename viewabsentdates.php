<?php
include_once 'sessions.php';
include_once 'connect.php';
 include_once 'addabsent.inc.php';
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
                
                <?php include_once 'flash.php'; ?>
                <!-- Page Heading -->
                <div class="row">
                <?php 
                 $stud_subj_id = $_GET["id"];

                $sql2 = "SELECT * FROM tb_students 
                            inner join tb_students_subjects on tb_students.student_id = tb_students_subjects.student_id
                            where tb_students_subjects.student_subject_id = $stud_subj_id";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();

                $subject_id = $row2["subject_id"];
                
                $student_id = $row2["student_id"];
                $student_no = $row2["student_no"];
                $lname = $row2["lname"];
                $lname = ucfirst($lname);
                $fname = $row2["fname"];
                $fname = ucfirst($fname);
                $mname = $row2["mname"];
                $contact_no = $row2["contact_no"];

                include_once 'getsubjectdetails.php';

                echo "<h3>$subj_code - $lname, $fname</h3> * Date(s) Absent <hr>";
                                    ?>

                    <div class="col-sm-12">
                       <form method="POST">
                        
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <?php 



                                    $sql = "SELECT * FROM tb_student_record_absences 
                                                where student_subject_id = $stud_subj_id";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $x = 0;
                                        while($row = $result->fetch_assoc()) {
                                            $date_absent = $row["date_absent"];
                                            $x++;
                                            ?>

                                <tr>
                                    <td><?php echo "$date_absent"; ?></td>
                                   
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
            $('#example').DataTable({
            });
        } );
    </script>

</body>

</html>
