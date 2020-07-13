<?php
require_once "db.php";

class user extends model
{
    public function changePassword($current,$newPass){
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $cuPass = md5($current);
            $pass = md5($newPass);

            $sql = "Select * from `users` WHERE  `id`='{$user_id}' AND  `password`='{$cuPass}'";
            if ($query = self::$mysqli->query($sql)){
                $rows = $this->getRows($query);
                if ($rows >= 1) {
                    $sql = "Update `users` SET `password`='{$pass}' WHERE `id`='{$user_id}'";
                    if (self::$mysqli->query($sql)){
                        //when succesful
                        header('location: /blood/views/?page=account&&success=Password has been changed');
                    }else{
                        //when updating fails
                        header('location: /blood/views/?page=account&&msg=A problem occured when updating your password');
                    }
                }
            }else{
                //if password is incorrect
                header('location: /blood/views/?page=account&&msg=Password is incorrect');
            }

        }else{
            //if user id is not set

        }
    }
    public function deactivate($password){
        //code for deactivating account
        //will delete records in user table and profile table

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $pass = md5($password);
            //verify password with user
            $sql = "select * From `users` WHERE `id`='{$user_id}' AND `password`='{$pass}'";

            if ($query = self::$mysqli->query($sql)) {
                $rows = $this->getRows($query);
                if ($rows >= 1) {
                    //first delete from user table
                    $sql = "DELETE FROM  `users` WHERE `id`={$user_id}";
                    if (self::$mysqli->query($sql)) {
                        
                            header('location: /blood/route/route.php?logout=true');
                        
                    } else {
                        //if failed in users table
                        header('location: /blood/views/?page=deactivate&&msg=There is a problem deactivating your account');
                    }
                }
            }else{
                //when verifying password fails
                header('location: /blood/views/?page=deactivate&&msg=Password is incorrect');
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