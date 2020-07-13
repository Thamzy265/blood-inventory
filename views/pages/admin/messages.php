<?php
$messages = new chat();
$data = json_decode($messages->getMessages(),true);
?>

<div class="pt-3">
    <p class="alert text-light nav-side-select">Showing Messages</p>

    <table class="table">
        <thead>
        <tr>
            <th class='cus-color'>#</th>
            <th class='cus-color'>Name</th>
            <th class='cus-color'>Email</th>
            <th class='cus-color'>Phone Number</th>
            <th class='cus-color'>Message</th>
            <th class='cus-color'>time</th>
        </tr>
        </thead>
        <tbody class="white-grey">
        <?php

        $i= 1;
        foreach ($data as $msg) {

            echo "<tr>";
            echo "<td class='cus-color'>$i</td>";
            echo "<td class='cus-color'>{$msg['name']}</td>";       
            echo "<td class='cus-color'>{$msg['email']}</td>";
            echo "<td class='cus-color'>{$msg['pnumber']}</td>";
            echo "<td class='cus-color'>{$msg['message']}</td>";
            echo "<td class='cus-color'>{$msg['time']}</td>";

            echo "</tr>";
            $i ++;
        }
        ?>
        </tbody>
    </table>
</div>

