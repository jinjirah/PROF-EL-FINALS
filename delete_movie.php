<?php
include('conn.php');
if(!isset($_SESSION['username'])) { 
    header("Location: login.php"); 
    exit; 
}

$id = mysqli_real_escape_string($conn, $_GET['sid']);

mysqli_query($conn, "DELETE FROM home WHERE movie_id='$id'");
$_SESSION['status'] = "Franchise track entry dropped successfully.";
header('Location: index.php');
exit;