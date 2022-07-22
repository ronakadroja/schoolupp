<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link href="https://play-lh.googleusercontent.com/INY4vfQNUb6DmvSAmEDqcZAJzYbDkPa9WORf0AdZMeJQDBXkPeQypC-25Cl1Rc1XLzA" type="image/png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./asset/css/style.css">

    <style>
        .box.sign-in::before {
            background-color: lightseagreen;
            right: -100%;
        }
    </style>
</head>

<body>


    






    <?php

    require_once './auth/auth.php';
    $auth = new Auth();
    session_start();
    $err = "";
    
    if (isset($_GET['token'])) {

        if(isset($_POST['submit'])){
            $pass= $_POST['pass'];
            $cpass= $_POST['cpass'];
            $email = $auth->decodeToken($_GET['token']);

            if($pass=="" || $cpass==""){
                $err = "All fields are required !";
            }
            else if($pass===$cpass){
                $result = $auth->resetPassword($pass,$email);

                if($result){
                    $err = " Your Password is Updated Successfully ! <strong>Please wait We are redirecting you!</strong> ";
                    ?>
                        <script>  setTimeout(function(){
                            <?php
                                header("location: index.php?msg=Password Updated !");
                            ?>
                        },3000);  </script>
                    <?php

                }
                else{
                    $err="Something went wrong ! ";
                }
            }
            else{
                $err = "Password does not match !";
            }
        }

        if (!isset($_SESSION['expire_time']) || time() > $_SESSION['expire_time']) {
            unset($_SESSION['expire_time']);
            session_destroy();

    ?>
            <div id="container" class="box">
                <!-- FORM SECTION -->
                <div class="row">

                    <div class="col align-items-center flex-col sign-in">





                        <div class="form-wrapper align-items-center" style="z-index: 10;">

                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <h5>This link is expired ! please try again</h5>
                            </div>
                        </div>
                    </div>
                    <!-- END SIGN IN -->
                </div>

            </div>
        <?php
        } else {
        ?>


            <div id="container" class="box">
                <!-- FORM SECTION -->
                <div class="row">

                    <!-- SIGN UP -->


                    <!-- END SIGN UP -->

                    <!-- SIGN IN -->
                    <div class="col align-items-center flex-col sign-in">





                        <div class="form-wrapper align-items-center">
                            <div class="form sign-in" style="z-index: 10;">
                                <form method="post">
                                <div id="login-msg" class="alert alert-info text-center">Reset Your Password : </div>

                                <?php  
                                    if($err){
                                        ?>
                                            <div class="alert alert-success"> <?php echo $err;  ?> </div>

                                        <?php
                                    }
                                    
                                
                                ?>
                                <div class="input-group">
                                    <i class='bx bxs-user'></i>
                                    <input type="password" name="pass" placeholder="New Password" id="pass" required>
                                </div>
                                <div class="input-group">
                                    <i class='bx bxs-lock-alt'></i>
                                    <input type="password" name="cpass" placeholder="Confirm New Password" id="cpass" required>
                                </div>
                                <button id="checkLogin" type="submit" name="submit">
                                    Update Password
                                </button>

                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- END SIGN IN -->
                </div>
                <!-- END FORM SECTION -->
                <!-- CONTENT SECTION -->

                <!-- END CONTENT SECTION -->
            </div>




    <?php
        }
    }

    ?>


    <!-- script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="./asset/js/index.js"></script>


</body>

</html>