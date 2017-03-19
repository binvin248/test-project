<?php
include_once 'sessions.php';
include_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <title>Students in subject</title>


    
</head>

<body>

    <div id="wrapper">
      
      <?php

        $subject_id = $_GET["id"];
        include_once 'getsubjectdetails.php'; 
        ?>

        <div id="page-wrapper">
   <div id="tbl_container"> 
            <div class="container-fluid">
                <?php include_once 'flash.php'; ?>
                <!-- Page Heading -->
                <div class="row">

                    <div class="col-sm-12">
                        
                        <table class="table" border="1">
                            <thead>
                                <tr>
                                    <th>Student No.</th>
                                    <th>Full Name</th>
                                    <th>MG</th>
                                    <th>FG</th>
                                    <th>Final</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <?php 
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

                                            $crse_type_one = $row["crse_type_one"];

                                            $crse_type_two = $row["crse_type_two"];

                                            include_once 'getgrade.inc.php';

                                            $sql4 = "select * from tb_student_record_absences where student_subject_id = $student_subject_id";
                                            $rs4 = $conn->query($sql4);
                                            $noofabs = $rs4->num_rows;
                                            $style_on = false;
                                            if($noofabs >= $allowed_absences) { 
                                                $style_on = true;
                                                $style= "style='color:#FEEFB3;'";
                                            }
                                            if($noofabs >= $critical_level){
                                                $style_on = true;
                                                }
                                            ?>

                                <tr>
                                    <td <?php if($style_on == true){ echo $style;}  ?>><?php echo $student_no; ?></td>
                                    <td><?php echo "$lname, $fname"; ?></td>
                                    <td><?php echo $midterm_grade." { " .convert_grade($midterm_grade) . " } "; ?></td>
                                    <td><?php echo $final_grade." { " .convert_grade($final_grade) . " } "; ?></td>
                                    <td><?php echo $finals_ave." { " .convert_grade($finals_ave) . " } "; ?></td>
                                    
                                    
                                </tr>


                                <?php
                                       $x++; }
                                    }


                                     ?>   

                            </tbody>
                        </table>

                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
   

</body>

</html>
<?php 
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$subj_code.xls"); ?>
