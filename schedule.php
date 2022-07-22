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
$flag = 0;
if (isset($_POST['preview'])) {

    $showTT = $_POST['stdTimeTable'];

    $sql = "select * from schedule where standard='$showTT'";
    $result = $auth->conn->query($sql);
    $rows = $result->fetchAll();

    if ($rows) {
        // output data of each row
        foreach ($rows as $row) {
            $_SESSION['pdf'] = $row['timetable'];
            $flag = 1;
        }
    }
} ?>



<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Schedule</title>
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
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .overlay {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 999;

            background: rgba(255, 255, 255, 0.8);
        }
    </style>

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
                    Schedule
                    <small>Schedule Details</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Schedule</a></li>
                    <li class="active">Details</li>
                </ol>
            </section>

            <!-- Main content -->


            <section class="content">
                <div id="overlay" class="overlay">
                    <button id="overlay-close" class="btn btn-sm btn-danger" style="position:absolute;top:10%;left:81%">X</button>
                    <div id="close_overlay" style="position:absolute;top:10%;left:21%">
                        <iframe src='./class_timetables/<?php echo $_SESSION['pdf']; ?>' height="600" width="900" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">



                        <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            New Schedule Successfully added
                        </div>






                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">New Schedule</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <div class="box-body">



                                    <div class="form-group">
                                        <label>Standard</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="standard">
                                            <option disabled selected>Select Standard</option>
                                            <?php
                                            $sql = "SELECT * FROM classroom";
                                            $result = $auth->conn->query($sql);
                                            $rows = $result->fetchAll();

                                            if ($rows) {
                                                // output data of each row
                                                foreach ($rows as $row) {
                                                    echo "<option value='" . $row["c_id"] . "' >" . $row["c_name"] . " " . $row["c_division"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Class Teacher</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="class_teacher">
                                            <option disabled selected>Select Class Teacher</option>
                                            <?php
                                            $sql = "SELECT * FROM teacher";
                                            $result = $auth->conn->query($sql);
                                            $rows = $result->fetchAll();

                                            if ($rows) {
                                                // output data of each row
                                                foreach ($rows as $row) {
                                                    echo "<option value='" . $row["tid"] . "' >" . $row["fname"] . " " . $row["lname"] . "_ID:" . $row["tid"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Upload Time Table</label><br>
                                            <small style="color: red;">Note: Upload Time Table you generated here!</small>

                                            <input name="timetable" id="timetable" type="file" class="form-control" id="exampleInputPassword1" required>
                                        </div>
                                    </div>




                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Schedule</button>
                                </div>
                            </form>

                            <?php

                            if (isset($_POST['submit'])) {
                                $standard = $_POST['standard'];
                                $class_teacher = $_POST['class_teacher'];
                                $timetable = $_FILES['timetable']['name'];
                                $tmp_timetable = $_FILES['timetable']['tmp_name'];

                                try {




                                    $sql = "INSERT INTO schedule (standard,class_teacher,timetable) VALUES ('" . $standard . "', '" . $class_teacher . "', '" . time() . $timetable . "')";
                                    $path = './class_timetables/' . time() . $timetable;

                                    if ($auth->conn->query($sql)) {

                                        move_uploaded_file($tmp_timetable, $path);
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


                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Enter No. of Peroids</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="POST">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">No of Period</label>
                                        <input name="period" id="period" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter no of period" required>
                                    </div>

                                </div>
                                <div class="box-footer">
                                    <button type="button" name="generate" id="generate" value="submit" class="btn btn-primary">Generate</button>
                                </div>
                            </form>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Available Time Tables</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <form role="form" method="POST">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Standard</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="stdTimeTable">
                                            <option disabled selected>Select Standard</option>
                                            <?php
                                            $sql = "SELECT * FROM classroom where c_id in (select standard from schedule)";
                                            $result = $auth->conn->query($sql);
                                            $rows = $result->fetchAll();

                                            if ($rows) {
                                                // output data of each row
                                                foreach ($rows as $row) {
                                                    echo "<option value='" . $row["c_id"] . "' >" . $row["c_name"] . " " . $row["c_division"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" name="preview" id="preview" class="btn btn-primary">Preview</button>
                                </div>
                            </form>






                        </div>

                    </div>




                    <div class="col-xs-8">


                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Create Time Table</h3>
                            </div>


                            <section id="generate_tt" class="ftco-section" style="overflow: scroll;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="text-center mb-4">Class Schedule Table</h4>
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Time</th>
                                                            <th>Monday</th>
                                                            <th>Tuesday</th>
                                                            <th>Wednesday</th>
                                                            <th>Thursday</th>
                                                            <th>Friday</th>
                                                            <th>Saturday</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <div class="box-footer" style="text-align: center;">
                                <button type="button" name="print" id="print" onclick="printDiv('generate_tt')" value="" class="btn btn-primary">Print</button>
                            </div>


                        </div>



                    </div>
                    <!-- /.box -->



                </div>

                <!--------------------------
        | Your Page Content Here |
        -------------------------->


            </section>
            <?php
            if ($flag) {
                echo "<script type='text/javascript'> var x = document.getElementById('overlay');

        x.style.display='block';</script>";
            }

            ?>

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
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

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

        document.getElementById('overlay-close').addEventListener('click',function(){
            document.getElementById('overlay').style.display = 'none';
        })
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        $('.select2').select2()
        $('#datepicker').datepicker({
            autoclose: true
        });



        var r = document.getElementById("schedule");
        r.className += "active";



        $('.timepicker').timepicker({
            showInputs: false
        })

        $('#generate').click(function() {
            var period = $('#period').val();

            for (var i = 0; i < parseInt(period); i++) {
                $('#tbody').append(`<tr style='height:100px' id=${'row'+i}>`)
                for (var j = 0; j < 7; j++) {
                    $(`#row${i}`).append(`<td style='vertical-align: middle; font-size: 18px;' contenteditable='true'></td>`)
                }
                $('#tbody').append('</tr>');
            }
        });
    </script>



    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>