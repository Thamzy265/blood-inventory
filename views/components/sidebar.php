<div class="side-menu" id="">
    <div class="list-group">
        <a href="#" class="list-group-danger active text-center text-light">
            <?php

                echo "<h5>{$sesHelper->getSession('username')}</h5>";
            ?>

        </a>

        <?php
            if (sessionHelper::getSession('admin')==1){
                include "adminNav.php";
            }else{
                include "userNav.php";
            }
        ?>

    </div>
</div>