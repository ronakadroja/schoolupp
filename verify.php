<?php
include './auth/config.php';




$auth = new Database();



if(isset($_GET['token']))
{

    $sql = "select * from admin where token = :token and status != 'active'";
        $stmt = $auth->conn->prepare($sql);
        $stmt->execute(['token'=>$_GET['token']]);
        $result = $stmt->rowCount();
        if($result > 0)
        {
            $sql1 = "update admin set status = :status where token = :token";
            $stmt1 = $auth->conn->prepare($sql1);
            $stmt1->execute(['status'=>'active','token'=>$_GET['token']]);
            $result1 = $stmt1->rowCount();

            if($result1>0){
                echo true;
                header("location: index.php?msg=Your account is successfully verified !");
            }
        }
        else{
            echo false;
            header("location: index.php?msg=Your account is already verified !");
        }
}

?>