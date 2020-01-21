<?php
require "include/db_connect.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Simple Chat - Find Chat Room</title>
    <?php include "include/head.php"; ?>
</head>
<body>

    <?php include "include/sidenav.php"; ?>

    <?php include "include/header.php"; ?>

    <div class="container">
        <div class="options">
            <?php
            $result = $db->query("SELECT * FROM chat_rooms ORDER BY id");
                while($row = $result->fetch_assoc()) {
                ?>
                    <a  class="large-button" href="chat.php?room=<?php echo $row["name"]; ?>">
                        <div>
                            <?php echo $row["name"]; ?>
                        </div>
                    </a>
                <?php                    
                }
            $db->close();
            ?>
        </div>
    </div>
   
</body>
</html> 