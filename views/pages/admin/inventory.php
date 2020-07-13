<?php
$Blood = new Blood();
$data = json_decode($Blood->fetchBlood(),true);
?>


<?php
if ($msg != null){
    echo "<p class='alert alert-danger'>$msg</p>";
}
?>

<?php
if ($success != null){
    echo "<p class='alert alert-success'>$success</p>";
}else{
    echo "<p class='alert text-light nav-side-select'>Showing Blood Inventory</p>";
}
?>

<div class="pt-3">


    <table class="table">
        <thead>
        <tr>
            <th class='cus-color'>#</th>
            <th class='cus-color'>Blood Type</th>
            <th class='cus-color'>Quantity</th>

        </tr>
        </thead>
        <tbody class="white-grey">
        <?php
        $i= 1;
        foreach ($data as $blood) {

            echo "<tr>";
            echo "<td class='cus-color'>$i</td>";
            echo "<td class='cus-color'>{$blood['blood']}</td>";
            echo "<td class='cus-color'>{$blood['quantity']}</td>";
            echo "<td class='cus-color'><form method='get' action='../route/route.php' class='d-flex'><input class='form-control col-2' name='qty' type='number' placeholder='Quantity' required><button class='btn btn-primary' type='submit' name='inventory' value='{$blood['id']}'>Update</button></form></td>";

            echo "</tr>";
            $i ++;
        }
        ?>
        </tbody>
    </table>
</div>

