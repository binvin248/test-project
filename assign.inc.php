<?php
include_once 'connect.php';
include_once 'sessions.php';

$student_id = $_POST["stud_id"];
$subject_id = $_POST["subject_id"];
if($subject_id == 0){
	$_SESSION['flash_err'] = 'error';
	$_SESSION['flash_msg'] = 'No subject selected.';
	header("Location: assign.php");
	exit();
}



if(sizeof($student_id) == 0){
	$_SESSION['flash_err'] = 'error';
	$_SESSION['flash_msg'] = 'No student selected.';
	header("Location: assign.php");
	exit();
}

foreach($student_id as $stud_id){
	$sql = "SELECT * FROM tb_students_subjects WHERE student_id = $stud_id AND subject_id = $subject_id";
	$result = $conn->query($sql);
	if ($result->num_rows == 0) {
		$sql = "INSERT INTO tb_students_subjects VALUES (0,$stud_id,$subject_id,$user_id)";
		$conn->query($sql);
	}
}

$conn->close();
$_SESSION['flash_msg'] = 'Student(s) assigned to subject.';
header("Location: assignseat.php?id=$subject_id");
exit();
