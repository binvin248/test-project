<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add student</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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


</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include_once 'nav.php'; 

        $student_subject_id = $_GET["id"];
         $sql = "SELECT * FROM tb_students
                    INNER JOIN tb_students_subjects ON tb_students.student_id = tb_students_subjects.student_id
                    INNER JOIN tb_subjects ON tb_students_subjects.subject_id = tb_subjects.subject_id
                    WHERE tb_students_subjects.student_subject_id = $student_subject_id
                    ORDER BY tb_students.lname ";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
                $student_id = $row["student_id"];
                $student_no = $row["student_no"];
                $subject_id  = $row["subject_id"];
                $school_year = $row["school_year"];
                $subj_code   = $row["subj_code"];
                $subj_desc   = $row["subj_desc"];


                $lname = $row["lname"];
                $lname = ucfirst(strtolower($lname));
                $fname = $row["fname"];
                $fname = ucfirst(strtolower($fname));
                $mname = $row["mname"];
                $room_id = $row["room_no"];

                $crse_type_one = $row["crse_type_one"];

                $crse_type_two = $row["crse_type_two"];

                if($crse_type_two=="leclab" or $crse_type_two=="sb")
                {
                    $show = "true";
                }else
                {
                    $show = "false";
                }
                
                include_once 'getgrade.inc.php';

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

                } 

                include_once 'getsubjectdetails.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">
            <h3><?php echo strtoupper($subj_code)."-".$lname .", " .$fname; ?> <small>Add grade</small></h3>
                <hr>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-sm-12">
                        <form action="addgrade2.inc.php" method="POST">
                            <br>
                            <div class="form-group">
                                <label>Grade for</label>
                                <select class="form-control" name="gradefor">
                                    <option value="midterm">Midterm</option>
                                    <option value="final">Final</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Area</label>
                                <select class="form-control" name="area">
                                    <option value="written">Written</option>
                                    <option value="performance">Performance</option>
                                    <option value="major">Major</option>
                                </select>
                            </div>
                            <?php if(isset($_GET["mj"]) and $_GET["mj"] == "true"){?>
                            <div class="form-group">
                                <label></label>
                                <select class="form-control" name="exam">
                                    <option value="lecture">Lecture</option>
                                    <option value="laboratory">Laboratory</option>
                                </select>
                            </div>

                            <?php } ?>
                            <div class="form-group">
                                <label>Grade</label>
                                <input type="number" name="grade" class="form-control" required>
                            </div>
                            <input type="hidden" name="id" class="form-control" value="<?php echo $_GET['id']; ?>" required>
                            <input type="submit" value="Submit" class="btn btn-primary">
                          
                    
                            <br>
                        </form>
                    </h1>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

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
