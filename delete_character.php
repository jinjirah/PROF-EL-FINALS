<?php
include('conn.php');
if(!isset($_SESSION['username'])) { 
    header("Location: login.php"); 
    exit; 
}

$id = mysqli_real_escape_string($conn, $_GET['sid']);

mysqli_query($conn, "DELETE FROM characters WHERE character_id='$id'");
$_SESSION['status'] = "Profile entity entry dropped cleanly.";
header('Location: characters.php');
exit;