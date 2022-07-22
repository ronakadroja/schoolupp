<?php session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'teacher') {
    # code...
    header('Location:../logout.php');
}
?>
<?php

include_once '../auth/config.php';
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
    <title>Marks Entry</title>
    <link href="https://play-lh.googleusercontent.com/INY4vfQNUb6DmvSAmEDqcZAJzYbDkPa9WORf0AdZMeJQDBXkPeQypC-25Cl1Rc1XLzA" type="image/png" rel="icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, Notice-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>

</head>



<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <?php include_once '../utilities/header.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include_once '../utilities/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Marks Entry
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Marks Entry</a></li>
                    <li class="active">Details</li>
                </ol>
            </section>

            <!-- Main content -->


            <section class="content">

                <div class="row">

                    <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        Marks Addrd Successfully !
                    </div>

                    <div class="col-xs-12">
                        <form method="post">



                            <div id="mark_att" class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Student's Marks Entry</h3>
                                </div>


                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Standard</label>
                                                <select id="standard" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="standard">
                                                    <option disabled selected>Select Standard for Marks Entry</option>
                                                    <?php
                                                    $sql = "select * from subject where sub_teacher in (select tid from teacher where email = '" . $_SESSION['email'] . "' )";
                                                    $result = $auth->conn->query($sql);
                                                    $rows = $result->fetchAll();
                                                    if ($rows) {
                                                        foreach ($rows as $row) { ?>
                                                            <option <?php if (isset($_POST['standard'])) {
                                                                        if ($_POST['standard'] == $row['sub_standard']) {
                                                                            echo "selected";
                                                                        }
                                                                    } ?> value='<?php echo $row["sub_standard"]; ?>'><?php echo $row["sub_standard"]; ?></option>;
                                                    <?php }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Subject</label>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="subject">
                                                    <option disabled selected>Select Subject for Marks Entry</option>
                                                    <?php
                                                    $sql = "select * from subject where sub_teacher in (select tid from teacher where email = '" . $_SESSION['email'] . "' )";
                                                    $result = $auth->conn->query($sql);
                                                    $rows = $result->fetchAll();
                                                    if ($rows) {
                                                        // output data of each row
                                                        foreach ($rows as $row) { ?>
                                                            <option <?php if (isset($_POST['subject'])) {
                                                                        if ($_POST['subject'] == $row['sub_name']) {
                                                                            echo "selected";
                                                                        }
                                                                    } ?> value='<?php echo $row["sub_name"]; ?>'><?php echo $row["sub_name"]; ?></option>;
                                                    <?php }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">

                                                <label>Exam Date</label>

                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name='exam_date' value="<?php if (isset($_POST['exam_date'])) {
                                                                                                    echo $_POST['exam_date'];
                                                                                                } ?>" class="form-control pull-right" id="datepicker" placeholder="Select Exam Date">
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Exam Type</label>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="exam_type">
                                                    <option disabled selected>Select Exam Type</option>
                                                    <option value="classtest" <?php if (isset($_POST['exam_type'])) {
                                                                                    if ($_POST['exam_type'] == 'classtest') {
                                                                                        echo "selected";
                                                                                    }
                                                                                } ?>>Class Test</option>
                                                    <option value="endsem" <?php if (isset($_POST['exam_type'])) {
                                                                                if ($_POST['exam_type'] == 'endsem') {
                                                                                    echo "selected";
                                                                                }
                                                                            } ?>>End Semester</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Total Marks</label>
                                                <input name="total_marks" type="number" value="<?php if (isset($_POST['total_marks'])) {
                                                                                                    echo $_POST['total_marks'];
                                                                                                } ?>" class="form-control" id="total_marks" placeholder="Enter Total Marks" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <button type="submit" style="margin-top:25px" id="search" name="search" value="search" class="btn btn-primary">Search Students</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <!-- /.box-header -->
                                <div class="box-body" style=" display: flex; justify-content: center;">
                                    <!-- <form id="attendance" action="" method="post"> -->
                                    <table class="styled-table" style="overflow-y :scroll;">
                                        <thead>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Name</th>
                                                <th>Mark Out of <?php if (isset($_POST['total_marks'])) {
                                                                    echo $_POST['total_marks'];
                                                                } ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            if (isset($_POST['search'])) {



                                                $sql = "select * from student where stu_std in (select sub_standard from subject where sub_teacher in (select tid from teacher where email = '" . $_SESSION['email'] . "') and sub_standard = '{$_POST['standard']}') order by stu_lname";

                                                $result = $auth->conn->query($sql);
                                                $r = $result->fetchAll();



                                                if ($r) {
                                                    $count = 1;
                                                    foreach ($r as $row) {

                                                        echo "<tr><td>{$count}</td><td>" . $row['stu_lname'] . " " . $row['stu_fname'] . " " . $row['stu_mname'] . "</td><td><input type='number' placeholder='Enter Marks' name='{$row['stu_id']}' /></td></tr>";
                                                        $count++;
                                                    }
                                                }
                                            }

                                            if (isset($_POST['submit'])) {

                                                $sql = "select * from student where stu_std in (select sub_standard from subject where sub_teacher in (select tid from teacher where email = '" . $_SESSION['email'] . "') and sub_standard = '{$_POST['standard']}') order by stu_lname";

                                                $result = $auth->conn->query($sql);
                                                $r = $result->fetchAll();
                                                if ($r) {

                                                    foreach ($r as $row) {
                                                        $sql = "INSERT INTO marks_entry(standard,subject,exam_type,exam_date,stu_id,total_marks,obt_marks) VALUES";

                                                        $sql .= "('" . $_POST['standard'] . "','" . $_POST['subject'] . "','" . $_POST['exam_type'] . "','" . date_format(new DateTime($_POST['exam_date']), 'd/m/Y') . "','" . $row['stu_id'] . "','" . $_POST['total_marks'] . "','" . $_POST[$row['stu_id']] . "')";

                                                        $result = $auth->conn->query($sql);
                                                        if ($result) {
                                                            echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
                                                        x.style.display='block';
                                                        setTimeout(()=>{ x.style.display='none'; },2000);
                                                        </script>";
                                                        }
                                                    }
                                                }
                                                else{
                                                    echo "<tr><td colspan='6'>No Data Available</td></tr>";
                                                }
                                            }





                                            ?>


                                            <!-- and so on... -->
                                        </tbody>


                                    </table>
                                    <!-- </form> -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: center;">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit Marks</button>
                                </div>
                            </div>



                        </form>
                    </div>


                </div>

                <!--------------------------
        | Your Page Content Here |
        -------------------------->

            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include_once '../utilities/footer.php'; ?>


        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ../wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- Select2 -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


    <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <!-- bootstrap color picker -->
    <script src="../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page script -->

    <script>
        // document.getElementById('preview').addEventListener('click',function(event){
        //     event.preventDefault();

        //     document.getElementById('pre_att').style.display='block';
        // })
        document.getElementById('close').addEventListener('click', function(event) {
            event.preventDefault();

            document.getElementById('pre_att').style.display = 'none';
        })

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



        var r = document.getElementById("tea_marks");
        r.className += "active";



        $('.timepicker').timepicker({
            showInputs: false
        })
    </script>



    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     Notice experience. -->
</body>

</html>