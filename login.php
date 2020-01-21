<!DOCTYPE html>
<html>
<head>
    <title>Simple Chat - Login</title>
    <?php include "include/head.php"; ?>
</head>
<body>

    <?php include "include/sidenav.php"; ?>

    <?php include "include/header.php"; ?>
    
    <div class="container">
        <div class="options">
            <form action="login_user.php" method="post">
                <div class="warning" id="warning" <?php if($_GET["invalid"] == 1){ ?>style="display:initial;" <?php } ?>>
                    <div>
                        Incorrect Username or Password
                    </div>
                </div>
                <div class="row">
                      <div class="col-100">
                          <input type="text" id="username" name="username" placeholder="Username">
                          <input type="password" id="password" name="password" placeholder="Password">
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