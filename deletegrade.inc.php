<?php
include_once 'connect.php';
include_once 'sessions.php';
$id = $_GET["id"];
$sql2 = "SELECT * FROM tb_grades WHERE grade_id = $id";
$result2 = $conn->query($sql2);
if($result2->num_rows == 1){
	$row2 = $result2->fetch_assoc();
	$stud_sub_id = $row2["student_subject_id"];



$sql = "DELETE from tb_grades where grade_id = $id";
$conn->query($sql);

$_SESSION['flash_msg'] = 'Grade deleted.';
header("Location: viewgrades.php?id=$stud_sub_id");
exit();

}