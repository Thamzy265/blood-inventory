<?php
$emergency = new emergency();
$data = json_decode($emergency->fetchEmergency("all"),true);
?>

<div class="pt-3">
    <p class="alert text-light nav-side-select">Showing Emergency</p>

    <table class="table">
        <thead>
        <tr>
            <th class='cus-color'>#</th>
            <th class='cus-color'>Name</th>
            <th class='cus-color'>Region</th>
            <th class='cus-color'>Blood Group</th>
            <th class='cus-color'>Time</th>
        </tr>
        </thead>
        <tbody class="white-grey">
        <?php

        $i= 1;
        foreach ($data as $user) {

            echo "<tr>";
            echo "<td class='cus-color'>$i</td>";
            echo "<td class='cus-color'>{$user['name']}</td>";
            switch ($user['region']){
                case "1":
                    echo "<td class='cus-color'>Northen Region</td>";
                    break;
                case "2":
                    echo "<td class='cus-color'>Central Region</td>";
                    break;
                case "3":
                    echo "<td class='cus-color'>Southern Region</td>";
                    break;
            }
            switch ($user['blood']){
                case "1":
                    echo "<td class='cus-color'>A</td>";
                    break;
                case "2":
                    echo "<td class='cus-color'>B</td>";
                    break;
                case "3":
                    echo "<td class='cus-color'>AB</td>";
                    break;
                case "4":
                    echo "<td class='cus-color'>0</td>";
                    break;
            }
            
            echo "<td class='cus-color'>{$user['time']}</td>";

            echo "</tr>";
            $i ++;
        }
        ?>
        </tbody>
    </table>
</div>

