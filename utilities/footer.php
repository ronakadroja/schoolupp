<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Student Management System
    </div>

    <div class="copyright">
  <strong>Copyright © <span id="year"></span> . </strong> All rights reserved to SchoolUpp
</div>
<script>
  
  function getCurrentYear() {
    return new Date().getFullYear();
  };

  document.getElementById("year").innerHTML = getCurrentYear(); 
  
</script>

  </footer>