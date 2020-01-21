<?php
require "include/db_connect.php";

$username = $db->real_escape_string($_POST["username"]);
$password = $db->real_escape_string(hash("sha256",$_POST["password"]));

$sql = "SELECT * FROM users WHERE username = '".$username."'";
$result = $db->query($sql);
$count = 0;
while($row = $result->fetch_assoc()) {
    $count++;
}
if($count > 0){
    $db->close();
    header('Location: /register.php?taken=1');
}else{
    $sql = "INSERT INTO users (username, password) VALUES ('".$username."', '".$password."')";
    $db->query($sql);
    $db->close();

    setcookie("username", $_POST["username"], 0, "/");
    setcookie("ip", $_SERVER['REMOTE_ADDR'], 0, "/");
    setcookie("logged_in", "true", 0, "/");

    header('Location: /');
}
?>