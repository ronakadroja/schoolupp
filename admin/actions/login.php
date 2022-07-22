<?php 

include '../../auth/auth.php';


$auth = new Auth();
session_start();


$pass = $auth->testInput($_POST['pass']);
$email = $auth->testInput($_POST['email']);
$role = $auth->testInput($_POST['role']);
$result = $auth->checkPasswordWithEmail($role,$email,$pass);

// print_r($result);


if($result[0])
{
    $_SESSION['email']=$email;
    $_SESSION['role']=$role;
    $_SESSION['user']=$result[1];
    echo 1;
}
else
{
    echo 0;
}

?>