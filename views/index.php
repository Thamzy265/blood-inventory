<?php

if (isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = '';
}

if (isset($_GET['msg'])){
    $msg = $_GET['msg'];
}else{
    $msg = null;
}

if (isset($_GET['success'])){
    $success = $_GET['success'];
}else{
    $success = null;
}
?>
<?php require_once "../functions/sessionHelper.php"?>
<?php require_once "../model/profile.php"?>
<?php require_once "../model/group.php"?>
<?php require_once "../model/adminUsers.php"?>
<?php require_once "../model/emergency.php"?>
<?php require_once "../model/Blood.php"?>
<?php require_once "../model/messages.php"?>

<?php
//if session is not set will direct user to login page
$sesHelper = new sessionHelper();
$sesHelper->isNotLogged();

?>

<?php include_once "./components/head.php"?>

<div class="main d-flex">

    <?php include_once "components/sidebar.php"?>

    <div class="container pt-3">

        <?php
        /**if user is admin will have access to the admin pages
         *if user is normal user will have access to the normal pages
         *session admin will be used to verify if user is admin or not
         *
        **/
        if (sessionHelper::getSession('admin')==1){
            switch ($page){
                case "admin":
                    include_once "pages/admin/dashboard.php";
                    break;
                case "admin_accounts":
                    include_once "pages/admin/admin_accounts.php";
                    break;
                case "admin_users":
                    include_once "pages/admin/users.php";
                    break;
                case "admin_emergency":
                    include_once "pages/admin/emergency.php";
                    break;
                case "admin_inventory":
                    include_once "pages/admin/inventory.php";
                    break;
                case "admin_messages":
                    include_once "pages/admin/messages.php";
                    break;
                default:
                    include_once "pages/home.php";
            }
        }else{
            switch ($page){
                case "home":
                    include_once "pages/home.php";
                    break;
                case "profile":
                    include_once "pages/profile.php";
                    break;
                case "account":
                    include_once "pages/account.php";
                    break;
                case "deactivate":
                    include_once "pages/deactivate.php";
                    break;
                case "group":
                    include_once "pages/group.php";
                    break;
            }
        }



        ?>

        </div>
    </div>
</div>

<?php include_once "./components/footer.php"?>
