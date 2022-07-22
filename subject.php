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

$sub_id = $sub_standard = $sub_name = $sub_teacher = " ";


if (isset($_GET['update'])) {
    $update = "SELECT * FROM subject WHERE sub_id='" . $_GET['update'] . "'";
    $result = $auth->conn->query($update);
    $rows = $result->fetchAll();
    if ($rows) {
        // output data of each row
        foreach ($rows as $row) {
            $sub_id = $row['sub_id'];
            $sub_standard = $row['sub_standard'];
            $sub_name = $row['sub_name'];
            $sub_teacher = $row['sub_teacher'];
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
    <title>Subject</title>
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
                    Subject
                    <small>Subject Details</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Subject</a></li>
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
                                New Subject Successfully added
                            </div>






                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">New Subject</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label>Standard</label>
                                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="sub_standard">
                                                <option selected disabled>Select Standard</option>
                                                <?php
                                                $sql = "SELECT * FROM classroom";
                                                $result = $auth->conn->query($sql);
                                                $rows = $result->fetchAll();
                                                if ($rows) {
                                                    // output data of each row
                                                    foreach ($rows as $row) {
                                                        echo "<option value='" . $row["c_name"] . " " . $row["c_division"] . "' >" . $row["c_name"] . " " . $row["c_division"]  . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Subject Name</label>
                                            <input name="sub_name" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Subject Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Subject Teacher</label>
                                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="sub_teacher">
                                                <option selected disabled>Select Subject Teacher</option>
                                                <?php
                                                $sql = "SELECT * FROM teacher";
                                                $result = $auth->conn->query($sql);
                                                $rows = $result->fetchAll();
                                                if ($rows) {
                                                    // output data of each row
                                                    foreach ($rows as $row) {
                                                        echo "<option value='" . $row["tid"] . "' >" . $row["tid"] . "  :  " . $row["fname"] . " " . $row["lname"]  . "</option>";
                                                    }

                                                    $sql = "select * from subject where ";
                                                }
                                                ?>
                                            </select>
                                        </div>




                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Subject</button>
                                    </div>
                                </form>

                                <?php

                                if (isset($_POST['submit'])) {
                                    $sub_id = "SUB-" . rand(1, 1000);
                                    $sub_standard = $_POST['sub_standard'];
                                    $sub_name = $_POST['sub_name'];
                                    $sub_teacher = $_POST['sub_teacher'];




                                    try {




                                        $sql = "INSERT INTO subject (sub_id,sub_standard,sub_name,sub_teacher) VALUES ( '" . $sub_id . "', '" . $sub_standard . "','" . $sub_name . "', '" . $sub_teacher . "')";

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

                    <?php } elseif (isset($_GET['update'])) { ?>


                        <div class="col-xs-4">



                            <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                Subject Updated Successfully
                            </div>






                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Update Subject</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST">
                                    <div class="box-body">



                                        <div class="form-group">
                                            <label>Standard</label>
                                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="sub_standard">
                                                <option disabled>Select Standard</option>
                                                <option value=<?php echo $sub_standard; ?>><?php echo $sub_standard; ?></option>
                                                <?php
                                                $sql = "SELECT * FROM classroom";
                                                $result = $auth->conn->query($sql);
                                                $rows = $result->fetchAll();
                                                if ($rows) {
                                                    // output data of each row
                                                    foreach ($rows as $row) {
                                                        $std = $row['c_name'] . " " . $row['c_division'];
                                                        if ($sub_standard == $std) {
                                                            continue;
                                                        } else {
                                                            echo "<option value='" . $row["c_name"] . " " . $row["c_division"] . "' >" . $row["c_name"] . " " . $row["c_division"]  . "</option>";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Subject Name</label>
                                            <input name="sub_name" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Subject Name" value="<?php echo $sub_name; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Subject Teacher</label>
                                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="sub_teacher">
                                                <option disabled>Select Subject Teacher</option>

                                                <?php
                                                $sql = "SELECT * FROM teacher";
                                                $result = $auth->conn->query($sql);
                                                $rows = $result->fetchAll();
                                                if ($rows) {
                                                    // output data of each row
                                                    foreach ($rows as $row) {
                                                        $teach = $row['fname'] . " " . $row['lname'];
                                                        if ($sub_teacher == $teach) {
                                                            echo "<option selected value='" . $row["fname"] . " " . $row["lname"] . "' >" . $row["tid"] . "  :  " . $row["fname"] . " " . $row["lname"]  . "</option>";
                                                        } else {
                                                            echo "<option value='" . $row["fname"] . " " . $row["lname"] . "' >" . $row["tid"] . "  :  " . $row["fname"] . " " . $row["lname"]  . "</option>";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>


                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Update Subject</button>
                                    </div>
                                </form>

                                <?php

                                if (isset($_POST['submit'])) {

                                    $sub_standard = $_POST['sub_standard'];
                                    $sub_name = $_POST['sub_name'];
                                    $sub_teacher = $_POST['sub_teacher'];




                                    try {



                                        $sql = "UPDATE subject set sub_standard='" . $sub_standard . "',sub_name='" . $sub_name . "',sub_teacher='" . $sub_teacher . "' where sub_id = '" . $sub_id . "' ";
                                        //  $sql = "INSERT INTO subject (sid,title,description) VALUES ( '".$sid."', '".$title."','".$description."')";

                                        if ($auth->conn->query($sql)) {
                                            echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
                                                            x.style.display='block';
                                                            
                                                            setTimeout(function(){
                                                                location.reload();
                                                                history.back();
                                                            },2000);

                                                            </script>";
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
                                <h3 class="box-title">All Subjects</h3>
                            </div>

                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Subject ID</th>
                                            <th>Standard</th>
                                            <th>Subject Name</th>
                                            <th>Subject Teacher</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php

                                        $sql = "SELECT *, teacher.fname, teacher.lname
FROM subject
INNER JOIN teacher
ON subject.sub_teacher=teacher.tid";
                                        $result = $auth->conn->query($sql);
                                        $rows = $result->fetchAll();
                                        if ($rows) {
                                            // output data of each row
                                            foreach ($rows as $row) {
                                                echo "<tr><td> " . $row["sub_id"] . " </td><td> " . $row["sub_standard"] . "</td><td>" . $row["sub_name"] . "</td><td>" . $row["fname"] . " " . $row['lname'] . "</td><td><a href='subject.php?update=" . $row["sub_id"] . "'><small class='label  bg-orange'>Update</small></a></td></tr>";
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



        var r = document.getElementById("subject");
        r.className += "active";
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>