<?php
include_once 'sessions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Assign</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="datatable/media/css/jquery.dataTables.css" rel="stylesheet">
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

            <div class="container-fluid">
                <h2>Assign student(s) to subject</h2>
                <hr>

               <?php include_once 'flash.php'; ?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-sm-12">
                        <form action="assign.inc.php" method="post">
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Student No.</th>
                                    <th>Full Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <?php 
                                    include_once 'connect.php';
                                    
                                    $sql = "SELECT * FROM tb_students WHERE user_id = $user_id";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $x = 0;
                                        while($row = $result->fetch_assoc()) {
                                            $student_id = $row["student_id"];
                                            $student_no = $row["student_no"];
                                            $lname = $row["lname"];
                                            $fname = $row["fname"];
                                            $mname = $row["mname"];
                                            ?>
                                <tr>
                                    <td><?php echo $student_no; ?></td>
                                    <td><?php echo "$lname, $fname"; ?></td>
                                    <td><input type="checkbox" value="<?php echo $student_id; ?>" id="stud_id<?php echo $x;?>" name="stud_id[]">
                                        <label for="stud_id<?php echo $x;?>">Select</label>
                                    </td>
                                </tr>
                                <?php
                                       $x++; }
                                    } ?>

                                
                                   
                                    
                                    
                            </tbody>
                        </table>


                       
                    
                    </div>
                </div>
                <!-- /.row -->
                <br>
                 <div class="row">
                     <div class="col-sm-6">
                        <select class="form-control" name="subject_id">
                                        <option value="0">Select subject</option>
                                    <?php
                                    $sql = "SELECT * FROM tb_subjects WHERE user_id = $user_id";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $subject_id  = $row["subject_id"];
                                            $school_year = $row["school_year"];
                                            $subj_code   = $row["subj_code"];
                                            $subj_desc   = $row["subj_desc"];
                                            ?>
                                    <option value="<?php echo $subject_id; ?>"><?php echo "$subj_desc-$school_year"; ?></option>
                                <?php
                                       } }
                                    ?>      
                                    </select>
                     </div>

                     <div class="col-sm-6 pull-right">
                        <input type="submit" class="btn btn-primary" value="Assign">
                     </div>
                                   
                                       
                 </div>

            </div>
            <!-- /.container-fluid -->
            </form> 
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


    <script src="datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable( {
                "paging":   false,
                "info":   false
            } );
        } );
    </script>

</body>

</html>
