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



$tid = $fname = $lname = $address = $contact = $dob = $skill = $gender = $email = " ";


if (isset($_GET['update'])) {
  $update = "SELECT * FROM teacher WHERE tid='" . $_GET['update'] . "'";
  $result = $auth->conn->query($update);
  $rows = $result->fetchAll();
  if ($rows) {
    // output data of each row
    foreach ($rows as $row) {
      $tid = $row['tid'];
      $fname = $row['fname'];
      $lname = $row['lname'];
      $contact = $row['contact'];
      $skill = $row['skill'];
      $dob = date_format(new DateTime($row['bday']), 'm/d/Y');
      //echo $dob;
      $gender = $row['gender'];
      $address = $row['address'];
      $email = $row['email'];
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
  <title>Teacher</title>
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
          Teacher
          <small>Teacher Details</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
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
                New Teacher Successfully added
              </div>

              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">New Teacher</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="exampleInputPassword1">First Name</label>
                      <input name="fname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Teacher First Name" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Last Name</label>
                      <input name="lname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Teacher Last Name" required>
                    </div>

                    <div class="form-group">

                      <label>Date of Birth</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name='dob' class="form-control pull-right" id="datepicker" placeholder="Select Teacher's Data of Birth">
                      </div>
                      <!-- /.input group -->

                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Gender</label>
                      <div class="radio ">
                        <label style="width: 100px"><input type="radio" name="gender" value="Male" checked>Male</label>
                        <label style="width: 100px"><input type="radio" name="gender" value="Female" checked>Female</label>

                      </div>

                    </div>


                    <div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
                      <input name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter Teacher email" required>
                    </div>


                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Address</label>
                      <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Contact</label>
                      <input name="contact" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Teacher Contact No" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Skills</label>
                      <textarea name="skill" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>






                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Teacher</button>
                  </div>
                </form>

                <?php

                if (isset($_POST['submit'])) {
                  $tid = "TEACHER-" . rand(1, 1000);
                  $fname = $_POST['fname'];
                  $lname = $_POST['lname'];

                  $dob = date_format(new DateTime($_POST['dob']), 'Y-m-d');
                  //echo $dob;
                  $gender = $_POST['gender'];
                  $address = $_POST['address'];

                  $skill = $_POST['skill'];
                  $email = $_POST['email'];
                  $contact = $_POST['contact'];



                  try {




                    $sql = "INSERT INTO teacher (tid,fname,lname,bday,address,gender,skill,contact,email,password) VALUES ('" . $tid . "', '" . $fname . "', '" . $lname . "','" . $dob . "','" . $address . "','" . $gender . "','" . $skill . "','" . $contact . "','" . $email . "','" . $fname."123" . "')";

                    if ($auth->conn->query($sql)) {

                      $to = $email;


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
            Username : {$email} <br/>
            Password : Tea@{$fname}123 <br/>  
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

                      echo '*************************************************************************';
                      $header = "From:ssiphostel2425@gmail.com \r\n";
                      $header .= "MIME-Version: 1.0\r\n";
                      $header .= "Content-type: text/html\r\n";

                      $retval = mail($to, $subject, $message, $header);

                      if($retval)
                      {
                        
                        echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
  x.style.display='block';</script>";
                      }
                      else{
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
                Teacher Update Successfully
              </div>

              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Teacher</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="exampleInputPassword1">Teacher ID</label>
                      <input name="sid" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $tid . "'"; ?>>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">First Name</label>
                      <input name="fname" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $fname . "'"; ?>>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Last Name</label>
                      <input name="lname" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $lname . "'"; ?>>
                    </div>

                    <div class="form-group">

                      <label>Date of Birth</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name='dob' class="form-control pull-right" id="datepicker" value=<?php echo "'" . $dob . "'"; ?>>
                      </div>
                      <!-- /.input group -->

                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Gender</label>
                      <div class="radio ">
                        <label style="width: 100px"><input type="radio" name="gender" value="Male" <?php if ($gender == 'Male') {
                                                                                                      echo 'checked';
                                                                                                    } ?>>Male</label>
                        <label style="width: 100px"><input type="radio" name="gender" value="Female" <?php if ($gender == 'Female') {
                                                                                                        echo 'checked';
                                                                                                      } ?>>Female</label>

                      </div>

                    </div>


                    <div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
                      <input name="email" type="email" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $email . "'"; ?>>
                    </div>


                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Address</label>
                      <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="2"><?php echo $address; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Contact</label>
                      <input name="contact" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'" . $contact . "'"; ?>>
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Skills</label>
                      <textarea name="skill" class="form-control" id="exampleFormControlTextarea1" rows="2"><?php echo $skill; ?></textarea>
                    </div>






                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Update Teacher</button>
                  </div>
                </form>

                <?php

                if (isset($_POST['submit'])) {
                  $tid = $_POST['sid'];
                  $fname = $_POST['fname'];
                  $lname = $_POST['lname'];
                  $email = $_POST['email'];
                  $dob = date_format(new DateTime($_POST['dob']), 'Y-m-d');
                  //echo $dob;
                  $gender = $_POST['gender'];
                  $address = $_POST['address'];

                  $skill = $_POST['skill'];

                  $contact = $_POST['contact'];



                  try {


                    $sql = "UPDATE teacher SET fname='" . $fname . "',lname='" . $lname . "',bday='" . $dob . "',address='" . $address . "',gender='" . $gender . "',skill='" . $skill . "',contact='" . $contact . "',email='" . $email . "' WHERE tid = '" . $tid . "'";

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
                <h3 class="box-title">All Teachers</h3>
              </div>

              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Teacher ID</th>
                      <th>Full Name</th>
                      <th>Date of Birth</th>
                      <th>Gender</th>
                      <th>Address</th>
                      <th>Contact</th>
                      <th>Skills</th>
                      <th>Actions</th>

                    </tr>
                  </thead>
                  <tbody>


                    <?php

                    $sql = "SELECT * FROM teacher";
                    $result = $auth->conn->query($sql);
                    $rows = $result->fetchAll();
                    if ($rows) {
                      // output data of each row
                      foreach ($rows as $row) {
                        echo "<tr><td> " . $row["tid"] . " </td><td> " . $row["fname"] . " " . $row["lname"] . " </td><td> " . $row["bday"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["address"] . "</td><td>" . $row["contact"] . "</td><td>" . $row["skill"] . "</td><td><a href='teacher.php?update=" . $row["tid"] . "'><small class='label  bg-orange'>Update</small></a></td></tr>";
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



    var r = document.getElementById("teacher");
    r.className += "active";
  </script>
  <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>