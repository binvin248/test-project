<?php
include_once 'sessions.php';
include_once 'connect.php';
include_once 'addabsent.inc.php';
$subject_id = $_GET["id"];

include_once 'getsubjectdetails.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Students in subject</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/tbl_container.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    p {
  margin: 1.5em 0;
  padding: 0;
}
input[type="checkbox"] {
  display: none;
}
label {
  cursor: pointer;
}
input[type="checkbox"] + label:before {
  border: 1px solid #000;
  content: "\00a0";
  display: inline-block;
  font: 16px/1em sans-serif;
  height: 16px;
  margin: 0 .25em 0 0;
  padding:0;
  vertical-align: top;
  width: 16px;
}
input[type="checkbox"]:checked + label:before {
  background: #fff;
  color: #666;
  content: "\2713";
  text-align: center;
}
input[type="checkbox"]:checked + label:after {
  font-weight: bold;
}
    </style>
</head>

<body>

    <div id="wrapper">
      
        <!-- Navigation -->
        <?php include_once 'nav.php'; ?>

        <div id="page-wrapper">
   <div id="tbl_container"> 
            <div class="container-fluid">
                <h3><?php echo $subj_code; ?><small> Add absent</small></h3>
                <hr>
                <?php include_once 'flash.php'; 
                
                ?>
                <!-- Page Heading -->
                <div class="row">

                    <div class="col-sm-12">

                       <form method="POST">
                        <label>Date:</label> <input type="date" name="date_absent" class="form-control" required>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Student No.</th>
                                    <th>Full Name</th>
                                    <th>Seat no.</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <?php 
                                    
                                   

                                    $sql = "SELECT * FROM tb_students_subjects 
                                                INNER JOIN tb_students ON tb_students_subjects.student_id = tb_students.student_id
                                                INNER JOIN tb_subjects ON tb_students_subjects.subject_id = tb_subjects.subject_id
                                                WHERE tb_students_subjects.subject_id = $subject_id  AND tb_students_subjects.user_id = $user_id
                                                ORDER BY tb_students.lname ";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $x = 0;
                                        while($row = $result->fetch_assoc()) {
                                            $student_subject_id = $row["student_subject_id"];
                                            $student_id = $row["student_id"];
                                            $student_no = $row["student_no"];
                                            $subject_id  = $row["subject_id"];
                                            $school_year = $row["school_year"];
                                            $subj_code   = $row["subj_code"];
                                            $subj_desc   = $row["subj_desc"];

                                            $lname = $row["lname"];
                                            $fname = $row["fname"];
                                            $mname = $row["mname"];

                                            $room_id = $row["room_no"];

                                            $sql_s_chair = "SELECT * FROM tb_room_chairs
                                                    WHERE student_subject_id = $student_subject_id
                                                    ORDER BY room_chair_id ASC";
                                                $res_chair = $conn->query($sql_s_chair);
                                                if ($res_chair->num_rows == 1) {
                                                    $row_c = $res_chair->fetch_assoc();
                                                    $chair_no = $row_c["chair_no"];
                                                }else
                                                {
                                                    $chair_no = 0;  
                                                }
                                            ?>

                                <tr>
                                    <td><?php echo $student_no; ?></td>
                                    <td><?php echo "$lname, $fname"; ?></td>
                                    <td><?php echo $chair_no; ?></td>
                                    <td>

                                        <input type="hidden" value="<?php echo $subject_id; ?>" name="subj_id">
                                        <input type="hidden" value="<?php echo $room_id; ?>" name="room_id">
                                        <input type="hidden" value="<?php echo $student_subject_id; ?>" name="student_subject_id2[]">
                                        <input type="checkbox" value="<?php echo $student_subject_id; ?>" id="stud_id<?php echo $x;?>" name="student_subject_id[]">
                                         <label for="stud_id<?php echo $x;?>">Select</label> </td>
                                   
                                </tr>
                                <?php
                                       $x++; }
                                    } ?>   

                                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="submit" class="btn btn-primary" name="submit" value="Add absent"></td>
                                </tr> 
                            </tbody>
                        </table>
                    </form> 
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
