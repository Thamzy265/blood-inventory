<?php

require_once "../functions/sessionHelper.php";

class adminLogin extends model
{

    public function log(){
        $name = htmlentities(trim($_POST['username']));
        $password = htmlentities(trim($_POST['password']));

        if (isset($name)&&!empty($name) && isset($password) && !empty($password)){
            $pass = md5($password);
            $result = $this->logTbl($name,$pass);
            if ($result==false){
                header("location: /blood/admin_login.php?msg= Name or password is incorrect");
            }else{
                header("location: /blood/views/?page=admin");
            }

        }

    }

    public function logTbl($name,$pass){
        $sql = "SELECT * FROM `admin` WHERE `username`='{$name}' AND `password`='{$pass}'";
        if ($query = self::$mysqli->query($sql)){
            $rows = $this->getRows($query);
            if ($rows >= 1){
                $result = $query->fetch_assoc();

                // setting sessions if log in is succesful
                $sesHelper = new sessionHelper();
                $sesHelper->setSession('BBlog',$result['username']);
                $sesHelper->setSession('user_id',$result['id']);
                $fullName = $result['first_name']." ".$result['last_name'];
                $sesHelper->setSession('username',$fullName);
                $sesHelper->setSession('admin','1');
                return true;

            }else{
                //when credentials are incorrect
                return false;
            }
        }else{
            //db error failed to log user
            return false;
        }
    }

    public function createUser(){
        //creating new admin user
        //removing space and sql injection possible characters
        $username = htmlentities(trim($_POST['username']));
        $name = htmlentities(trim($_POST['fname']));
        $lname = htmlentities(trim($_POST['lname']));
        $pass = htmlentities(trim($_POST['password']));
        $re_pass = htmlentities(trim($_POST['re_pass']));

        if (isset($name) && isset($lname) && isset($pass) && isset($re_pass)){
            if (!empty($name) && !empty($lname) && !empty($username) && !empty($pass) && !empty($re_pass)){
                if ($pass==$re_pass){
                    $hashed_pass = md5($pass);
                    $result = $this->regTbl($name,$lname,$username,$hashed_pass);
                    if ($result == false){
                        //if failed to register user
                        header("location: /blood/views/?page=admin_accounts&&msg= failed to register user");
                    }else{
                        //When user is registered
                        header("location: /blood/views/?page=admin_accounts&&success= user has been added");
                    }
                }else{
                    //password is doesnt match
                    header("location: /blood/views/?page=admin_accounts&&msg= passwords dont match");
                }
            }else{
                //if fields are empty

                header("location: /blood/views/?page=admin_accounts&&msg= all fields much be entered");
            }
        }

    }

    public function regTbl($fname,$lname,$username,$pass){
        //check if the another username exists
        $sql = "SELECT * FROM `users` WHERE `username`='{$username}'";

        $query = self::$mysqli->query($sql);
        $rows = $this->getRows($query);
        if ($rows == 0){
            //adding the user to the db
            $sql = "INSERT INTO `admin` (`username`,`first_name`,`last_name`,`password`) VALUES ('{$username}','{$fname}','{$lname}','{$pass}')";
            if (self::$mysqli->query($sql)){

                return true;


            }else{
                //if user fails to register to the user table
                return false;

            }
        }else{
            //if user already exists
            header("location: /blood/index.php?msg= phone number already exists");

        }
    }

    public function deactivate($password){
        //code for deactivating account
        //will delete records in user table and profile table

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $pass = md5($password);
            //verify password with user
            $sql = "select * From `admin` WHERE `id`='{$user_id}' AND `password`='{$pass}'";

            if ($query = self::$mysqli->query($sql)) {
                $rows = $this->getRows($query);
                if ($rows >= 1) {
                    //first delete from user table
                    $sql = "DELETE FROM  `admin` WHERE `id`={$user_id}";
                    if (self::$mysqli->query($sql)) {
                        //if succesful delete in profiles table
                        header('location: /blood/route/route.php?logout=true');
                    } else {
                        //if failed in users table
                        header('location: /blood/views/?page=admin_accounts&&msg=There is a problem deactivating your account');
                    }
                }
            }else{
                //when verifying password fails
                header('location: /blood/views/?page=admin_accounts&&msg=Password is incorrect');
            }
        }else{
            //whem user id is not set
            echo "user id not set";
        }
    }

    protected function getRows($query){
        $rows = $query->num_rows;
        return $rows;
    }
}