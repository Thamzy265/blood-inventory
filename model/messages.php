<?php

class chat extends model{

    public function getMessages(){
        $query1 = "select * from `messages`";
        $result_data = array();
        if ($fetchData = self::$mysqli->query($query1)){
 
             while ($data = $fetchData->fetch_array()){
                $result_data[] = array(
                    'id' => $data["messageID"],
                    'message' => $data['body'],
                    'name' => $data["name"],
                    'email' => $data["email"],
                    'pnumber' => $data["phone_number"],
                    'time' => $data["time"],
 
                );
             }
            return json_encode($result_data);
        }else{
 
        }
    }

    public function getMessage($id){
        $query1 = "select * from `messages` WHERE `messageID`='{$id}'";
        $result_data = array();
        if ($fetchData = self::$mysqli->query($query1)){
 
             while ($data = $fetchData->fetch_array()){
                $result_data[] = array(
                    'id' => $data["messageID"],
                    'message' => $data['body'],
                    'name' => $data["name"],
                    'email' => $data["email"],
                    'pnumber' => $data["phone_number"],
                    'time' => $data["time"],
 
                );
             }
            return json_encode($result_data);
        }else{
 
        }
    }
    public function createMessage(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pnumber = $_POST['phoneNumber'];
        $msg = $_POST['body'];
        
        $sql = "INSERT INTO `messages` (`name`,`phone_number`,`email`,`body`,`status`) VALUES ('{$name}','{$pnumber}','{$email}','{$msg}','false')";
        if (self::$mysqli->query($sql)){

            header('location: /blood/support.php?msg=Your Message has been submitted and you will be contacted by our team soon');
                       
        }else{
        
            die("su");
            header('location: /blood/support.php?msg=Failed to send message try again another time.');
        

        }

    }

    public function statusMessage(){
        $id = $_GET['id'];
        $sql = "UPDATE `messages` SET `status`=true WHERE `id`='{$id}'";
        self::$mysqli->query($sql);
      
    }

    public function deleteMessage(){
        $id = $_GET['id'];
        $sql = "DELETE `messages` WHERE `messageId`='{$id}'";
        if (self::$mysqli->query($sql)){
            header('location: /blood/views/?page=admin_messages&&success=Message has been updated');
        }else{
            header('location: /blood/views/?page=admin_messages&&msg=Failed to Message');
        }
    }

}