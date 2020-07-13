<?php
$emergency = new emergency();
$data = json_decode($emergency->fetchEmergency("all"),true);
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
    }else{
        echo "<p class=\"alert text-light nav-side-select\">Blood Bank Admin Dashboard</p>";
    }
    ?>

    <div class="">
            <div class="card-deck pb-4">
                <a href="?page=admin_emergency" class="card bg-info">
                    <div class="text-light">
                        <div class="card-body">
                            <h2 class="text-center"><?php echo count($data)?></h2>
                            <h4 class="card-title text-center pt-4">Emergencies</h4>
                        </div>
                    </div>
                </a>
                <a href="#" class="card bg-warning" data-toggle="modal" data-target="#myCollection">
                    <div class=" text-light">

                        <div class="card-body">
                            <h4 class="card-title">Blood Collection</h4>
                            <p class="card-text">Alert people for blood collection</p>
                        </div>
                    </div>

            </a>
            <a href="#" class="card bg-success" data-toggle="modal" data-target="#myReport">
                    <div class="text-light text-center">

                        <div class="card-body">
                            <h4 class="card-title">Monthly Report</h4>
                            <p class="card-text">Create Monthly report</p>
                        </div>
            </div>
            </a>
        </div>

        <div id="chart-container" class="col-sm-6">
            <canvas id="graphCanvas"></canvas>
        </div>
    </div>

    <!-- Modal -->

    <div class="modal fade" id="myReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">REPORT GENERATION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="alert-info p-5">Choose which report you should generate</p>

                    <a href="../route/route.php?report=last" class="btn btn-success">Report for Last Month</a>
                    <a href="../route/route.php?report=current" class="btn btn-primary">Report for this Month</a>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="myCollection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">BLOOD COLLECTION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="alert-info p-3">Alert user for blood collection</p>
                    <form method="post" action="../route/route.php">
                        <div class="form-group">
                            <label for="region" class="">Region</label>
                            <select id="region" class="form-control" name="region">
                                <option value="1">Northern Region</option>
                                <option value="2">Central Region</option>
                                <option value="3">Southern Region</option>
                            </select>
                        </div>
                        <div class="form-group">
                           <input class="form-control" type="text" name="details" placeholder="location and time" required>
                        </div>
                        <button class="btn btn-success" name="collection">Send Alert</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
