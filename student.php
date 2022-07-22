<?php

session_start();



if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    # code...
    header('Location:./logout.php');
}
?>
<?php

include_once './auth/config.php';
$auth = new Database();
?>

<?php

$ustu_fname = $ustu_mname = $ustu_lname = $ustu_dob = $ustu_doj = $ustu_gender = $ustu_email = $ustu_address = $ustu_std = " ";


if (isset($_GET['update'])) {
    $update = "SELECT * FROM student WHERE stu_id='" . $_GET['update'] . "'";
    $result = $auth->conn->query($update);
    $rows = $result->fetchAll();
    if ($rows) {
        // output data of each row
        foreach ($rows as $row) {
            $ustu_fname = $row['stu_fname'];
            $ustu_mname = $row['stu_mname'];
            $ustu_lname = $row['stu_lname'];
            $ustu_dob = date_format(new DateTime($row['stu_dob']), 'Y-m-d');
            $ustu_doj = date_format(new DateTime($row['stu_doj']), 'Y-m-d');
            $ustu_gender = $row['stu_gender'];
            $ustu_email = $row['stu_email'];
            $ustu_address = $row['stu_address'];
            $ustu_std = $row['stu_std'];
        }
    }
}

?>


<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student</title>
    <link href="https://play-lh.googleusercontent.com/INY4vfQNUb6DmvSAmEDqcZAJzYbDkPa9WORf0AdZMeJQDBXkPeQypC-25Cl1Rc1XLzA" type="image/png" rel="icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <?php include_once './utilities/header.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include_once './utilities/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Student
                    <small>Student Details</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
                    <li class="active">Details</li>
                </ol>
            </section>

            <!-- Main content -->


            <section class="content">

                <div class="row">

                    <?php
                    if (!isset($_GET['update'])) { ?>
                        <div class="col-xs-4">



                            <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                New Student Successfully added
                            </div>
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">New Student</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">First Name</label>
                                            <input name="stu_fname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Student First Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Middle Name</label>
                                            <input name="stu_mname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Student Middle Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Last Name</label>
                                            <input name="stu_lname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Student Last Name" required>
                                        </div>

                                        <div class="form-group">

                                            <label>Date of Birth</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name='stu_dob' class="form-control pull-right" id="datepicker" placeholder="Select Student's Data of Birth">
                                            </div>
                                            <!-- /.input group -->

                                        </div>

                                        <div class="form-group">

                                            <label>Date of Joining</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name='stu_doj' class="form-control pull-right" id="datepicker1" placeholder="Select Student's Data of Joining">
                                            </div>
                                            <!-- /.input group -->

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Gender</label>
                                            <div class="radio ">
                                                <label style="width: 100px"><input type="radio" name="stu_gender" value="Male" checked>Male</label>
                                                <label style="width: 100px"><input type="radio" name="stu_gender" value="Female" checked>Female</label>

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email</label>
                                            <input name="stu_email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter Student email" required>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Address</label>
                                            <textarea name="stu_address" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Standard</label>
                                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="stu_std">
                                                <option disabled selected>Select Current Standard</option>
                                                <?php
                                                $sql = "SELECT * FROM classroom order by c_name,c_division asc";
                                                $result = $auth->conn->query($sql);
                                                $rows = $result->fetchAll();
                                                if ($rows) {
                                                    // output data of each row
                                                    foreach ($rows as $row) {
                                                        echo "<option value='" . $row["c_name"] ." " . $row["c_division"]."' >" . $row["c_name"] . " " . $row["c_division"]  . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Student</button>
                                    </div>
                                </form>

                                <?php

                                if (isset($_POST['submit'])) {
                                    $stu_id = "STU-" . rand(1, 100000);
                                    $stu_fname = $_POST['stu_fname'];
                                    $stu_mname = $_POST['stu_mname'];
                                    $stu_lname = $_POST['stu_lname'];
                                    $stu_dob = date_format(new DateTime($_POST['stu_dob']), 'Y-m-d');
                                    $stu_doj = date_format(new DateTime($_POST['stu_doj']), 'Y-m-d');

                                    $stu_gender = $_POST['stu_gender'];
                                    $stu_email = $_POST['stu_email'];
                                    $stu_address = $_POST['stu_address'];
                                    $stu_std = $_POST['stu_std'];
                                    $stu_pass = "Stu@" . $stu_fname . "123";


                                    try {


                                        $sql = "INSERT INTO student (stu_id,stu_fname,stu_mname,stu_lname,stu_dob,stu_doj,stu_gender,stu_email,stu_address,stu_std,stu_pass) VALUES ('" . $stu_id . "', '" . $stu_fname . "', '" . $stu_mname . "', '" . $stu_lname . "','" . $stu_dob . "','" . $stu_doj . "','" . $stu_gender . "','" . $stu_email . "','" . $stu_address . "','" . $stu_std . "','" . $stu_pass . "')";

                                        if ($auth->conn->query($sql)) {

                                            $to = $stu_email;


                                            $subject = "Successfully Joined SchoolUpp Family";
                                            $message = "<table style='width:100%;margin:0;padding:0' width='100%' cellpadding='0' cellspacing='0' role='presentation'>
                                  <tbody><tr>
                                    <td style='word-break:break-word;font-family:Lato,Tahoma,sans-serif;font-size:16px;height:25px;width:570px;margin:0 auto'>
                                      <table class='m_764826514911004926email-body_inner' style='width:570px;margin:0 auto;padding:12px;background-color:#fff;background:#000;' align='center' width='570' cellpadding='0' cellspacing='0' role='presentation'>
                                        <tbody><tr>
                                          <td style='word-break:break-word;font-family:Lato,Tahoma,sans-serif;font-size:16px'>
                                            <a style='color:white; text-decoration:none;' href='http://localhost/SMS/' target='_blank'>
                                            <div style='display:flex;align-items:center;'>
                                            <div><img src='https://play-lh.googleusercontent.com/INY4vfQNUb6DmvSAmEDqcZAJzYbDkPa9WORf0AdZMeJQDBXkPeQypC-25Cl1Rc1XLzA' width='45' height='45' alt=''></div>
                                             <div><h4 style='margin:0px 8px'>S c h o o l U p p</h4> </div>
                                            </div>
                                            </a>
                                          </td>
                                        </tr>
                                      </tbody></table>
                                    </td>
                                  </tr>
                                  
                                  
                                  <tr>
                                    <td style='word-break:break-word;font-family:Lato,Tahoma,sans-serif;font-size:16px;width:100%;margin:0;padding:0' width='570' cellpadding='0' cellspacing='0'>
                                      <table class='m_764826514911004926email-body_inner' style='width:570px;margin:0 auto;padding:0;background-color:#fff' align='center' width='570' cellpadding='0' cellspacing='0' role='presentation'>
                                        
                                        
                                        <tbody><tr>
                                          <td style='word-break:break-word;font-family:Lato,Tahoma,sans-serif;font-size:16px;padding:20px 45px'>
                                            <div>
                                              <p style='margin-top:0;color:#333;font-size:18px;text-align:left'>
                                  Thanks for registration! <br/>
                                  Your credentials are as below <br/><br/>
                                  Username : {$stu_email} <br/>
                                  Password : {$stu_pass} <br/>  
                                  </p>
                      
                                  <p style='color:#51545e;margin:0.4em 0 1.1875em;font-size:16px;line-height:1.625'>
                                  <u><b>Please Note:</b></u><br/>
                                  1) Password is case sensitive
                                  </p>
                      
                                  <p style='color:#51545e;margin:0.4em 0 1.1875em;font-size:16px;line-height:1.625'>You are now eligible for using following features:</p>
                      
                                  <ul style='margin:0.4em 0 1.1875em;font-size:16px;line-height:1.625'>
                                  <li>Attendance</li>
                                  <li>Teacher & Student Managment</li>
                                  <li>Fees Managment</li>
                                  <li>Parent Portal</li>
                                  <li>Exam Managment</li>
                                  <li>Time Table Managment</li>
                                  </ul>
                      
                      
                                  <h2 style='margin-top:0;color:#333;font-size:20px;font-weight:bold;text-align:left'>
                                  Getting Started on SchoolUpp
                                  </h2>
                      
                                  <p style='color:#51545e;margin:0.4em 0 1.1875em;font-size:16px;line-height:1.625'>
                                  If you did not create this account and you received this email, contact us.
                                  </p>
                                                      </div>
                                                      </td>
                                                  </tr>
                                                  
                                                  </tbody></table>
                                              
                                              </td>
                                              </tr>
                                          </tbody></table>";

                                            
                                            $header = "From:ssiphostel2425@gmail.com \r\n";
                                            $header .= "MIME-Version: 1.0\r\n";
                                            $header .= "Content-type: text/html\r\n";

                                            $retval = mail($to, $subject, $message, $header);

                                            if ($retval) {

                                                echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
                                                x.style.display='block';</script>";
                                            } else {
                                                echo "<script>alert('Mail does not sent')</script>";
                                            }
                                        } else {
                                        }
                                    } catch (Exception $e) {
                                    }






                                    # code...
                                }

                                ?>



                            </div>
                        </div> <?php } elseif (isset($_GET['update'])) { ?>



                        <!--Update************************************************************************************************************* -->
                        <div class="col-xs-4">



                            <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                Update Student Successfully
                            </div>
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Update Student</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">First Name</label>
                                            <input name="stu_fname" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $ustu_fname . "'"; ?>>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Middle Name</label>
                                            <input name="stu_mname" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $ustu_mname . "'"; ?>>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Last Name</label>
                                            <input name="stu_lname" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $ustu_lname . "'"; ?>>
                                        </div>

                                        <div class="form-group">

                                            <label>Date of Birth</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name='stu_dob' class="form-control pull-right" id="datepicker" placeholder="Select Student's Data of Birth" value=<?php echo "'" . $ustu_dob . "'"; ?>>
                                            </div>
                                            <!-- /.input group -->

                                        </div>

                                        <div class="form-group">

                                            <label>Date of Joining</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name='stu_doj' class="form-control pull-right" id="datepicker1" placeholder="Select Student's Data of Joining" value=<?php echo "'" . $ustu_doj . "'"; ?>>
                                            </div>
                                            <!-- /.input group -->

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Gender</label>
                                            <div class="radio ">
                                                <label style="width: 100px"><input type="radio" name="stu_gender" value="Male" <?php if ($ustu_gender == 'Male') {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>Male</label>
                                                <label style="width: 100px"><input type="radio" name="stu_gender" value="Female" <?php if ($ustu_gender == 'Female') {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>Female</label>

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email</label>
                                            <input name="stu_email" type="email" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $ustu_email . "'"; ?>>
                                        </div>



                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Address</label>
                                            <textarea name="stu_address" class="form-control" id="exampleFormControlTextarea1" rows="2"><?php echo $ustu_address; ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Standard</label>
                                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="stu_std">
                                                <option disabled>Select Current Standard</option>
                                                <option value=<?php echo $ustu_std; ?>><?php echo $ustu_std; ?></option>
                                                <?php
                                                $sql = "SELECT * FROM classroom";
                                                $result = $auth->conn->query($sql);
                                                $rows = $result->fetchAll();
                                                if ($rows) {
                                                    // output data of each row
                                                    foreach ($rows as $row) {
                                                        $std = $row['c_name'] . " " . $row['c_division'];
                                                        if ($ustu_std == $std) {
                                                            continue;
                                                        } else {
                                                            echo "<option value='" . $row["c_name"] ." " . $row["c_division"]."' >" . $row["c_name"] . " " . $row["c_division"]  . "</option>";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Update Student</button>
                                    </div>
                                </form>

                                <?php

                                if (isset($_POST['submit'])) {
                                    $ustu_fname = $_POST['stu_fname'];
                                    $ustu_mname = $_POST['stu_mname'];
                                    $ustu_lname = $_POST['stu_lname'];
                                    $ustu_dob = date_format(new DateTime($_POST['stu_dob']), 'Y-m-d');
                                    $ustu_doj = date_format(new DateTime($_POST['stu_doj']), 'Y-m-d');
                                    $ustu_gender = $_POST['stu_gender'];
                                    $ustu_email = $_POST['stu_email'];
                                    $ustu_address = $_POST['stu_address'];
                                    $ustu_std = $_POST['stu_std'];





                                    try {

                                        $sql = "UPDATE student set stu_fname='" . $ustu_fname . "',stu_mname='" . $ustu_mname . "',stu_lname='" . $ustu_lname . "',stu_dob='" . $ustu_dob . "',stu_doj='" . $ustu_doj . "',stu_gender='" . $ustu_gender . "',stu_email='" . $ustu_email . "',stu_address='" . $ustu_address . "',stu_std='" . $ustu_std . "' where stu_id='".$_GET['update']."'";

                                        if ($auth->conn->query($sql)) {
                                            echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
                                        } else {
                                        }
                                    } catch (Exception $e) {
                                    }






                                    # code...
                                }

                                ?>
                            </div>
                        </div>


                    <?php } ?>

                    <div class="col-xs-8">


                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">All Students</h3>
                            </div>

                            <!-- /.box-header -->
                            <div class="box-body" style="overflow :scroll;">
                                <table  id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Full Name</th>
                                            <th>Date of Birth</th>
                                            <th>Date of Joining</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Current Standard</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php

                                        $sql = "SELECT * FROM student";
                                        $result = $auth->conn->query($sql);
                                        $rows = $result->fetchAll();
                                        if ($rows) {
                                            // output data of each row
                                            foreach ($rows as $row) {
                                                echo "<tr><td> " . $row["stu_id"] . " </td><td> " . $row["stu_fname"] . " ". $row["stu_mname"] . " " . $row["stu_lname"] . " </td><td> " . $row["stu_dob"] . "</td><td> " . $row["stu_doj"] . "</td><td>" . $row["stu_gender"] . "</td><td>" . $row["stu_email"] . "</td><td>" . $row["stu_address"] . "</td><td>" . $row["stu_std"] . "</td><td><a href='student.php?update=" . $row["stu_id"] . "'><small class='label  bg-orange'>Update</small></a></td></tr>";
                                            }
                                        }

                                        ?>


                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                    <!-- /.box -->



                </div>

                <!--------------------------
        | Your Page Content Here |
        -------------------------->

            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include_once './utilities/footer.php'; ?>

        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- Select2 -->
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- bootstrap color picker -->
    <script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page script -->

    <script>
        $(function() {
            // $('#example1').DataTable()
            $('#example1').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            })
        })
    </script>


    <script>
        $('.select2').select2()
        $('#datepicker').datepicker({
            autoclose: true
        });
        $('#datepicker1').datepicker({
            autoclose: true
        });



        var r = document.getElementById("new");
        r.className += "active";
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>