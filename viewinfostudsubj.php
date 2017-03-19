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
                        <br>
                        <label>Student information</label>
                       <form method="POST">
                        <table class="table">
                           <tbody>
                              
                                    <?php 
                                    $student_subject_id = $_GET["id"];

                                    $sql_quiz = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
                                                    AND component = 'Lecture' AND grade_for = 'Quiz'";
                                    $rs_quiz  = $conn->query($sql_quiz);
                                    if($rs_quiz->num_rows > 0){
                                        while($row_quiz = $rs_quiz->fetch_assoc()) {
                                            $quiz_grades[] = $row_quiz["grade"];
                                        }
                                        $no_quizzes = count($quiz_grades);
                                        $sum_quiz_grade =  array_sum($quiz_grades);
                                        $quiz_grade = $sum_quiz_grade/$no_quizzes;
                                    }else{
                                        $quiz_grade = "";
                                    }
                                    $total_quiz = $quiz_grade * .20;

                                    $sql_others = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
                                                    AND component = 'Lecture' AND grade_for = 'Others'";
                                    $rs_oth  = $conn->query($sql_others);
                                    if($rs_oth->num_rows > 0){
                                        while($row_oth = $rs_oth->fetch_assoc()) {
                                            $others_grades[] = $row_oth["grade"];
                                        }
                                        $no_others = count($others_grades);
                                        $sum_oth_grade =  array_sum($others_grades);
                                        $others_grade = $sum_oth_grade/$no_others;
                                    }else{
                                        $others_grade = "";
                                    }
                                    $total_others = $others_grade * .20;

                                    $sql_prelim = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
                                                    AND component = 'Lecture' AND grade_for = 'Prelim'
                                                    ORDER BY grade_id DESC";
                                    $rs_prelim  = $conn->query($sql_prelim);
                                    if($rs_prelim->num_rows > 0){
                                        $row_prelim = $rs_prelim->fetch_assoc();
                                        $prelim_grade = $row_prelim["grade"];
                                    }else{
                                        $prelim_grade = "";
                                    }
                                    $total_prelim = $prelim_grade * .10;


                                    $sql_semi = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
                                                    AND component = 'Lecture' AND grade_for = 'Semi final'
                                                    ORDER BY grade_id DESC";
                                    $rs_semi  = $conn->query($sql_semi);
                                    if($rs_semi->num_rows > 0){
                                        $row_semi = $rs_semi->fetch_assoc();
                                        $semis_grade = $row_semi["grade"];
                                    }else{
                                        $semis_grade = "";
                                    }
                                    $total_semis = $semis_grade * .10;


                                    $sql_mid = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
                                                    AND component = 'Lecture' AND grade_for = 'Midterm'
                                                    ORDER BY grade_id DESC";
                                    $rs_mid  = $conn->query($sql_mid);
                                    if($rs_mid->num_rows > 0){
                                        $row_mid = $rs_mid->fetch_assoc();
                                        $midterm_grade = $row_mid["grade"];
                                    }else{
                                        $midterm_grade = "";
                                    }
                                    $total_midterm = $midterm_grade * .20;

                                    $sql_final = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
                                                    AND component = 'Lecture' AND grade_for = 'Finals'
                                                    ORDER BY grade_id DESC";
                                    $rs_final  = $conn->query($sql_final);
                                    if($rs_final->num_rows > 0){
                                        $row_final = $rs_final->fetch_assoc();
                                        $final_grade = $row_final["grade"];
                                    }else{
                                        $final_grade = "";
                                    }
                                    $total_final = $final_grade * .20;

                                    $sql_lab_work = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
                                                    AND component = 'Laboratory' AND grade_for = 'Laboratory Work'";
                                    $rs_lab_work = $conn->query($sql_lab_work);
                                    if($rs_lab_work->num_rows > 0){
                                        while($row_lab_work = $rs_lab_work->fetch_assoc()) {
                                            $lab_work_grades[] = $row_lab_work["grade"];
                                        }
                                        $no_lab_work = count($lab_work_grades);
                                        $sum_lab_work =  array_sum($lab_work_grades);
                                        $lab_work_grade = $sum_lab_work/$no_lab_work;
                                    }else{
                                        $lab_work_grade = "";
                                    }
                                    $total_lab_work = $lab_work_grade * .40;

                                    $sql_lab_oth = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
                                                    AND component = 'Laboratory' AND grade_for = 'Others'";
                                    $rs_lab_oth = $conn->query($sql_lab_oth);
                                    if($rs_lab_oth->num_rows > 0){
                                        while($row_lab_oth = $rs_lab_oth->fetch_assoc()) {
                                            $lab_oth_grades[] = $row_lab_oth["grade"];
                                        }
                                        $no_lab_oth = count($lab_oth_grades);
                                        $sum_lab_oth =  array_sum($lab_oth_grades);
                                        $lab_oth_grade = $sum_lab_oth/$no_lab_oth;
                                    }else{
                                        $lab_oth_grade = "";
                                    }
                                    $total_lab_oth = $lab_oth_grade * .20;

                                    $sql_lab_mid = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
                                                    AND component = 'Laboratory' AND grade_for = 'Midterm'
                                                    ORDER BY grade_id DESC";
                                    $rs_lab_mid  = $conn->query($sql_lab_mid);
                                    if($rs_lab_mid->num_rows > 0){
                                        $row_lab_mid = $rs_lab_mid->fetch_assoc();
                                        $lab_mid_grade = $row_lab_mid["grade"];
                                    }else{
                                        $lab_mid_grade = "";
                                    }
                                    $total_lab_mid = $lab_mid_grade * .20;

                                    $sql_lab_final = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
                                                    AND component = 'Laboratory' AND grade_for = 'Finals'
                                                    ORDER BY grade_id DESC";
                                    $rs_lab_final  = $conn->query($sql_lab_final);
                                    if($rs_lab_final->num_rows > 0){
                                        $row_lab_final = $rs_lab_final->fetch_assoc();
                                        $lab_final_grade = $row_lab_final["grade"];
                                    }else{
                                        $lab_final_grade = "";
                                    }
                                    $total_lab_final = $lab_final_grade * .20;

                                    $total_midterm_lab_grade = $total_lab_mid + $total_lab_oth + $total_lab_work;
                                    $total_final_lab_grade = $total_lab_mid + $total_lab_oth + $total_lab_work;

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
                                            $fname = $row["fname"];
                                            $mname = $row["mname"];

                                            $room_id = $row["room_no"];

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

                                    $sql = "SELECT * FROM tb_students
                                                INNER JOIN tb_students_subjects ON tb_students.student_id = tb_students_subjects.student_id
                                                INNER JOIN tb_student_record_absences ON tb_students_subjects.student_subject_id = tb_student_record_absences.student_subject_id
                                                WHERE tb_student_record_absences.student_subject_id = $student_subject_id ";
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
                                    <td colspan="2" align="center">Lecture Component</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><a href="addgrade.php?id=<?php echo "$student_subject_id&lab=1"; ?>">Add</a></td>
                                </tr>
                                <tr>
                                    <td>Quizzes (20%)</td>
                                    <td><?php echo $quiz_grade; ?></td>
                                </tr>
                                <tr>
                                    <td>Prelim/Semi final (20%)</td>
                                    <td><?php echo "$prelim_grade/$semis_grade";?></td>
                                </tr>
                                <tr>
                                    <td>Midterm/Finals (40%)</td>
                                    <td><?php echo "$midterm_grade/$final_grade";?></td>
                                </tr>
                                <tr>
                                    <td>Others requirements (20%)</td>
                                    <td><?php echo "$others_grade";?></td>
                                </tr>
                                <tr>
                                    <td>Total (100%)</td>
                                    <td><?php echo $total_lec =$total_final + $total_midterm + $total_quiz + $total_others + $total_semis + $total_prelim;?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">Laboratory Component</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><a href="addgrade.php?id=<?php echo "$student_subject_id&lab=2"; ?>">Add</a></td>
                                </tr>
                                <tr>
                                    <td>Laboratory work (40%)</td>
                                    <td><?php echo "$lab_work_grade";?></td>
                                </tr>
                                <tr>
                                    <td>Midterm/Finals (40%)</td>
                                    <td><?php echo "$lab_mid_grade/$lab_final_grade";?></td>
                                </tr>
                                <tr>
                                    <td>Others requirements (20%)</td>
                                    <td><?php echo "$lab_oth_grade";?></td>
                                </tr>
                                <tr>
                                    <td>Total (100%)</td>
                                    <td><?php echo $total_lab = $total_lab_final + $total_lab_work + $total_lab_oth + $total_lab_mid;?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">Total Grade = 60 % Lecture + 40 % Laboratory</td>
                                </tr>
                                <tr>
                                    <td>Final Grade</td>
                                    <td><?php echo $final_grade_computed = ($total_lec * .60) + ($total_lab * .40); ?></td>
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
