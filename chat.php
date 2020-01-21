<?php
require "include/db_connect.php";

if(empty($_GET["room"])){
    $result = $db->query("SELECT * FROM chat_rooms ORDER BY RAND() LIMIT 1");
    while($row = $result->fetch_assoc()) {
        $room = $row["name"];
    }
} else {
    $room = urldecode($_GET["room"]);
}
$room_array = array();
if(strpos($room,",") === false){
    $result = $db->query("SELECT * FROM chat_rooms WHERE name = '".$db->real_escape_string($room)."'");
    while($row = $result->fetch_assoc()) {
        array_push($room_array,$row["id"]);
    }
}else{
    $rooms = explode(",",$room);
    foreach($rooms as $r){
        $result = $db->query("SELECT * FROM chat_rooms WHERE name = '".$db->real_escape_string($r)."'");
        while($row = $result->fetch_assoc()) {
            array_push($room_array,$row["id"]);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Simple Chat</title>
    <?php 
    if(!isset($_COOKIE["logged_in"])){
       echo "<script>window.location = '/';</script>"; 
    }
    ?>
    <?php include "include/head.php"; ?>
</head>
<body>

    <?php include "include/sidenav.php"; ?>

    <?php include "include/header.php"; ?>
    
    <div class="container">
        <div class="options">
            <div class="message-area" id="message-area">
                <?php
                $result = $db->query("SELECT m.id, m.username, m.ip, m.timestamp, m.message, c.name FROM messages m, chat_rooms c WHERE m.chat_room_id IN (".$db->real_escape_string(implode(",",$room_array)).") AND m.chat_room_id = c.id ORDER BY m.id");
                while($row = $result->fetch_assoc()) {
                    if($_COOKIE["username"] == $row["username"] && $_COOKIE["ip"] == $row["ip"]){
                        ?>
                        <div class="message-me">
                            <div class="message-room">Room: <?php echo $row["name"]; ?></div>
                            <div class="message-username">
                                <?php echo $row["username"]; ?>
                                <span class="message-timestamp"><script type="text/javascript">document.write(SimpleChat.convertTime(<?php echo $row["timestamp"]; ?>));</script></span>
                            </div>
                            <div class="message-text">
                                <?php echo $row["message"]; ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="message-you">
                            <div class="message-room">Room: <?php echo $row["name"]; ?></div>
                            <div class="message-username">
                                <span class="message-timestamp"><script type="text/javascript">document.write(SimpleChat.convertTime(<?php echo $row["timestamp"]; ?>));</script></span> <?php echo $row["username"]; ?>
                            </div>
                            <div class="message-text">
                                <?php echo $row["message"]; ?>
                            </div>
                        </div>
                        <?php
                    }
                    $last_message_id = $row["id"];
                }
                if(!isset($last_message_id)){
                    $last_message_id = 0;
                }
                $db->close();
                ?>
                <script type="text/javascript">
                    document.getElementById("message-area").scrollTop = document.getElementById("message-area").scrollHeight;
                </script>
            </div>
            <form onsubmit="SimpleChat.addMessage(); return false;" method="post">
                <div class="row">
                      <div class="col-100">
                            <input type="text" id="message" name="message" placeholder="Message...">
                            <input type="hidden" id="room_id" value="<?php echo implode(",",$room_array); ?>">
                            <input type="hidden" id="last_message" value="<?php echo $last_message_id; ?>">
                      </div>
                </div>
                <div class="row">
                    <input type="submit" id="submit-message" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        SimpleChat.updateMessages();
    </script>
</body>
</html> 