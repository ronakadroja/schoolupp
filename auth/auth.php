<?php

require_once 'config.php';

class Auth extends Database{

    public function isExistEmail($email){
        $sql = "select * from admin where a_email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        $result = $stmt->rowCount();

        if($result > 0){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function registerAdmin($s_id,$s_name,$s_address,$s_email,$s_phone,$a_name,$a_email,$a_phone,$a_dob,$a_gender,$a_qualification,$a_username,$a_pass,$token){

        $sql = "insert into admin(s_id,s_name,s_address,s_email,s_phone,a_name,a_email,a_phone,a_dob,a_gender,a_qualification,a_username,a_pass,token) value(:s_id,:s_name,:s_address,:s_email,:s_phone,:a_name,:a_email,:a_phone,:a_dob,:a_gender,:a_qualification,:a_username,:a_pass,:token)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute(['s_id'=>$s_id,'s_name'=>$s_name,'s_address'=>$s_address,'s_email'=>$s_email,'s_phone'=>$s_phone,'a_name'=>$a_name,'a_email'=>$a_email,'a_phone'=>$a_phone,'a_dob'=>$a_dob,'a_gender'=>$a_gender,'a_qualification'=>$a_qualification,'a_username'=>$a_username,'a_pass'=>$a_pass,'token'=>$token]);

        return true;
    }

    public function checkPasswordWithEmail($role,$email,$password){

        if($role=='admin')
        {
            $sql = "select * from {$role} where a_email = :email and a_pass = :pass and status='active'";
            $username = 'a_username';
            
        }
        else if($role=='teacher'){
            $sql = "select * from {$role} where email = :email and password = :pass and status='active'";
            $username = 'fname';

        }
        else if($role=='student'){
            $sql = "select * from {$role} where stu_email = :email and stu_pass = :pass and status='active'";
            $username = 'stu_fname';
            
        }
        else if($role=='parent'){
            $sql = "select * from {$role} where p_email = :email and p_pass = :pass and status='active'";
            $username = 'p_fname';

        }
        


        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email,'pass'=>$password]);
        $result = $stmt->rowCount();
        $data = [];
        $success=true;
        if($result > 0)
        {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            array_push($data,$success,$user[$username]);
            return $data;
        }
        else{
            return false;
        }
    }



    public function encryptToken($string){
        $chipher = "AES-128-CTR";
        $length = openssl_cipher_iv_length($chipher);
        $option=0;
        $encryption_iv = '1234567891011121';
        $encryption_key = 'qWeRtYuIoP';
        $encryption = openssl_encrypt(
            $string,$chipher,$encryption_key,$option,$encryption_iv
        );

        return $encryption;
    }
    public function decodeToken($string){
        $chipher = "AES-128-CTR";
        $length = openssl_cipher_iv_length($chipher);
        $option=0;
        $decryption_iv = '1234567891011121';
        $decryption_key = 'qWeRtYuIoP';
        $decryption = openssl_decrypt(
            $string,$chipher,$decryption_key,$option,$decryption_iv
        );

        return $decryption;
    }


    
    public function sendEmailForPasswordChange($email){


            $to = $email;
            $token = $this->encryptToken($email);
            
            $subject = "Reset password for SchoolUpp";
            $message = "<table style='width:100%;margin:0;padding:0' width='100%' cellpadding='0' cellspacing='0' role='presentation'>
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
            We're happy you're here. Let's change the password:
            </p>

            <p style='color:#51545e;margin:0.4em 0 1.1875em;font-size:16px;line-height:1.625'>
            <a style='color:#fff;background-color:#3869d4;border-top:10px solid #3869d4;border-right:18px solid #3869d4;border-bottom:10px solid #3869d4;border-left:18px solid #3869d4;display:inline-block;text-decoration:none;border-radius:3px;box-sizing:border-box' href='http://localhost/SMS/resetPassword.php?token={$token}?' target='_blank'>Click to Reset Password</a>
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


                    $header = "From:ssiphostel2425@gmail.com \r\n";
                            $header .= "MIME-Version: 1.0\r\n";
                            $header .= "Content-type: text/html\r\n";
                            
                            $retval = mail($to,$subject,$message,$header);

                            if($retval)
                            { 
                                return true;
                            }
                            else{
                                return false;
                            }
    }


    public function resetPassword($pass,$email)
    {
        $sql = "update admin set a_pass = :pass where a_email = :email";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute(["pass"=>$pass,"email"=>$email])){
            return true;
        }
        else{
            return false;
        }
    }


}


?>