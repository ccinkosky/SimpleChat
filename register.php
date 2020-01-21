<!DOCTYPE html>
<html>
<head>
    <title>Simple Chat - Register</title>
    <?php include "include/head.php"; ?>
</head>
<body>

    <?php include "include/sidenav.php"; ?>

    <?php include "include/header.php"; ?>
    
    <div class="container">
        <div class="options">
            <form action="register_user.php" method="post" onsubmit="return SimpleChat.checkRegistration();">
                <div class="warning" id="warning" <?php if(isset($_GET["taken"])){ ?>style="display:initial;" <?php } ?>>
                    <div id="warning-text">
                        Username is taken
                    </div>
                </div>
                <div class="row">
                      <div class="col-100">
                          <input type="text" id="username" name="username" placeholder="Username">
                          <input type="password" id="password" name="password" placeholder="Password">
                          <input type="password" id="password2" name="password2" placeholder="Re-enter Password">
                      </div>
                </div>
                <div class="row">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>

   
</body>
</html> 