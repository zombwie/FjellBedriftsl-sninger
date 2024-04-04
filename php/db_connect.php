<?php

$server = "localhost";
$user = "root";
$pw = "";
$db = "fjeltickets";

$conn = mysqli_connect($server, $user, $pw, $db);

if (!$conn) {
    echo "Connection failed!";
}
