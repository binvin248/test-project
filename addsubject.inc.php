<?php
include_once 'connect.php';
include_once 'sessions.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_POST["subj_code"],$_POST["subj_desc"],$_POST["aca_year"],$_POST["unit"],$_POST["limit_ab"],$_POST["aca_year"],$_POST["crit"],$_POST["room_id"],$_POST["sched"])){
	$subj_code = $_POST["subj_code"];
	$subj_desc = $_POST["subj_desc"];
	$aca_year = $_POST["aca_year"];
	$limit_ab = $_POST["limit_ab"];
	$crit = $_POST["crit"];
	$units = $_POST["unit"];
	$room_id = $_POST["room_id"];
	$sched = $_POST["sched"];

	echo $ct1 = $_POST["ct1"];

	echo $ct2 = $_POST["ct2"];

	if($ct1 == "gen")
	{
		if($ct2 != "lec" and $ct2 != "leclab")
		{
			$_SESSION['flash_type'] = 'error';
			$_SESSION['flash_msg'] = 'Not valid course selection.';
			header("Location: addsubject.php");
		    exit();
		}
	}else
	{
		if($ct2 != "major" and $ct2 != "sb")
		{
			$_SESSION['flash_type'] = 'error';
			$_SESSION['flash_msg'] = 'Not valid course selection.';
			header("Location: addsubject.php");
		    exit();
		}
	}

	if(isset($_POST["subj_id"])){
		$subj_id = $_POST["subj_id"];
	}
	if(!isset($_POST["subj_id"])){
		$sql = "INSERT INTO tb_subjects VALUES (0,'$aca_year','$subj_code','$subj_desc','$units','$limit_ab','$crit', '$room_id', '$sched', $user_id,NOW(),'$ct1','$ct2')";
		if ($conn->query($sql) === TRUE) {
			$_SESSION['flash_msg'] = 'New subject added.';
		    header("Location: assign.php");
		    exit();
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}else{
		$sql = "UPDATE tb_subjects SET school_year = '$aca_year',subj_code='$subj_code',
						subj_desc= '$subj_desc',units='$units',allowed_absences='$limit_ab',
						critical_level='$crit', room_no='$room_id', schedule='$sched',
						crse_type_one='$ct1',crse_type_two='$ct2' 
						WHERE subject_id = $subj_id";
		if ($conn->query($sql) === TRUE) {
			$_SESSION['flash_msg'] = 'Subject details updated.';
		    header("Location: subjects.php?id=l");
		    exit();
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}
	$conn->close();
}else
{
	$_SESSION['flash_msg'] = 'All fields are required';
	header("Location: addsubject.php");
  	exit();

}
}