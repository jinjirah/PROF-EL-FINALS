<?php
ob_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$hostname = "localhost";
$username = "root";
$password = "";
$database = "cars_movie_db";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}