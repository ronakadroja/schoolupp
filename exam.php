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
    <title>Exam</title>
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
                    Exam
                    <small>Exam Details</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Exam</a></li>
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
                            New Schedule Successfully added
                        </div>






                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">New Exam Time Table</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label>Exam Type</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="exam_type">
                                            <option disabled selected>Select Exam Type</option>
                                            <option value="classtest">Class Test</option>
                                            <option value="endsem">End Semester</option>
                                        </select>
                                    </div>

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
                                                    echo "<option value='" . $row["c_name"] ." " . $row["c_division"]."' >" . $row["c_name"] . " " . $row["c_division"]  . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <div class="form-group">

                                        <label>Start of Exam</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name='start_exam' class="form-control pull-right" id="datepicker" placeholder="Select Starting Date">
                                        </div>
                                        <!-- /.input group -->

                                    </div>

                                    <div class="form-group">

                                        <label>End of Exam</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name='end_exam' class="form-control pull-right" id="datepicker1" placeholder="Select End Date">
                                        </div>
                                        <!-- /.input group -->

                                    </div>


                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Upload Time Table</label><br>
                                            <small style="color: red;">Note: Upload Time Table you generated here!</small>

                                            <input name="exam_tt" id="timetable" type="file" class="form-control" id="exampleInputPassword1" required>
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
                                $exam_type = $_POST['exam_type'];
                                $standard = $_POST['standard'];
                                $start_exam = date_format(new DateTime($_POST['start_exam']), 'Y-m-d');
                                $end_exam = date_format(new DateTime($_POST['end_exam']), 'Y-m-d');
                                $tmp_tt = $_FILES['exam_tt']['tmp_name'];
                                $exam_tt = $_FILES['exam_tt']['name'];

                                try {




                                    $sql = "INSERT INTO exam (exam_type,standard,start_exam,end_exam,exam_tt) VALUES ('" . $exam_type . "','" . $standard . "', '" . $start_exam . "', '" . $end_exam . "', '" . time() . $exam_tt . "')";
                                    $path = './exam_timetables/' . time() . $exam_tt;

                                    if ($auth->conn->query($sql)) {

                                        move_uploaded_file($tmp_tt, $path);
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
                                <h3 class="box-title">No. of Subjects</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="POST">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Enter no. of Subjects</label>
                                        <input name="exam_sub" type="text" class="form-control" id="exam_sub" placeholder="Enter no of subject" required>
                                    </div>

                                </div>
                                <div class="box-footer">
                                    <button type="button" name="generate" id="generate" value="submit" class="btn btn-primary">Generate</button>
                                </div>
                            </form>
                        </div>


                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Available Exam Schedule</h3>
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
                                            $sql = "SELECT * FROM classroom where CONCAT(c_name,' ',c_division) in (select standard from exam)";
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
                                <div class="box-footer">
                                    <button type="submit" name="preview" id="preview" class="btn btn-primary">Preview</button>
                                </div>
                            </form>






                        </div>

                    </div>




                    <div class="col-xs-8">


                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Create Exam Time Table</h3>
                            </div>


                            <section id="generate_tt" class="ftco-section">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="text-center mb-4">Class Schedule Table</h4>
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Subject</th>
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

                        <div id="exam-tt" class="box box-primary" >
                            <div class="box-header with-border">
                                <h3 class="box-title">Exam History</h3>
                            </div>


                            <section id="history_tt" class="ftco-section" style="overflow: scroll;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Exam Type</th>
                                                            <th>Standard</th>
                                                            <th>Start Exam</th>
                                                            <th>End Exam</th>
                                                            <th>Time Table</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        <?php
                                                        if (isset($_POST['preview'])) {

                                                            $showTT = $_POST['stdTimeTable'];
                                                            
                                                            $sql = "select * from exam where standard='$showTT'";
                                                            $result = $auth->conn->query($sql);
                                                            $tt = $result->fetchAll();
                                                        
                                                            if ($tt) {
                                                                // output data of each row
                                                                foreach ($tt as $row) {
                                                                    echo "<tr><td> " . $row["exam_type"] . " </td><td> " . $row["standard"] . " </td><td>". $row["start_exam"] . "</td><td> " . $row["end_exam"] . " </td><td><a href='http://localhost/SMS/exam_timetables/{$row['exam_tt']}' target='_blank'><small class='label  bg-orange'>Preview</small></a></td></tr>";
                                                                }
                                                            }
                                                        }
                                                        
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>


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

        // document.getElementById('preview').addEventListener('click',function(){
        //         document.getElementById('exam-tt').style.display='block';
        // });

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
        $('#datepicker1').datepicker({
            autoclose: true
        });



        var r = document.getElementById("exam");
        r.className += "active";



        $('.timepicker').timepicker({
            showInputs: false
        })

        $('#generate').click(function() {
            var period = $('#exam_sub').val();

            for (var i = 0; i < parseInt(period); i++) {
                $('#tbody').append(`<tr style='height:100px' id=${'row'+i}>`)
                for (var j = 0; j < 3; j++) {
                    $(`#row${i}`).append(`<td style='vertical-align: middle;width:100px; font-size: 18px;' contenteditable='true'></td>`)
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