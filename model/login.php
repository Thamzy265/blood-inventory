<?php
require_once "../functions/sessionHelper.php";

class Login extends model
{
    public function log(){
        $name = htmlentities(trim($_POST['username']));
        $password = htmlentities(trim($_POST['password']));
    
        if (isset($name)&&!empty($name) && isset($password) && !empty($password)){
            $pass = md5($password);
            $result = $this->logTbl($name,$pass);
            if ($result==false){
                header("location: /blood/login.php?msg= Name or password is incorrect");
            }else{

                header("location: /blood/views/?page=home");
            }
        
    }
   
    }
    public function logTbl($name,$pass){
        $sql = "SELECT * FROM `users` WHERE `username`='{$name}' OR `phone_number`='{$name}' AND `password`='{$pass}'";
        if ($query = self::$mysqli->query($sql)){
            $rows = $this->getRows($query);
            if ($rows >= 1){
                $result = $query->fetch_assoc();

               // setting sessions if log in is succesful
                $sesHelper = new sessionHelper();
               
                $sesHelper->setSession('user_id',$result['id']);


                if ($query = self::$mysqli->query($sql)){
                    $rows = $this->getRows($query);
                    if ($rows >=1){
                        if($result['status']){
                            $result = $query->fetch_assoc();
                            $fullName = $result['f_name']." ".$result['l_name'];
                            $sesHelper->setSession('username',$fullName);
                            $sesHelper->setSession('BBlog',$result['phone_number']);
                        }else{
                            header("location: /blood/verify.php");
                        }
                        

                      return true;
                    }
                }

            }else{
                //when credentials are incorrect
                return false;
            }
         }else{
           //db error failed to log user
            return false;
        }
    }

    public function verify($code){
        $sesHelper = new sessionHelper();
        $sql = "select * from `users` where `code`='{$code}'";
        if($query = self::$mysqli->query($sql)){
            $rows = $this->getRows($query);
            if ($rows >=1){
                    $sql ="UPDATE `users` SET `status`='1' where `code`='{$code}'";
                    self::$mysqli->query($sql);
                    $result = $query->fetch_assoc();
                    $fullName = $result['f_name']." ".$result['l_name'];
                    $sesHelper->setSession('username',$fullName);
                    $sesHelper->setSession('BBlog',$result['phone_number']);
                    $sesHelper->setSession('user_id',$result['id']);
                    header("location: /blood/views/?page=home");
                }else{
                    header("location: /blood/verify.php?msg=The verification code is incorrect");
                }
        }
    }

    protected function getRows($query){
        $rows = $query->num_rows;
        return $rows;
    }
    
}
