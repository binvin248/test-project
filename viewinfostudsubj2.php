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
                
                include_once 'getgrade.inc.php';

                $sql_s_chair = "SELECT * FROM tb_room_chairs
                    WHERE student_subject_id = $student_subject_id
                    ORDER BY room_chair_id ASC";
                $res_chair = $conn->query($sql_s_chair);
                if ($res_chair->num_rows == 1) {
                    $row_c = $res_chair->fetch_assoc();
                    $chair_no = $row_c["chair_no"];
                }else
                {
                    $chair_no = 0;
                }

                } 

                include_once 'getsubjectdetails.php'; 


                ?>

        <div id="page-wrapper">
   <div id="tbl_container"> 
            <div class="container-fluid">
                
                <!-- Page Heading -->
                <div class="row">

                    <div class="col-sm-12">
                        <br>
                        <h3><?php echo strtoupper($subj_code) ."-". $lname .", " .$fname; ?> <small><a href="addgrade2.php?id=<?php echo $student_subject_id;?>&mj=<?php echo $show; ?>">Add grade</a>
                        | <a href="viewgrades.php?id=<?php echo $student_subject_id;?>">View grades</a></small></h3>
                        <?php include_once 'flash.php'; ?>
                       <form method="POST">
                        <table class="table">
                           <tbody>
                              
                                    <?php 

                                   

                                    $sql = "SELECT * FROM tb_students
                                                INNER JOIN tb_students_subjects ON tb_students.student_id = tb_students_subjects.student_id
                                                INNER JOIN tb_student_record_absences ON tb_students_subjects.student_subject_id = tb_student_record_absences.student_subject_id
                                                WHERE tb_student_record_absences.student_subject_id = $student_subject_id";
                                    $result = $conn->query($sql);
                                    $noabs = $result->num_rows;
                                        
                                            ?>
                                <tr>
                                    <td>Student no.</td>
                                    <td><?php echo $student_no; ?></td>
                                </tr>           
                                <tr>
                                    <td>Last name</td>
                                    <td><?php echo $lname; ?></td>
                                </tr> 
                                <tr>
                                    <td>First name</td>
                                    <td><?php echo $fname; ?></td>
                                </tr>
                                <tr>
                                    <td>Middle</td>
                                    <td><?php echo $mname; ?></td>
                                </tr>
                                <tr>
                                    <td>Room no.</td>
                                    <td><?php echo $room_id; ?></td>
                                </tr> 
                                <tr>
                                    <td>Seat no.</td>
                                    <td><?php echo $chair_no; ?></td>
                                </tr> 
                                <tr>
                                    <td>No of Absences</td>
                                    <td><?php echo $noabs; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2" align="center">Midterm</td>
                                </tr>

                                <tr>
                                    <td>Written works</td>
                                    <td><?php 
                                    if($crse_type_two == "leclab" or $crse_type_two == "sb"){
                                        $final_mlewritten_grade = number_format($final_mlewritten_grade);
                                        $final_mlawritten_grade = number_format($final_mlawritten_grade);
                                        echo "$final_mlewritten_grade/$final_mlawritten_grade";
                                     } else{
                                    echo $final_mwritten_grade; }?></td>
                                </tr>

                                <tr>
                                    <td>Performance tasks</td>
                                    <td><?php 
                                    if($crse_type_two == "leclab" or $crse_type_two == "sb"){
                                        echo "$final_mleperformance_grade/$final_mlaperformance_grade";
                                     } else{
                                    echo $final_mwritten_grade; }?></td>
                                </tr>

                                <tr>
                                    <td>Major exams</td>
                                    <td><?php 
                                    if($crse_type_two == "leclab" or $crse_type_two == "sb"){
                                        echo "$final_mlemajor_grade/$final_mlamajor_grade";
                                     } else{
                                    echo $final_mwritten_grade; }?></td>
                                </tr>

                                <tr>
                                    <td>Grade</td>
                                    <td><?php echo $midterm_grade."/ { " .convert_grade($midterm_grade) . " } "; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2"  align="center">Finals</td>
                                </tr>

                                <tr>
                                    <td>Written works</td>
                                    <td><?php 
                                    if($crse_type_two == "leclab" or $crse_type_two == "sb"){ 
                                        echo "$final_flewritten_grade/$final_flawritten_grade";
                                    } else{
                                    echo $final_mwritten_grade; }?></td>
                                </tr>

                                <tr>
                                    <td>Performance tasks</td>
                                    <td><?php 
                                    if($crse_type_two == "leclab" or $crse_type_two == "sb"){
                                        echo "$final_fleperformance_grade/$final_flaperformance_grade";
                                     } else{
                                    echo $final_mwritten_grade; }?></td>
                                </tr>

                                <tr>
                                    <td>Major exams</td>
                                    <td><?php 
                                    if($crse_type_two == "leclab" or $crse_type_two == "sb"){ 
                                        echo "$final_flemajor_grade/$final_flamajor_grade";
                                    } else{
                                    echo $final_mwritten_grade; }?></td>
                                </tr>
                                
                                <tr>
                                    <td>Grade</td>
                                    <td><?php echo $final_grade."/ { " .convert_grade($final_grade) . " } "; ?></td>
                                </tr>

                                <tr>
                                    <td>Final</td>
                                    <td><?php echo $finals_ave."/ { " .convert_grade($finals_ave) . " } "; ?></td>
                                </tr>

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
