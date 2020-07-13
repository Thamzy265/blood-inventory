<?php


class Blood extends model
{
    public function fetchBlood(){
        $query1 = "select * from `blood_group`";
       if ($fetchData = self::$mysqli->query($query1)){

            while ($data = $fetchData->fetch_array()){
               $result_data[] = array(
                   'id' => $data["id"],
                   'blood' => $data['blood_group'],
                   'quantity' => $data["quantity"],

               );
            }
           return json_encode($result_data);
       }else{

       }

    }

    public function updateQty($qty,$id){
        //updating blood quantity in blood group table
        $sql = "UPDATE `blood_group` SET `quantity`='{$qty}' WHERE `id`='{$id}'";
        if (self::$mysqli->query($sql)){
            header('location: /blood/views/?page=admin_inventory&&success=Blood quantity has been updated');
        }else{
            header('location: /blood/views/?page=admin_inventory&&msg=Failed to update Blood quantity');
        }

    }
}