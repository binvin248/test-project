<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	//echo "post data<br>";
	if(isset($_POST["date_absent"],$_POST["student_subject_id"])){
	
	$date_absent = $_POST["date_absent"];
	$students_absent = $_POST["student_subject_id"];
	$subject_id = $_POST["subj_id"];
	include_once 'getsubjectdetails.php';

	if(!empty($date_absent))
	{
		foreach($students_absent as $student_subject_id){

			$sqlcr = "select * from tb_student_record_absences where student_subject_id = $student_subject_id AND date_absent = '$date_absent'";
			$resultcr = $conn->query($sqlcr);

				if($resultcr->num_rows == 0){



				$sql = "insert into tb_student_record_absences VALUES (0,$student_subject_id, '$date_absent')";
				if ($conn->query($sql) === TRUE) {
			    	echo "Success <br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error;
				} 

				echo $sql2 = "select * from tb_student_record_absences where student_subject_id = $student_subject_id";
				$rs2 = $conn->query($sql2);
				$rsno2 = $rs2->num_rows;
				if($rsno2 >= $critical_level){
					$noti_desc ="Student is on critical level";
					if($rsno2 >= $allowed_absences){
						$noti_desc ="Student reached its limit of absent.";
					}
					$sql4 = "select * from tb_noti where student_subject_id = $student_subject_id and noti_desc = '$noti_desc'";
					$rs4 = $conn->query($sql4);
					if($rs4->num_rows == 0){
						$sql3 = "insert into tb_noti VALUES (0,$student_subject_id, $user_id, '$noti_desc', NOW())";
					    $rs3 = $conn->query($sql3);
					}

				}

			}
		}

		$_SESSION['flash_type'] = 'error';
		$_SESSION['flash_msg'] = 'Absent added.';
		header("Location: viewabsent.php?id=$subject_id");
		exit();
	}else
	{
		$_SESSION['flash_type'] = 'error';
		$_SESSION['flash_msg'] = 'Data invalid.';
		header("Location: addabsent.php");
		exit();

	}
	}
	
	/*if(isset($err) AND sizeof($err) > 0){
		$_SESSION['flash_err'] = 'error';
		$_SESSION['flash_msg'] = 'Some seats was already assigned.';
	}else{
		$_SESSION['flash_msg'] = 'Success assigning seats.';

	}*/
	$_SESSION['flash_msg'] = 'Seats assigned/updated.';
	
}


