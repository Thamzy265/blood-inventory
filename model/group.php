<?php

require_once "db.php";

class group extends model
{

    public function fetchUsers(){

        $user_id = sessionHelper::getSession('user_id');

        $sql = "select * from  `users` WHERE `id`='{$user_id}'";

        if ($query = self::$mysqli->query($sql)){
            $result = $query->fetch_assoc();
            $blood = $result['blood_id'];
            $region = $result['Adress'];
            $sql = "select * from  `users` WHERE ";

            switch ($blood){
                case '1':
                    $sql.=" `blood_id`='1' or `blood_id`='3' ";
                    break;
                case '2':
                    $sql.=" `blood_id`='2' or `blood_id`='3' ";
                    break;
                case '3':
                    $sql.=" `blood_id`='3' or `blood_id`='4' ";
                    break;
                case '4':
                    $sql.=" `blood_id`='4' ";
                    break;
            }
            $sql.=" And `Adress`='{$region}' And `id` !='{$user_id}' ";

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
                    );
                }

                return json_encode($result_data);
            }else{
                //when it fails
                echo "failed to fetch data here";
            }

        }else{
            echo "failed to get the user id";
        }
    }

    public function region($region){
        $sql = "Select * from  `users` WHERE  `region_id`='{$region}'";

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
                );
            }

            return json_encode($result_data);
        }else{
            //when it fails
            echo "failed to fetch data";
        }
    }
}