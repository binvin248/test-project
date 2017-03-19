<?php
include_once 'sessions.php';
include_once 'connect.php';
?>
<table class="table" border="1">
    <thead>
        <tr>
            <th>Student No.</th>
            <th>Full Name</th>
            <th>Final grade</th>
        </tr>
    </thead>
    <tbody>
      
            <?php 
            $subject_id = $_GET["id"];
           

            $sql = "SELECT * FROM tb_students_subjects 
                        INNER JOIN tb_students ON tb_students_subjects.student_id = tb_students.student_id
                        INNER JOIN tb_subjects ON tb_students_subjects.subject_id = tb_subjects.subject_id
                        INNER JOIN tb_rooms ON tb_subjects.room_id = tb_rooms.room_id
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

                    $room_id = $row["room_id"];
                    $room_capacity = $row["room_capacity"];

                    //compute grades
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

                                    $total_lec =$total_final + $total_midterm + $total_quiz + $total_others + $total_semis + $total_prelim;
                                    $total_lab = $total_lab_final + $total_lab_work + $total_lab_oth + $total_lab_mid;


                    ?>

        <tr>
            <td><?php echo $student_no; ?></td>
            <td><?php echo "$lname, $fname"; ?></td>
            <td><?php echo $final_grade_computed = ($total_lec * .60) + ($total_lab * .40); ?></td>
        </tr>
        <?php
               $x++; }
            } ?>   

    </tbody>
</table>

<?php 
/*header('Content-Type: application/doc');
header("Content-Disposition: attachment; filename=forapproval.doc"); */
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=test_dl.xls"); 
?>