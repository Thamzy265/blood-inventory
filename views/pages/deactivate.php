<h3 class="text-info">Deactivate Account</h3>
<div class="pt-3">
    <?php
    if ($msg != null){
        echo "<p class='alert alert-danger'>$msg</p>";
    }
    ?>
    <p class="alert alert-warning">If you wish to deactivate your account enter your password</p>
    <div class="col-sm-7">
        <form method="post" action="../route/route.php">
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>

            <button type="submit" name="deactivate" class="btn btn-primary">Deactivate Account</button>
        </form>
    </div>


</div>