let container = document.getElementById('container')
let nextBtn = document.getElementById('nextBtn');

toggle = () => {
  container.classList.toggle('sign-in')
  container.classList.toggle('sign-up')
  nextBtn.classList.toggle('d-none');
}

setTimeout(() => {
  container.classList.add('sign-in')
}, 200)

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
    $('#nextBtn').removeClass('btn-success').addClass('btn-primary');
    // document.getElementsByClassName("btn-success").style.backgroundColor= "#008CBA !important";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    // document.getElementById("regForm").submit();
    document.getElementById("nextBtn").style.display = "none";
    document.getElementById("prevBtn").style.display = "none";
    document.getElementById("step").style.display = "none";

    var sname = $('#sname').val();
    var saddress = $('#saddress').val();
    var semail = $('#semail').val();
    var scontact = $('#scontact').val();
    var aname = $('#aname').val();
    var aemail = $('#aemail').val();
    var amobile = $('#amobile').val();
    var adob = $('#adob').val();
    var agender = $("input[type='radio']").val();
    var aquali = $('#aquali').val();
    var ausername = $('#ausername').val();
    var apass = $('#apass').val();
    var acpass = $('#acpass').val();

    var emailRegex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

    if (semail.match(emailRegex)) {

      if (aemail.match(emailRegex)) {

        if (apass === acpass) {
          
          $.ajax({
            method:'POST',
            url:'./admin/actions/register.php',
            
            data:{sname,saddress,semail,scontact,aname,aemail,amobile,adob,agender,aquali,ausername,apass,acpass},
            beforeSend:function(){
              $('body').addClass('loading');
            },
            complete:function(){
              $('body').removeClass('loading');
            },
            success:function(res){
              if(res==1){
                swal("Congratulation", "You have successfully registered!👍 \n We have sent verification link to your registered email. Please Verify!", "success");

                container.classList.toggle('sign-in')
                container.classList.toggle('sign-up')
              }
              else if(res==404){
                swal("Opps", "Something went wrong", "warning");
                $('#regis').show();
                document.getElementsByClassName("sign-up").style.display="block";
              }
              else if(res=="notsend"){
                swal("Opps", "Email not send", "warning");
                $('#regis').show();
                document.getElementsByClassName("sign-up").style.display="block";
              }
              else{
                swal("Opps", "Email already exits", "info");
                $('#regis').show();
                document.getElementsByClassName("sign-up").style.display="block";
              }
              console.log(res);
            }
          });
        }
        else {
          x = document.getElementsByClassName("tab");
          currentTab = 2;
          var y = x[currentTab].getElementsByTagName("input");
          y[1].className += " invalid";
          y[2].className += " invalid";
          document.getElementById("nextBtn").style.display = "block";
          document.getElementById("prevBtn").style.display = "block";
          document.getElementById("step").style.display = "block";
          showTab(currentTab);
          
          swal("Opps","Password does not match! ☹ !","warning");
          
          
        }
      }
      else {
        x = document.getElementsByClassName("tab");
        currentTab = 1;
        var y = x[currentTab].getElementsByTagName("input");
        y[1].className += " invalid";
        document.getElementById("nextBtn").style.display = "block";
        document.getElementById("prevBtn").style.display = "block";
        document.getElementById("step").style.display = "block";
        showTab(currentTab);
        swal("Opps","Invalid Email ☹ !","warning");
       
      }

    }
    else {
      x = document.getElementsByClassName("tab");
      currentTab = 0;
      var y = x[currentTab].getElementsByTagName("input");
      y[2].className += " invalid";
      document.getElementById("nextBtn").style.display = "block";
      document.getElementById("prevBtn").style.display = "none";
      document.getElementById("step").style.display = "block";
      showTab(currentTab);
      
      swal("Opps","Invalid Email ☹ !","warning");
    }
    console.log(currentTab);
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}


$('#l_email').on('keyup',function(){
  var emailRegex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    var value = $('#l_email').val();
    if(!value.match(emailRegex))
    {
      $('#l_email').css({"border":"2px solid red"});
    }
    else
    {
      $('#l_email').css({"border":"2px solid blue"});
      $('#checkLogin').attr('disabled',false);
    }
});


$('#l_pass').on('keyup',function(){
  
    var value = $('#l_pass').val();
    if(value.length==0)
    {
      $('#l_pass').css({"border":"2px solid red"});
    }
    else
    {
      $('#l_pass').css({"border":"2px solid blue"});
      $('#checkLogin').attr('disabled',false);
    }
});


$('#checkLogin').on('click',function(){

  // alert($('#role option:selected').val());
  $('#role').change(function(){
    $('#role').css({"border":"2px solid blue"});

  })
    if($('#l_email').val()=="" || $('#l_pass').val()=="" || $('#role option:selected').val()=="")
    {
      $('#l_email').css({"border":"2px solid red"});
      $('#l_pass').css({"border":"2px solid red"});
      $('#role').css({"border":"2px solid red"});
    }
    else{
      $('#l_email').css({"border":"2px solid blue"});
      $('#l_pass').css({"border":"2px solid blue"});
   

      $.ajax({
        method:'POST',
        url:'./admin/actions/login.php',
        data:{email:$('#l_email').val() , pass:$('#l_pass').val(),role:$('#role option:selected').val()},
        beforeSend:function(){
          $('#spinner').removeClass('d-none');
        },
        complete:function(){
          
          $('#spinner').addClass('d-none');
        },
        success:function(res){
          console.log(res);
          if(res==1){

            window.location.href = './demo.php';
          }
          else{
            $('#login-msg').removeClass('d-none');
            $('#login-msg').html('<p>Invalid password Or account is not verify yet ! Sorry you cannot login ! ☹</p>');

            setTimeout(function(){
              $('#login-msg').addClass('d-none');
            },5000)
            
          }
        }
      })
    }
})





