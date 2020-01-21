<?php
require "include/db_connect.php";

$room_id = $db->real_escape_string($_POST["id"]);
$last_message_id = $db->real_escape_string($_POST["last_message_id"]);
$sql = "SELECT m.id, m.ip, m.username, m.timestamp, m.message, c.name FROM messages m, chat_rooms c WHERE m.chat_room_id IN (".$room_id.") AND m.chat_room_id = c.id AND m.id > ".$last_message_id." ORDER by m.id";
$result = $db->query($sql);
echo "[";
$count = 0;
while($row = $result->fetch_assoc()) {
    if($count != 0){ echo",{"; } else { echo "{"; } ?>
    "message_id" : "<?php echo $row["id"]; ?>",
    "ip" : "<?php echo $row["ip"]; ?>",
    "username" : "<?php echo $row["username"]; ?>",
    "timestamp" : "<?php echo $row["timestamp"]; ?>",
    "message" : "<?php echo $row["message"]; ?>",
    "current_user" : "<?php echo $_COOKIE["username"]; ?>",
    "current_user_ip" : "<?php echo $_COOKIE["ip"]; ?>",
    "roomname" : "<?php echo $row["name"]; ?>"
    }
    <?php
    $count++;
}
echo "]";
$db->close();
?>