<?php
require_once "db.php";

class profile extends model
{
    public function getProfile(){

        $user_id = sessionHelper::getSession('user_id');

        $sql = "select * from `users` WHERE `id`='{$user_id}'";
        if ($query = self::$mysqli->query($sql)){
            $result_data = array();
            // $results = $query->fetch_assoc();
            while ($row = $query->fetch_array()){
                $result_data[] = array(
                    'id' => $row["id"],
                    'fname' => $row["f_name"],
                    'lname' => $row["l_name"],
                    'email' => $row["email"],
                    'pnumber' => $row["phone_number"],
                    'gender' => $row["gender"],
                    'blood' => $row["blood_id"],
                    'region' => $row["Adress"]
                );
            }
            return json_encode($result_data);
        }else{
            //failed to fetch profiles table
        }
    }
    public function updateProfile(){

        $fname = htmlentities($_POST['fname']);
        $lname = htmlentities($_POST['lname']);
        $gender = htmlentities($_POST['gender']);
        $email = htmlentities($_POST['email']);
        $pnumber = htmlentities($_POST['pnumber']);
        $region = htmlentities($_POST['region']);
        $blood = htmlentities($_POST['blood']);

        $user_id = sessionHelper::getSession('user_id');
        $sql = "UPDATE `users` SET `f_name`='{$fname}',`l_name`='{$lname}',`email`='{$email}',`phone_number`='{$pnumber}',`gender`='{$gender}',`blood_id`='{$blood}',`Adress`='{$region}' WHERE `id`='{$user_id}'";

        if (self::$mysqli->query($sql)){
            $sesHelper = new sessionHelper();

            $fullName = $fname." ".$lname;
            $sesHelper->setSession('username',$fullName);
            header("location: /blood/views/?page=profile&&success=Profile has been updated");
        }else{
            //when updating fails
        }
    }
}