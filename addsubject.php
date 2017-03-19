<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add subject</title>

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
        <?php include_once 'nav.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">
            
                <!-- Page Heading -->
                <div class="row">
                    
                <?php include_once 'flash.php'; ?>
                    <div class="col-sm-12">
                        <h2><?php
                        if(isset($_GET["act"])){
                            include_once 'connect.php';
                            echo "Edit";
                            $subj_id = $_GET["id"];
                            $sql = "SELECT *  FROM tb_subjects where subject_id = $subj_id";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();

                            $school_year = $row["school_year"];
                            $subj_code = $row["subj_code"];
                            $subj_desc = $row["subj_desc"];
                            $units = $row["units"];
                            $allowed_absences = $row["allowed_absences"];
                            $critical_level = $row["critical_level"];
                            $room_id_2 = $row["room_no"];
                            $schedule = $row["schedule"];
                            $user_id = $row["user_id"];
                            $date_in = $row["date_in"];


                        }else
                        {
                            echo "Add";
                        } ?> subject </h2>
                        <hr>
                        <?php include_once 'flash.php'; ?> 
                        <form action="addsubject.inc.php" method="post">
                            <?php 
                            if(isset($_GET["act"])){
                            ?>
                            <div class="form-group">
                                <label>Subject ID</label>
                                 <input type="text" class="form-control" name="subj_id" required readonly
                                value="<?php if(isset($subj_id)){ echo $subj_id; } ?>">
                            </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Subject Code</label>
                                <input type="text" class="form-control" name="subj_code" required
                                value="<?php if(isset($subj_code)){ echo $subj_code; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Subject Description</label>
                                <input type="text" class="form-control" name="subj_desc" required
                                value="<?php if(isset($subj_desc)){ echo $subj_desc; } ?>"
                            </div>
                            <div class="form-group">
                                <label>Units</label>
                                <input type="number" class="form-control" name="unit" required
                                value="<?php if(isset($units)){ echo $units; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Limit of absent</label>
                                <input type="number" class="form-control" name="limit_ab" required
                                value="<?php if(isset($allowed_absences)){ echo $allowed_absences; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Critical Level</label>
                                <input type="number" class="form-control" name="crit" required
                                value="<?php if(isset($critical_level)){ echo $critical_level; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Academic Year</label>
                                <select class="form-control" name="aca_year">
                                    <?php 
                                    $curyear = date("Y") - 3;
                                    $years = $curyear + 5;
                                    for($i=$curyear;$i<$years;$i++){
                                        ?>
                                        <option value="<?php echo $i; ?>"
                                            <?php if(isset($school_year) and 
                                            $school_year  == $i){ echo "selected"; }?>><?php echo $i; ?></option>
                                        <?php
                                    }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Room No.</label>
                                <input type="text" class="form-control" name="room_id" required
                                value="<?php if(isset($room_id_2)){ echo $room_id_2; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Schedule</label>
                                <input type="text" class="form-control" name="sched" 
                                value="<?php if(isset($schedule)){ echo $schedule; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Course</label>
                                <select class="form-control" name="ct1">
                                    <option value="gen">General education</option>
                                    <option value="pro">Professional</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Sub course</label>
                                <select class="form-control" name="ct2">
                                    <option value="lec">Lecture</option>
                                    <option value="leclab">Lecture and Laboratory</option>
                                    <option value="major">Major</option>
                                    <option value="sb">Skill-based</option>
                                </select>
                            </div>
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </form>
                        <br>
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
