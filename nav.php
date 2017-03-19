<?php

include_once 'connect.php';
include_once 'sessions.php';

$username = $_SESSION["uname"];


?>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img style="display: inline-block; width:25px" src="img/logo.png"> <?php echo $username; ?>
                </a>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
         
                    <li>
                            <a href="search.php"><i class="fa fa-search" aria-hidden="true"></i> Search</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-upload"></i> Create a class<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="addstudent.php">Student</a>
                            </li>
                            <li>
                                <a href="addsubject.php">Subject</a>
                            </li>
                            <li>
                                <a href="assign.php">Assign students in subject</a>
                            </li>
                            <li>
                                <a href="subjects.php?id=as">Seat arrangement</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-upload"></i> Subjects<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo2" class="collapse">
                            <li>
                                <a href="subjects.php?id=l">List</a>
                            </li>
                            <!-- <li>
                                <a href="subjects.php?id=a">Attendance</a>
                            </li> -->
                             <li>
                                <a href="subjects.php?id=cr">Class record</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="students.php"><i class="fa fa-table" aria-hidden="true"></i> Students</a>
                    </li>

                    <li>
                        <a href="notifications.php"><i class="fa fa-bell" aria-hidden="true"></i> Notifications</a>
                    </li>
                        

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo3"><i class="fa fa-user"></i> <?php echo $_SESSION["uname"]; ?><i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo3" class="collapse">
                            <li>
                                <a href="viewprofile.php">View profile</a>
                            </li>
                            <li>
                                <a href="changepass.php">Change password</a>
                            </li>
                             <li>
                                <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log out <i></i></a>
                            </li>
                        </ul>
                    </li>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

<!-- <div class="pull-right"><label>MCRPT&nbsp;&nbsp;</label></div> -->

      