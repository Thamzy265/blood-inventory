<?php
$group = new group();
$data = json_decode($group->fetchUsers(),true);
?>

<div class="pt-3">
    <p class="alert text-light nav-side-select">Showing people with compatable blood type as you in your region</p>

    <table class="table">
        <thead>
        <tr>
            <th class="cus-color">#</th>
            <th class="cus-color">First Name</th>
            <th class="cus-color">Last Name</th>
            <th class="cus-color">Email</th>
            <th class="cus-color">Phone number</th>
        </tr>
        </thead>
        <tbody class="white-grey">
        <?php
        $i= 1;
        foreach ($data as $user) {

            echo "<tr>";
            echo "<td class='cus-color'>$i</td>";
            echo "<td class='cus-color'>{$user['fname']}</td>";
            echo "<td class='cus-color'>{$user['lname']}</td>";
            echo "<td class='cus-color'>{$user['email']}</td>";
            echo "<td class='cus-color'>{$user['pnumber']}</td>";
            echo "</tr>";
            $i ++;
        }
        ?>
        </tbody>
    </table>
</div>
