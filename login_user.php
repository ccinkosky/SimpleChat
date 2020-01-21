<?php
require "include/db_connect.php";

$username = $db->real_escape_string($_POST["username"]);
$password = $db->real_escape_string(hash("sha256",$_POST["password"]));

$sql = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";
$result = $db->query($sql);
$count = 0;
while($row = $result->fetch_assoc()) {
    $count++;
}
$db->close();

if($count > 0){
    setcookie("username", $_POST["username"], 0, "/");
    setcookie("ip", $_SERVER['REMOTE_ADDR'], 0, "/");
    setcookie("logged_in", "true", 0, "/");

    header('Location: /');
}else{
    header('Location: login.php?invalid=1');
}
?>