<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db = "projectfilm";

$conn = mysqli_connect($hostname, $username, $password, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>