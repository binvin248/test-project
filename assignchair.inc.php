<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$err = array();
		if(isset($_POST["submit_chair"],$_POST["student_subject_id2"],$_POST["room_id"])){
			$room_id = $_POST["room_id"];
			$room_chair_no = $_POST["room_chair_no"];
			$students_absent = $_POST["student_subject_id2"];
			$nostuds =  sizeof($students_absent);

			for($i=0; $i<$nostuds;$i++){
				$sqlcr = "select * from tb_room_chairs where room_no = '$room_id' AND chair_no = $room_chair_no[$i]";
				$resultcr = $conn->query($sqlcr);

				if($resultcr->num_rows == 0){

				$sqlc = "select * from tb_room_chairs where student_subject_id = $students_absent[$i]";
				$resultc = $conn->query($sqlc);
				if ($resultc->num_rows == 0) {
					if($room_chair_no[$i]!=0){
					$sql = "insert into tb_room_chairs VALUES (0,'$room_id', $room_chair_no[$i], $students_absent[$i])";
					if ($conn->query($sql) === TRUE) {
				    	//echo "Success <br>";
					} else {
					   //echo "Error: " . $sql . "<br>" . $conn->error;
					} 
					}
				}else
				{
					$sql = "update tb_room_chairs set room_no = '$room_id', chair_no = $room_chair_no[$i]
								where student_subject_id = $students_absent[$i]";
					if ($conn->query($sql) === TRUE) {
				    	//echo "Success <br>";
					} else {
					   //echo "Error: " . $sql . "<br>" . $conn->error;
					} 
				}
				}
				else
				{
					$err = "conflict";
				}
			}	
		}

		$_SESSION['flash_msg'] = 'Seats assigned/updated.';
		header("Location: subjects.php?id=l");
		exit();
}
