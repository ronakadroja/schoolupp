<?php

include '../../auth/auth.php';

$auth = new Auth();
session_start();

if(isset($_POST['femail'])){

    
    $result = $auth->isExistEmail($_POST['femail']);

    if($result)
    {
        $isEmailSend = $auth->sendEmailForPasswordChange($_POST['femail']);

        if($isEmailSend){
            $_SESSION['expire_time'] = time() + ( 10 * 60 );
            echo "We sent a reset password link to your registered E-mail ID. Please check it ! <strong>Link is expire within 10 min !</strong>";

        }
        else{
            echo "Something went Worng.Email not sent !";
        }
    }
    else
    {
        echo "Opps! Email not found !";
    }
}






?>