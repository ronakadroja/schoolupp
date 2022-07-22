<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->


    <!-- search form (Optional) -->

    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header"> Dashboard</li>
      <!-- Optionally, you can add icons to the links -->
      <!-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>-->
      <li id="stat"><a href="http://localhost/SMS"><i class="fa fa-bar-chart-o"></i> <span>Statistics</span> </a></li>

      <?php if ($_SESSION['role'] == 'admin') { ?>
        <li id="new"><a href="./student.php"><i class="fa fa-users"></i> <span>Student</span> </a></li>
        <li id="teacher"><a href="./teacher.php"><i class="fa  fa-black-tie"></i> <span>Teacher</span> </a></li>
        <li id="parent"><a href="./parent.php"><i class="fa  fa-female"></i> <span>Parents</span> </a></li>
        <li id="subject"><a href="./subject.php"><i class="fa fa-book"></i> <span>Subject</span> </a></li>
        <li id="class"><a href="./class.php"><i class="fa fa-bank"></i> <span>Class Room</span> </a></li>
        <li id="schedule"><a href="./schedule.php"><i class="fa fa-calendar-o"></i> <span>Schedule</span> </a></li>
        <li id="attendance"><a href="./attendance.php"><i class="fa  fa-check"></i> <span>Attendance</span> </a></li>
        <li id="exam"><a href="./exam.php"><i class="fa fa-line-chart"></i> <span>Exam</span> </a></li>
        <li id="examresults"><a href="./exam_result.php"><i class="fa fa-graduation-cap"></i> <span>Exam Results</span> </a></li>
        <li id="notice"><a href="./notice.php"><i class="fa fa-envelope-o"></i> <span>Notice</span> </a></li>
      <?php 
      } elseif ($_SESSION['role'] == 'parent') {
      ?>
        <li id="attendance"><a href="http://localhost/SMS/parents/par_attendance.php"><i class="fa fa-users"></i> <span>Attendance</span> </a></li>
        <li id="academic_tt"><a href="http://localhost/SMS/parents/par_schedule.php"><i class="fa fa-users"></i> <span>Academic Time Table</span> </a></li>
        <li id="exam_tt"><a href="http://localhost/SMS/parents/par_examtt.php"><i class="fa fa-users"></i> <span>Exam Time Table</span> </a></li>
        <li id="par_stu_marks"><a href="http://localhost/SMS/parents/par_stu_marks.php"><i class="fa fa-users"></i> <span>Student Marks</span> </a></li>
        <li id="notice-role"><a href="http://localhost/SMS/notice-role.php"><i class="fa fa-envelope-o"></i> <span>Notice</span> </a></li>
      <?php

      } elseif ($_SESSION['role'] == 'student') { ?>

        <li id="stu_profile"><a href="http://localhost/SMS/student/stu_profile.php"><i class="fa fa-graduation-cap"></i> <span>Profile</span> </a></li>
        <li id="stu_schedule"><a href="http://localhost/SMS/student/stu_schedule.php"><i class="fa fa-graduation-cap"></i> <span>Schedule</span> </a></li>
        <li id="stu_attendance"><a href="http://localhost/SMS/student/stu_attendance.php"><i class="fa fa-graduation-cap"></i> <span>Attendance</span> </a></li>
        <li id="stu_exam"><a href="http://localhost/SMS/student/stu_exam.php"><i class="fa fa-graduation-cap"></i> <span>Exams</span> </a></li>
        <li id="stu_examresult"><a href="http://localhost/SMS/student/stu_marks.php"><i class="fa fa-graduation-cap"></i> <span>Exam Results</span> </a></li>
        <li id="notice-role"><a href="http://localhost/SMS/notice-role.php"><i class="fa fa-envelope-o"></i> <span>Notice</span> </a></li>

      <?php

      } else { ?>
        <li id="tea_profile"><a href="http://localhost/SMS/teacher/tea_profile.php"><i class="fa fa-envelope-o"></i> <span>Profile</span> </a></li>
        <li id="tea_schedule"><a href="http://localhost/SMS/teacher/tea_schedule.php"><i class="fa fa-graduation-cap"></i> <span>Schedule</span> </a></li>
        <li id="tea_marks"><a href="http://localhost/SMS/teacher/tea_marks_entry.php"><i class="fa fa-calendar-o"></i> <span>Marks Entry</span> </a></li>
        <?php 
          $sql = "select * from classroom where c_teacher in (select tid from teacher where email = '" . $_SESSION['email'] . "')";
          $res = $auth->conn->query($sql);
          $rows = $res->fetchAll();
          if($rows){

            echo "<li id='tea_attendance'><a href='http://localhost/SMS/teacher/tea_attendance.php'><i class='fa fa-calendar-o'></i> <span>Attendance</span> </a></li>";
          }
        
        ?>
        <li id="notice-role"><a href="http://localhost/SMS/notice-role.php"><i class="fa fa-calendar-o"></i> <span>Notice</span> </a></li>

      <?php

      }
      ?>



    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>