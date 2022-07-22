<?php session_start();


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

$p_id = $p_fname = $p_lname = $p_adhar = $p_address = $p_contact  = $p_job = $p_gender = $p_email = $p_son = " ";


if (isset($_GET['update'])) {
    $update = "SELECT * FROM parent WHERE p_id='" . $_GET['update'] . "'";
    $result = $auth->conn->query($update);
    $rows = $result->fetchAll();

   
    if ($rows) {
        // output data of each row
        foreach ($rows as $row) {
            $p_id = $row['p_id'];
            $p_fname = $row['p_fname'];
            $p_lname = $row['p_lname'];
            $p_adhar = $row['p_adhar'];
            $p_gender = $row['p_gender'];
            $p_address = $row['p_address'];
            $p_contact = $row['p_contact'];
            $p_email = $row['p_email'];
            $p_job = $row['p_job'];
            $p_son = $row['p_son'];
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
    <title>Parent</title>
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
                    Parent
                    <small>Parent Details</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Parent</a></li>
                    <li class="active">Details</li>
                </ol>
            </section>

            <!-- Main content -->


            <section class="content">

                <div class="row">




                    <?php if (!isset($_GET['update'])) { ?>
                        <div class="col-xs-4">



                            <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                New Parent Successfully added
                            </div>






                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">New Parent</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST">
                                    <div class="box-body">



                                        <div class="form-group">
                                            <label for="exampleInputPassword1">First Name</label>
                                            <input name="p_fname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Parent First Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Last Name</label>
                                            <input name="p_lname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Parent Last Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Adhar Card No.</label>
                                            <input name="p_adhar" type="text" minlength="12" maxlength="12" class="form-control" id="exampleInputPassword1" placeholder="Enter Parent Adhar Card No." required>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Gender</label>
                                            <div class="radio ">
                                                <label style="width: 100px"><input type="radio" name="p_gender" value="Male" checked>Male</label>
                                                <label style="width: 100px"><input type="radio" name="p_gender" value="Female" checked>Female</label>

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Address</label>
                                            <textarea name="p_address" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email ID.</label>
                                            <input name="p_email" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Parent Email Id." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Contact</label>
                                            <input name="p_contact" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Parent Contact No" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Occupation</label>
                                            <input name="p_job" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Parent Occupation" required>
                                        </div>


                                        <div class="form-group">
                                            <label>Student</label>
                                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="p_son">
                                                <option disabled selected>Select Student</option>
                                                <?php
                                                $sql = "SELECT * FROM student";
                                                $result = $auth->conn->query($sql);
                                                $rows = $result->fetchAll();
                                                if ($rows) {
                                                    // output data of each row
                                                    foreach ($rows as $row) {
                                                        echo "<option value='" . $row["stu_id"] . "' >" . $row["stu_id"] . " : " . $row["stu_fname"] .  " " . $row['stu_mname'] . " " . $row['stu_lname'] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>




                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Parent</button>
                                    </div>
                                </form>

                                <?php

                                if (isset($_POST['submit'])) {
                                    $p_id = "PAR-" . rand(1, 100000);
                                    $p_fname = $_POST['p_fname'];
                                    $p_lname = $_POST['p_lname'];
                                    $p_adhar = $_POST['p_adhar'];
                                    $p_gender = $_POST['p_gender'];
                                    $p_address = $_POST['p_address'];
                                    $p_contact = $_POST['p_contact'];
                                    $p_email = $_POST['p_email'];
                                    $p_job = $_POST['p_job'];
                                    $p_son = $_POST['p_son'];
                                    $p_pass = "Par@" . $p_fname . "123";



                                    try {




                                        $sql = "INSERT INTO parent (p_id,p_fname,p_lname,p_adhar,p_gender,p_address,p_email,p_contact,p_job,p_son,p_pass) VALUES ( '" . $p_id . "', '" . $p_fname . "','" . $p_lname . "','" . $p_adhar . "','" . $p_gender . "','" . $p_address . "','" . $p_email . "','" . $p_contact . "','" . $p_job . "','" . $p_son . "','" . $p_pass . "')";

                                        if ($auth->conn->query($sql)) {

                                            $to = $p_email;


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
                                  Username : {$p_email} <br/>
                                  Password : {$p_pass} <br/>  
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
                        </div>

                    <?php } elseif (isset($_GET['update'])) { ?>


                        <div class="col-xs-4">



                            <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                Update Parent Successfully added
                            </div>






                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Update Parent</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST">
                                    <div class="box-body">



                                        <div class="form-group">
                                            <label for="exampleInputPassword1">First Name</label>
                                            <input name="p_fname" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $p_fname . "'"; ?>>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Last Name</label>
                                            <input name="p_lname" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $p_lname . "'"; ?>>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">National Identity Card</label>
                                            <input name="p_adhar" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $p_adhar . "'"; ?>>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Gender</label>
                                            <div class="radio ">
                                                <label style="width: 100px"><input type="radio" name="p_gender" value="Male" <?php if ($p_gender == 'Male') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>Male</label>
                                                <label style="width: 100px"><input type="radio" name="p_gender" value="Female" <?php if ($p_gender == 'Female') {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>Female</label>

                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email</label>
                                            <input name="p_email" type="email" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $p_email . "'"; ?>>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Address</label>
                                            <textarea name="p_address" class="form-control" id="exampleFormControlTextarea1" rows="2"><?php echo $p_address; ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Contact</label>
                                            <input name="p_contact" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $p_contact . "'"; ?>>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Occupation</label>
                                            <input name="p_job" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $p_job . "'"; ?>>
                                        </div>

                                        <div class="form-group">
                                            <label>Student</label>
                                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="p_son">
                                                <option disabled>Select Student</option>
                                                <!-- <option value=<?php echo $p_son; ?>><?php echo $p_son; ?></option> -->
                                                <?php
                                                $sql = "SELECT * FROM student";
                                                $result = $auth->conn->query($sql);
                                                $rows = $result->fetchAll();
                                                $option = '';
                                                if ($rows) {
                                                    // output data of each row
                                                    foreach ($rows as $row) {
                                                        
                                                        if ($p_son == $row['p_son']) {
                                                            $option .= "<option value='" . $row["stu_id"] . "' >" . $row["stu_id"] . " : " . $row["stu_fname"] .  " " . $row['stu_mname'] . " " . $row['stu_lname'] . "</option>"; 
                                                        } else {
                                                            $option .= "<option value='" . $row["stu_id"] . "' >" . $row["stu_id"] . " : " . $row["stu_fname"] .  " " . $row['stu_mname'] . " " . $row['stu_lname'] . "</option>";
                                                        }
                                                        
                                                    }

                                                    echo $option;

                                                    
                                                }
                                                ?>
                                            </select>
                                        </div>



                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Update Parent</button>
                                    </div>
                                </form>

                                <?php

                                if (isset($_POST['submit'])) {
                                    $p_fname = $_POST['p_fname'];
                                    $p_lname = $_POST['p_lname'];
                                    $p_adhar = $_POST['p_adhar'];
                                    $p_gender = $_POST['p_gender'];
                                    $p_address = $_POST['p_address'];
                                    $p_contact = $_POST['p_contact'];
                                    $p_email = $_POST['p_email'];
                                    $p_job = $_POST['p_job'];
                                    $p_son = $_POST['p_son'];



                                    try {


                                        $sql = "UPDATE parent set p_fname='" . $p_fname . "',p_lname='" . $p_lname . "',p_adhar='" . $p_adhar . "',p_gender='" . $p_gender . "',p_address='" . $p_address . "',p_contact='" . $p_contact . "',p_email='" . $p_email . "',p_job='" . $p_job . "',p_son='" . $p_son . "' where p_id='".$p_id."'";

                                       
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
                                <h3 class="box-title">All Parents</h3>
                            </div>

                            <!-- /.box-header -->
                            <div class="box-body" style="overflow :scroll;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Parent ID</th>
                                            <th>Full Name</th>
                                            <th>Email Id.</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Occupation</th>
                                            <th>Parent Of</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php

                                        $sql = "SELECT * FROM parent";
                                        $result = $auth->conn->query($sql);
                                        $rows = $result->fetchAll();
                                        if ($rows) {
                                            // output data of each row
                                            foreach ($rows as $row) {
                                                echo "<tr><td> " . $row["p_id"] . " </td><td> " . $row["p_fname"] . " " . $row["p_lname"] . " </td><td> " . $row["p_email"] . "</td><td>" . $row["p_gender"] . "</td><td>" . $row["p_address"] . "</td><td>" . $row["p_contact"] . "</td><td>" . $row["p_job"] . "</td><td>" . $row["p_son"] . "</td><td><a href='parent.php?update=" . $row["p_id"] . "'><small class='label  bg-orange'>Update</small></a></td></tr>";
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
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>


    <script>
        $('.select2').select2()
        $('#datepicker').datepicker({
            autoclose: true
        });



        var r = document.getElementById("parent");
        r.className += "active";
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>