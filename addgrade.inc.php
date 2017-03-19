<?php
include_once 'connect.php';
if(isset($_POST["id"],$_POST["com"],$_POST["com"],$_POST["gradefor"],$_POST["grade"])){
	$id = $_POST["id"];
	$com = $_POST["com"];
	$gradefor = $_POST["gradefor"];
	$grade = $_POST["grade"];
	if($com == 1){
		$comdesc = "Lecture";
	}else{
		$comdesc = "Laboratory";
	}
	$sql = "INSERT INTO tb_grades VALUES (0,$id,'$comdesc','$gradefor',$grade,NOW())";
	if ($conn->query($sql) === TRUE) {
    header("Location: addgrade.php?id=$id&lab=$com");
    exit();
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}