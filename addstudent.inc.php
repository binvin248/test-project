<?php
include_once 'connect.php';
include_once 'sessions.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_POST["stud_no"],$_POST["lname"],$_POST["fname"],$_POST["mname"],$_POST["cnum"])){

	$stud_no = $_POST["stud_no"];
	$lname = $_POST["lname"];
	$fname = $_POST["fname"];
	$mname = $_POST["mname"];
	$cnum = $_POST["cnum"];
	if(isset($_POST["stud_id"]))
	{
		$student_id = $_POST["stud_id"];
	}

	if (strlen($cnum)<8 or strlen($cnum)>11) {
	  	$_SESSION['flash_msg'] = 'Contact number is not valid.';
	  	if(isset($_POST["stud_id"]))
	  	{
	  		header("Location: addstudent.php?act=edit&id=$student_id");
		    exit();
	  	}
	  	header("Location: addstudent.php");
  		exit();
	}



	if(!isset($_POST["stud_id"])){

		$sqlcstud = "select * from tb_students where student_no = '$stud_no' and user_id = $user_id";
		$rs_stud = $conn->query($sqlcstud);
		if($rs_stud->num_rows == 1)
		{
			$_SESSION['flash_type'] = 'error';
			$_SESSION['flash_msg'] = 'Student already added.';
			header("Location: addstudent.php");
		  	exit();
		}


		$_SESSION['flash_msg'] = 'New student added.';
		echo $sql = "INSERT INTO tb_students VALUES (0,'$stud_no','$lname','$fname','$mname','$cnum',$user_id,NOW())";
		if ($conn->query($sql) === TRUE) {
		$_SESSION['flash_msg'] = 'New student added.';	
	    header("Location: addsubject.php");
	    exit();
		} else{
			echo "asdf";
		}
	}else
	{
		
		$sql = "UPDATE tb_students set student_no = '$stud_no',
										lname='$lname',
										fname='$fname',
										mname='$mname',
										contact_no='$cnum'
					WHERE student_id = $student_id";
		if ($conn->query($sql) === TRUE) {
			$_SESSION['flash_msg'] = 'Student data updated.';
		    header("Location: students.php?act=edit&id=$student_id");
		    exit();
		} 
	}
	$conn->close();
}else
{
	$_SESSION['flash_type'] = 'error';
	$_SESSION['flash_msg'] = 'All fields are required';
	header("Location: addstudent.php");
  	exit();

}
}