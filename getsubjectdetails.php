<?php
$s_subjd = "select * from tb_subjects where subject_id = $subject_id";
$r_s_subjd = $conn->query($s_subjd);
$row_rs_subj = $r_s_subjd->fetch_array();

$school_year = $row_rs_subj["school_year"];
$subj_code = $row_rs_subj["subj_code"];
$subj_desc = $row_rs_subj["subj_desc"];
$units = $row_rs_subj["units"];
$allowed_absences = $row_rs_subj["allowed_absences"];
$critical_level = $row_rs_subj["critical_level"];
$room_no = $row_rs_subj["room_no"];
$schedule = $row_rs_subj["schedule"];
$user_id = $row_rs_subj["user_id"];
$date_in = $row_rs_subj["date_in"];
$crse_type_one = $row_rs_subj["crse_type_one"];
$crse_type_two = $row_rs_subj["crse_type_two"];
