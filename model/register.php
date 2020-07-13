<?php

require('db.php');

class RegisterUser extends model
{
    public function register(){

            //removing space and sql injection possible characters
            $name = htmlentities(trim($_POST['fname']));
            $lname = htmlentities(trim($_POST['lname']));
            $email = htmlentities(trim($_POST['email']));
            $mobile = htmlentities(trim($_POST['pnumber']));
            $gender = htmlentities(trim($_POST['gender']));
            $region = htmlentities(trim($_POST['region']));
            $blood = htmlentities(trim($_POST['blood']));
            $pass = htmlentities(trim($_POST['password']));
            $re_pass = htmlentities(trim($_POST['re_pass']));

            if (isset($name) && isset($lname) && isset($email) && isset($mobile)  && isset($pass) && isset($re_pass)){
                if (!empty($name) && !empty($lname) && !empty($email) && !empty($mobile) && !empty($pass) && !empty($re_pass)){
                    if ($pass==$re_pass){
                        $hashed_pass = md5($pass);
                        $result = $this->regTbl($name,$lname,$email,$mobile,$region,$blood,$gender,$hashed_pass);
                        if ($result == false){
                           //if failed to register user
                           header("location: /blood/register.php?msg= failed to register user");
                        }else{
                            //When user is registered
                            header("location: /blood/verify.php");
                        }
                    }else{
                        //password is doesnt match
                        header("location: /blood/index.php?msg= passwords dont match");
                    }
                }else{
                    //if fields are empty
                    
                    header("location: /blood/register.php?msg= all fields much be entered");
                }
            }

    }

    public function regTbl($fname,$lname,$email,$mobile,$region,$blood,$gender,$pass){
          //check if the another username exists
      $sql = "SELECT * FROM `users` WHERE `phone_number`='{$mobile}' AND `username`='{$email}'";

      $query = self::$mysqli->query($sql);
      $rows = $this->getRows($query);
      if ($rows == 0){
          $code = rand(10000,99999);
          $messages = new messages();
          $body = "Blood Bank registration code: {$code}";
          $messages->twiSms($mobile,$body);
          $messages->sendEmail($email,$code);
          //adding the user to the db
          $sql = "INSERT INTO `users` (`username`,`phone_number`,`password`,`email`,`f_name`,`l_name`,`adress`,`blood_id`,`code`,`status`) VALUES ('{$email}','{$mobile}','{$pass}','{$email}','{$fname}','{$lname}','{$region}','{$blood}','{$code}','false')";
          if (self::$mysqli->query($sql)){

              $user_id = self::$mysqli->insert_id;
            
             
                //if user is registered succesfully
                  //setting session variables
                  $sesHelper = new sessionHelper();
                  $sesHelper->setSession('user_id',$user_id);
               return true;

              
          }else{
              //if user fails to register to the user table
              return false;

          }
      }else{
          //if user already exists
          header("location: /blood/register.php?msg= phone number already exists");

      }
    }

    protected function getRows($query){
        $rows = $query->num_rows;
        return $rows;
    }
}

