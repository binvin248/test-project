<?php
include_once 'connect.php';
session_start();
if(isset($_POST["id"],$_POST["area"],$_POST["gradefor"],$_POST["grade"])){
	$id = $_POST["id"];
	$area = $_POST["area"];
	$gradefor = $_POST["gradefor"];
	$grade = $_POST["grade"];
	if(isset($_POST["exam"])){
	$exam = $_POST["exam"];}else{
		$exam = "";
	}

	// check major exam input
	echo $sql2 = "SELECT * FROM tb_grades WHERE student_subject_id = $id and area='$area' and grade_for = '$gradefor' and exam = '$exam'";
	$result2 = $conn->query($sql2);
	if($result2->num_rows == 2){

		$_SESSION['flash_err'] = 'error';
		$_SESSION['flash_msg'] = 'Cannot insert more than 2 major exam.';
	    header("Location: viewinfostudsubj2.php?id=$id");
	    exit();

	}
	
	$sql = "INSERT INTO tb_grades VALUES (0,$id,'$area','$gradefor','$exam',$grade,NOW())";
	if ($conn->query($sql) === TRUE) {
		$_SESSION['flash_msg'] = 'Grade added.';
	    header("Location: viewinfostudsubj2.php?id=$id");
	    exit();
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}