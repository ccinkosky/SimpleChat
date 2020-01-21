<!DOCTYPE html>
<html>
<head>
    <title>Simple Chat</title>
    <?php include "include/head.php"; ?>
</head>
<body>

    <?php include "include/sidenav.php"; ?>

    <?php include "include/header.php"; ?>
    
    <?php if($_COOKIE["logged_in"] != "true"){ ?>
    <div class="container">
        <div class="options">
            <div class="home-title">
                Simple Chat
            </div>
            </a>
            <a  class="large-button" href="login.php">
                <div>
                    Sign In
                </div>
            </a>
            <a  class="large-button" href="register.php">
                <div>
                    Register
                </div>
            </a>
        </div>
    </div>
    <?php }else{ ?>
    <div class="container">
        <div class="options">
             <div class="home-title">
                Simple Chat
            </div>
            <a  class="large-button" href="new.php">
                <div>
                    New Chat Room
                </div>
            </a>
            <a  class="large-button" href="find.php">
                <div>
                    Find Chat Room
                </div>
            </a>
        </div>
    </div>
    <?php } ?>

   
</body>
</html> 