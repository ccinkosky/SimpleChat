<?php
session_start();
require "include/db_connect.php";

$roomname = $db->real_escape_string($_POST["roomname"]);
$username = $db->real_escape_string($_COOKIE["username"]);

$sql = "SELECT * FROM chat_rooms WHERE name = '".$roomname."'";
$result = $db->query($sql);
$count = 0;
while($row = $result->fetch_assoc()) {
    $count++;
}
if($count > 0){
    $db->close();
    header('Location: /new.php?taken=1');
}else{
    $sql = "INSERT INTO chat_rooms (name, username, created_timestamp) VALUES ('".$roomname."', '".$username."', ".time().")";
    $db->query($sql);
    $room_id = $db->insert_id;
    $db->close();

    setcookie("username", $_COOKIE["username"], 0, "/");
    setcookie("ip", $_SERVER['REMOTE_ADDR'], 0, "/");

    header('Location: chat.php?room='.$_POST["roomname"]);
}
?>