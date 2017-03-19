<?php
include_once 'connect.php';
include_once 'sessions.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_POST["room_no"],$_POST["rtype"],$_POST["capacity"])){
	$room_no = $_POST["room_no"];
	$rtype = $_POST["rtype"];
	$capacity = $_POST["capacity"];
	if(isset($_POST["room_id"]))
	{
		$room_id = $_POST["room_id"];
	}


	if(!isset($_POST["room_id"])){	
		$sql = "INSERT INTO tb_rooms VALUES (0,'$room_no','$rtype', $user_id, NOW())";
		if ($conn->query($sql) === TRUE) {
	   	$_SESSION['flash_msg'] = 'New room added.';
		header("Location: addsubject.php");
	  	exit();
		} 
	}else
	{
		$sql = "UPDATE tb_rooms SET room_desc='$room_no',room_type='$rtype'
			WHERE room_id=$room_id";
		if ($conn->query($sql) === TRUE) {
		   	$_SESSION['flash_msg'] = 'Room  details updated.';
			header("Location: roomlist.php");
		  	exit();
		} 

	}
	
	$conn->close();
	
}else
{
	$_SESSION['flash_msg'] = 'All fields are required';
	header("Location: addstudent.php");
  	exit();
}
}