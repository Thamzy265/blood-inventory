<?php
$profile = new profile();
$data = json_decode($profile->getProfile(),true);
?>

<div class="pt-3">
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
    <p class="alert text-light nav-side-select">If you wish to change your profile fill in the form</p>
    <div class="col-sm-7">
        <form method="post" action="../route/route.php">
            <div class="form-group">

                <input id="fname" class="form-control" type="text" name="fname" placeholder="first name" value="<?php echo $data[0]['fname']?>" required>

            </div>
            <div class="form-group">

                <input id="lname" class="form-control" type="text" name="lname" placeholder="last name" value="<?php echo $data[0]['lname']?>" required>

            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" class="form-control" name="gender">
                    <option value="male" <?php if ($data[0]['gender']=='male'){ echo 'selected';} ?> >Male</option>
                    <option value="female" <?php if ($data[0]['gender']=='female'){ echo 'selected';} ?> >Female</option>
                </select>
            </div>
            <div class="form-group">
                <input id="email" class="form-control" type="email" name="email" placeholder="email" value="<?php echo $data[0]['email']?>" required>
            </div>
            <div class="form-group">
                <input id="pnumber" class="form-control" type="tel" name="pnumber" placeholder="Phone number" value="<?php echo $data[0]['pnumber']?>" required>
            </div>
            <div class="form-group">
                <label for="region" class="">Region</label>
                <select id="region" class="form-control" name="region">
                    <option value="1" <?php if ($data[0]['region']== '1'){ echo 'selected';} ?> >Northern Region</option>
                    <option value="2" <?php if ($data[0]['region']== '2'){ echo 'selected';} ?> >Central Region</option>
                    <option value="3" <?php if ($data[0]['region']== '3'){ echo 'selected';} ?> >Southern Region</option>
                </select>
            </div>
            <div class="form-group">
                <label for="blood" class="">Blood Type</label>
                <select id="blood" class="form-control" name="blood">
                    <option value="1" <?php if ($data[0]['blood']== '1'){ echo 'selected';} ?> >A</option>
                    <option value="2" <?php if ($data[0]['blood']== '2'){ echo 'selected';} ?> >B</option>
                    <option value="3" <?php if ($data[0]['blood']== '3'){ echo 'selected';} ?>>AB</option>
                    <option value="4" <?php if ($data[0]['blood']== '4'){ echo 'selected';} ?>>O</option>
                </select>
            </div>

            <input type="submit" name="upProfile" class="btn btn-success" value="Update Profile">
        </form>
    </div>


</div>