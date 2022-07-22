<?php

include '../../auth/auth.php';


$auth = new Auth();

$s_name = $auth->testInput($_POST['sname']);
$s_address = $auth->testInput($_POST['saddress']);
$s_email = $auth->testInput($_POST['semail']);
$s_phone = $auth->testInput($_POST['scontact']);
$a_name = $auth->testInput($_POST['aname']);
$a_email = $auth->testInput($_POST['aemail']);
$a_phone = $auth->testInput($_POST['amobile']);
$a_dob = $auth->testInput($_POST['adob']);
$a_gender = $_POST['agender'];
$a_qualification = $auth->testInput($_POST['aquali']);
$a_username = $auth->testInput($_POST['ausername']);
$a_pass = $auth->testInput($_POST['apass']);
$acpass = $auth->testInput($_POST['acpass']);




if($a_pass===$acpass)
{
    
        if(!$auth->isExistEmail($a_email))
        {
            $s_id= "sid".rand(1,100000);
            $token = bin2hex(random_bytes(16));
            if($auth->registerAdmin($s_id,$s_name,$s_address,$s_email,$s_phone,$a_name,$a_email,$a_phone,$a_dob,$a_gender,$a_qualification,$a_username,$a_pass,$token)){
                

                // echo 1;

                // mail body

                $to = $a_email;
                $subject = "You have created account on SchoolUpp";

                $message= "<table style='width:100%;margin:0;padding:0' width='100%' cellpadding='0' cellspacing='0' role='presentation'>
                <tbody><tr>
                  <td style='word-break:break-word;font-family:Lato,Tahoma,sans-serif;font-size:16px;height:25px;width:570px;margin:0 auto'>
                    <table class='m_764826514911004926email-body_inner' style='width:570px;margin:0 auto;padding:12px;background-color:#fff;background:#000;' align='center' width='570' cellpadding='0' cellspacing='0' role='presentation'>
                      <tbody><tr>
                        <td style='word-break:break-word;font-family:Lato,Tahoma,sans-serif;font-size:16px'>
                          <a style='color:white; text-decoration:none;' href='http://localhost/SMS/' target='_blank'>
                          <div style='display:flex;align-items:center;'>
                          <div><img src='https://play-lh.googleusercontent.com/INY4vfQNUb6DmvSAmEDqcZAJzYbDkPa9WORf0AdZMeJQDBXkPeQypC-25Cl1Rc1XLzA' width='45' height='45' alt=''></div>
                           <div><h4 style='margin:0px 8px'>S c h o o l U p p</h4> </div>
                          </div>
                          </a>
                        </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
                
                
                <tr>
                  <td style='word-break:break-word;font-family:Lato,Tahoma,sans-serif;font-size:16px;width:100%;margin:0;padding:0' width='570' cellpadding='0' cellspacing='0'>
                    <table class='m_764826514911004926email-body_inner' style='width:570px;margin:0 auto;padding:0;background-color:#fff' align='center' width='570' cellpadding='0' cellspacing='0' role='presentation'>
                      
                      
                      <tbody><tr>
                        <td style='word-break:break-word;font-family:Lato,Tahoma,sans-serif;font-size:16px;padding:20px 45px'>
                          <div>
                            <h1 style='margin-top:0;color:#333;font-size:24px;font-weight:bold;text-align:left'>
      Thanks for signing up for SchoolUpp!
    </h1>
    
    <p style='color:#51545e;margin:0.4em 0 1.1875em;font-size:16px;line-height:1.625'>
      We're happy you're here. Let's get your email address verified:
    </p>
    
    <p style='color:#51545e;margin:0.4em 0 1.1875em;font-size:16px;line-height:1.625'>
      <a style='color:#fff;background-color:#3869d4;border-top:10px solid #3869d4;border-right:18px solid #3869d4;border-bottom:10px solid #3869d4;border-left:18px solid #3869d4;display:inline-block;text-decoration:none;border-radius:3px;box-sizing:border-box' href='http://localhost/SMS/verify.php?token={$token}' target='_blank'>Click to Verify Email</a>
    </p>
    
    <p style='color:#51545e;margin:0.4em 0 1.1875em;font-size:16px;line-height:1.625'>Verifying your email address enables these features:</p>
    
    <ul style='margin:0.4em 0 1.1875em;font-size:16px;line-height:1.625'>
      <li>Attendance</li>
      <li>Teacher & Student Managment</li>
      <li>Fees Managment</li>
      <li>Parent Portal</li>
      <li>Exam Managment</li>
      <li>Time Table Managment</li>
    </ul>
    
    
    <h2 style='margin-top:0;color:#333;font-size:20px;font-weight:bold;text-align:left'>
      Getting Started on SchoolUpp
    </h2>
    
    <p style='color:#51545e;margin:0.4em 0 1.1875em;font-size:16px;line-height:1.625'>
    If you did not create this account and you received this email, contact us.
    </p>
                          </div>
                        </td>
                      </tr>
                      
                    </tbody></table>
                  
                  </td>
                </tr>
              </tbody></table>";
                
                // $message = "<b>Thank You for Registration!</b><br/>";
                // $message .= "Hello, <br/><br/> Welcome to SchoolUpp! </br> You have signed in a school managment system platform. To access all our features verify your email address by clicking the below link.
                // <a style='text-decoration:none;' href='http://localhost/SMS/verify.php?token={$token}' ><button style='background-color:#008CBA; color:white; padding:8px; margin:5px;'>Click to Verify Email</button></a>
                // ";
                
                $header = "From:ssiphostel2425@gmail.com \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                
                $retval = mail ($to,$subject,$message,$header);

                if($retval)
                {
                    
                    echo 1;
                }
                else{
                    echo "notsend";
                }

            }
            else{
                echo 404;
            }
        }
        else{
            echo 0;
        }
    
}
else
{
   echo $auth->showMessage('danger','Password does not match!');
}





?>