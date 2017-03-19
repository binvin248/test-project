<?php
include_once 'connect.php';
include_once 'sessions.php';
$id = $_GET["id"];
$sql2 = "SELECT * FROM tb_students_subjects WHERE student_subject_id = $id";
$result2 = $conn->query($sql2);
if($result2->num_rows == 1){
	$row2 = $result2->fetch_assoc();
	$subj_id = $row2["subject_id"];



$sql = "DELETE from tb_students_subjects where student_subject_id = $id";
$conn->query($sql);
$_SESSION['flash_msg'] = 'Student deleted.';
header("Location: subjectsStudents.php?id=$subj_id");
exit();

}