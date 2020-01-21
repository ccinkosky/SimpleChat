<?php
require "include/db_connect.php";

$ip = $db->real_escape_string($_POST["ip"]);
$username = $db->real_escape_string($_POST["username"]);
$message = $db->real_escape_string($_POST["message"]);
$room_id = $db->real_escape_string(explode(",",$_POST["room_id"])[0]);

$db->query("INSERT INTO messages (
        username, 
        ip, 
        chat_room_id, 
        timestamp, 
        message
    ) VALUES (
        '".$username."',
        '".$ip."',
        ".$room_id.",
        ".time().",
        '".$message."'
    )");
$message_id = $db->insert_id;

$result = $db->query("SELECT * FROM chat_rooms WHERE id = ".$room_id);
while($row = $result->fetch_assoc()) {
    $roomname = $row["name"];   
}

$db->close();
                                   
echo '{
   "message_id" : "'.$message_id.'",
   "timestamp"  : "'.time().'",
   "message"    : "'.$_POST["message"].'",
   "username"   : "'.$_POST["username"].'",
   "roomname"   : "'.$roomname.'"
}';
?>