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


<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Class Room</title>
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
                    Class Room
                    <small>Class Room Details</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Class Room</a></li>
                    <li class="active">Details</li>
                </ol>
            </section>

            <!-- Main content -->


            <section class="content">

                <div class="row">
                    <div class="col-xs-4">



                        <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            New Class Room Successfully added
                        </div>






                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">New Class Room</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="POST">
                                <div class="box-body">




                                <div class="form-group">
                                        <label>Standard</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="c_name">
                                            <option disabled>Select Standard</option>
                                            <option value="UKG">UKG</option>
                                            <option value="LKG">LKG</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Class Division</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="c_division">
                                            <option disabled>Select Division</option>
                                            <option value="None">None</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Class Teacher</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="c_teacher">
                                            <option disabled>Selelct Class Teacher</option>
                                            <?php
                                            $sql = "SELECT * FROM teacher";
                                            $result = $auth->conn->query($sql);
                                            $rows = $result->fetchAll();
                                            if ($rows) {
                                                // output data of each row
                                                foreach($rows as $row) {
                                                    echo "<option value='" . $row["tid"] . "' >" . $row["tid"] . "  :  " . $row["fname"] . " " . $row["lname"]  . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Class Strength</label>
                                        <input name="c_strength" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Class Room Strength" required>
                                    </div>








                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Class Room</button>
                                </div>
                            </form>

                            <?php

                                          if (isset($_POST['submit'])) {
                                            $c_id = "CLASS-".rand(1,1000);
                                            $c_name = $_POST['c_name'];
                                            $c_division = $_POST['c_division'];
                                            $c_teacher = $_POST['c_teacher'];
                                            $c_strength = $_POST['c_strength'];

                                            if($c_division == 'None')
                                            {
                                                $c_division="";
                                            }


                                              try {




                                                $sql = "INSERT INTO classroom(c_id,c_name,c_division,c_teacher,c_strength) VALUES ( '".$c_id."', '".$c_name."','".$c_division."','".$c_teacher."','".$c_strength."')";

                                              if ($auth->conn->query($sql) === TRUE) {
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

                    <div class="col-xs-8">


                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">All Class Rooms</h3>
                            </div>

                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Class ID</th>
                                            <th>Standard</th>
                                            <th>Class Teacher</th>
                                            <th>Strength</th>


                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php

                                          $sql = "SELECT * FROM classroom";
                                          $result = $auth->conn->query($sql);
                                        $rows = $result->fetchAll();
                                          if ($rows) {
                                           // output data of each row
                                             foreach($rows as $row) {
                                              echo "<tr><td> " . $row["c_id"]. " </td><td> " . $row["c_name"]. " " . $row["c_division"]. "</td><td>" . $row["c_teacher"]. "</td><td>" . $row["c_strength"]. "</td></tr>";
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



        var r = document.getElementById("class");
        r.className += "active";
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>