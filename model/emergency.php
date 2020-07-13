<?php

class emergency extends model
{

    public function fetchEmergency($parameter){

        if ($parameter=="all"){
            $sql = "select * from  `emergency` ORDER By `time` DESC ";
        }elseif ($parameter=="last"){
            $sql = "SELECT * FROM  `emergency` where DATE_FORMAT(`time`, '%Y-%m') = date_format(DATE_SUB(curdate(), INTERVAL 1 month),'%Y-%m') ";
        }else{
            $sql ="SELECT * FROM `emergency` WHERE MONTH(`time`) = MONTH(CURDATE())  AND YEAR(`time`) = YEAR(CURDATE())";
        }


        if ($query = self::$mysqli->query($sql)){

            $result_data = array();
            // $results = $query->fetch_assoc();
            while ($row = $query->fetch_array()){
                $query1 = "select * from `profiles` WHERE `user_id`='{$row['user_id']}'";
                $fetchData = self::$mysqli->query($query1);
                $data = $fetchData->fetch_assoc();
                $name = $data['first_name']." ".$data['last_name'];
                $result_data[] = array(
                    'id' => $row["id"],
                    'name' => $name,
                    'blood' => $row["blood_group_id"],
                    'region' => $row["region_id"],
                    'time' => $row["time"],
                );
            }

            return json_encode($result_data);
        }else{
            //when it fails
            echo "failed to fetch data";
        }
    }


}