<?php
$servername = "localhost";
$username = "simplechat";
$password = "password";
$database = "simple_chat";

$db = new mysqli($servername, $username, $password, $database);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
