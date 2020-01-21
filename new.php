<!DOCTYPE html>
<html>
<head>
    <title>Simple Chat - New Chat Room</title>
    <?php include "include/head.php"; ?>
</head>
<body>

    <?php include "include/sidenav.php"; ?>

    <?php include "include/header.php"; ?>
    
    <div class="container">
        <div class="options">
            <div class="warning" id="warning" <?php if(isset($_GET["taken"])){ ?>style="display:initial;" <?php } ?>>
                    <div>
                        Room already exists
                    </div>
                </div>
            <form action="create_new.php" method="post" onsubmit="return SimpleChat.checkRoomName();">
                <div class="row">
                      <div class="col-100">
                            <input type="text" id="roomname" name="roomname" placeholder="Chat Room Name">
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