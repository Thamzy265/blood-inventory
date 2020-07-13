<?php
/**
 * Requiring the necessary files
 */
require('../functions/sessionHelper.php');

require('../model/register.php');
require('../model/messages.php');
require('../model/login.php');
require('../model/user.php');
require('../model/profile.php');
require('../model/adminLogin.php');
require('../functions/messages.php');
require('../functions/report.php');
require('../model/adminUsers.php');


$sesHelper = new sessionHelper();

if (isset($_POST['sendMessage'])) {
    //send Message
    $msg = new chat();
    $msg->createMessage();

}


if(isset($_POST['register'])){
    //when registering user
    $reg = new RegisterUser();
    $reg->register();
}elseif (isset($_POST['login'])) {
    //when loggin in user
    $login = new Login();
    $login->log();
}elseif (isset($_POST['verification'])) {
    //when user wants to verify account
    $login = new Login();
    $code = $_POST['code'];
    $login->verify($code);

}elseif (isset($_POST['deactivate'])) {
    //when user deactivates account
    $users = new user();
    $password = $_POST['password'];
    $users->deactivate($password);

}elseif (isset($_POST['passUpdate'])){
    //updating password
    $pass = $_POST['new_pass'];
    $rePass = $_POST['re_pass'];

    $users = new user();
    //verifying if the passwords are correct before going further
    if ($pass==$rePass){
         $users->changePassword($_POST['oldpass'],$pass);
    }else{
        //if the pass doesnt match with re entered password
        header('location: /blood/views/?page=deactivate&&msg=The passwords do not match');
    }

}elseif (isset($_POST['upProfile'])){
    //this route is to update the user profile
    $profile = new profile();
    $profile->updateProfile();
}elseif (isset($_GET['emergency'])){
    //this will send the emergency sms
    $mes = new messages();
    $mes->sendSms();
}elseif (isset($_POST['collection'])){
    //this will send the BLOOD COLLECTION sms to people in the region selected
    $mes = new messages();
    $mes->sendCollectionSms($_POST['region'],$_POST['details']);
}elseif (isset($_GET['report'])){
    //this will generate a report pdf
    $month = $_GET['report'];
    $rep = new report();
    $rep->generateReport($month);
}elseif (isset($_GET['inventory'])){
    //this will update blood qty
    $id = $_GET['inventory'];
    $blood = new Blood();
    $blood->updateQty($_GET['qty'],$id);
} elseif (isset($_POST['admin_reg'])) {
    //Registering new admin user
    $admin = new adminLogin();
    $admin->createUser();
} elseif (isset($_POST['admin_login'])) {
    //logging in admin user
    $admin = new adminLogin();
    $admin->log();
}elseif (isset($_POST['admin_deactivate'])) {
    //when user deactivates account
    $users = new adminLogin();
    $password = $_POST['password'];
    $users->deactivate($password);

}elseif (isset($_GET['deleteUser'])) {
    //delete user
    $users = new adminUsers();
    $user_id = $_GET['user_id'];
    $users->deleteUser($user_id);

}elseif (isset($_GET['getQty'])) {
    //get blood inventory
   
    $blood = new Blood();
    echo $blood->fetchBlood();
}elseif (isset($_GET['logout'])) {
    //when logging out clear sessions and direct user to login
    $sesHelper->clearAllSessions();
    header('location: /blood/login.php');
}