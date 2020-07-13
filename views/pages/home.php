
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
    <p class="alert text-light nav-side-select">Welcome to <?php echo $sesHelper->getSession('username');?> Blood Bank</p>
    <div class="">
        <div class="card-deck pb-4">
            <a href="#" class="card" data-toggle="modal" data-target="#myModal">
                <div class="em-color text-light">
                    <div class="card-body">
                        <h4 class="card-title">Emergency</h4>
                        <p class="card-text">If you are in need of blood this will alert people with same blood type as yours in your region.</p>
                    </div>
                </div>
            </a>
            <a href="?page=group" class="card fi-color">
                <div class=" text-light">

                    <div class="card-body">
                        <h4 class="card-title">Find Blood Group type</h4>
                        <p class="card-text">View people who have the same blood type as you in your region.</p>
                    </div>
                </div>
        </div>
        </a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EMERGENCY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h4 class="text-danger">THIS IS AN EMERGENCY ALERT</h4>
                    <p class="alert alert-warning">If you are in need of blood this will send alert sms to people with the same blood type in your region to come and donate blood.</p>
                    <a href="../route/route.php?emergency=true" class="btn btn-warning">Send Message</a>

                </div>

            </div>
        </div>
    </div>
