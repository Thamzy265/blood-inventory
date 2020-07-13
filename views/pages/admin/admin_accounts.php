<?php
$users = new adminUsers();
$data = json_decode($users->fetchAdmin(),true);
?>

<div class="col-sm-7">
    <?php
    if ($msg != null){
        echo "<p class='alert alert-danger'>$msg</p>";
    }
    ?>

    <?php
    if ($success != null){
        echo "<p class='alert alert-success'>$success</p>";
    }
    ?>
    <div class="accounts buttons pt-3">
        <button class="btn btn-info mr-5" data-toggle="modal" data-target="#changePass">Change Password</button>
        <button class="btn btn-info mr-5" data-toggle="modal" data-target="#addUser">Add user</button>
        <button class="btn btn-warning" data-toggle="modal" data-target="#deactivateAccount">Deactivate Account</button>
    </div>

</div>
<hr>
<div class="pt-3">
    <p class="alert text-light nav-side-select">Showing admin users</p>

    <table class="table">
        <thead>
        <tr>
            <th class="cus-color">#</th>
            <th class="cus-color">First Name</th>
            <th class="cus-color">Last Name</th>

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

            echo "</tr>";
            $i ++;
        }
        ?>
        </tbody>
    </table>
</div>


<!-- Modal -->

<!--This modal dialog will show the change password dialog form -->
<div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" action="../route/route.php">
                    <div class="form-group">
                        <label for="old-password">Current Password</label>
                        <input id="old-password" class="form-control" type="password" name="oldpass" required>
                    </div>
                    <div class="form-group">
                        <label for="new-pass">New Password</label>
                        <input id="new-pass" class="form-control" type="password" name="new_pass" required>
                    </div>
                    <div class="form-group">
                        <label for="re-pass">re-Password</label>
                        <input id="re-pass" class="form-control" type="password" name="re_pass" required>
                    </div>
                    <button type="submit" name="passUpdate" class="btn btn-primary">Change Password</button>
                </form>

            </div>

        </div>
    </div>
</div>

<!--This modal dialog will show the deactivate dialog form dialog form -->
<div class="modal fade" id="deactivateAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deactivate Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="alert alert-warning">If you wish to deactivate your account enter your password</p>
                <div class="col-sm-7">
                    <form method="post" action="../route/route.php">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" class="form-control" type="password" name="password" required>
                        </div>

                        <button type="submit" name="admin_deactivate" class="btn btn-primary">Deactivate Account</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

<!--This modal dialog will show the add new user dialog form -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new admin user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="alert alert-info">Enter details of the new user</p>
                <div class="col-sm-7">
                    <form method="post" action="../route/route.php">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" required>
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="fname" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="lname" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" class="form-control" type="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Re - Password</label>
                            <input id="password" class="form-control" type="password" name="re_pass" required>
                        </div>

                        <button type="submit" name="admin_reg" class="btn btn-primary">Add User</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>