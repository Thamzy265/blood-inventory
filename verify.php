<?php
 if (isset($_GET['msg'])){
     $msg = $_GET['msg'];
 }else{
     $msg = null;
 }
?>
<?php require_once "functions/sessionHelper.php"?>
<?php
$ses = new sessionHelper();
$ses->isLogged();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/st.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-danger bg-danger fixed-top">
    
    <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-light" href="#">Home |<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#" tabindex="-1" aria-disabled="true">About |</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#" tabindex="-1" aria-disabled="true">Support </a>
            </li>
        </ul>
    </div>
    <div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="login.php" class="nav-link text-light">Login |</a>
            </li>
            <li>
                <a href="register.php" class="nav-link text-light">Register</a>
            </li>
        </ul>
    </div>
</nav>
<h1 class="text-center text-light bg-lr pb-1"><a class="text-light" href="index.php">BLOOD BANK</a></h1>
<div class="d-flex justify-content-center flex-column container">
    
    
              
    <div class="d-flex justify-content-center">
        <div class="">
            <p class="lead text-danger text-center main-p">Enter your verification code</p>
            <p class="text-danger text-center"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];} ;?></p>
            <form action="route/route.php" method="post">
                <div class="form-group">
                  <input type="text" name="code" id="code" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Verification code</small>
                </div>
                <button name="verification" class="btn btn-success">Submit</button>
            </form>
        </div>
        
    </div>
</div>
</body>
</html>