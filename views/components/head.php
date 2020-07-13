<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>BloodBank System</title>
</head>
<body>
    <header>
      <nav class="d-flex">
          <div class="lf-nav bg-head d-flex justify-content-center align-items-center">
            <a class="navbar-brand text-light"><!--<img id="logo" src="../images/bb logo.png" alt="" srcset="">--><span class="bolder">Blood</span> Bank</a>
            
          </div>
        
          

          <div id="my-nav" class="bg-l d-flex justify-content-between">
                <p class="pt-5 pl-2 ti-color">
                    <?php
                    if($_GET['page']=='home' || $_GET['page']=='admin'){
                        echo ' ';
                    }elseif($_GET['page']=='group'){
                        echo "FIND BLOOD GROUP";
                    }elseif($_GET['page']=='profile'){
                        echo "PROFILE";
                    }elseif($_GET['page']=='account'){
                        echo "ACCOUNT";
                    }elseif($_GET['page']=='admin_accounts'){
                        echo "ADMIN ACCOUNTS";
                    }elseif($_GET['page']=='admin_users'){
                        echo "REGISTERED USERS";
                    }elseif($_GET['page']=='admin_inventory'){
                        echo "BLOOD INVENTORY";
                    }elseif($_GET['page']=='admin_emergency'){
                        echo "EMEGENCY LIST";
                    }elseif($_GET['page']=='admin_messages'){
                        echo "Messages";
                    }
                    ?>
                   
                </p>
                <a class="nav-link cus-color" href="../route/route.php?logout=true" tabindex="-1">LogOut</a>
          </div>
      </nav>
    </header>