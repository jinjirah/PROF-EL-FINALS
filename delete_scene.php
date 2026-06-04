<?php
include('conn.php');
if(!isset($_SESSION['username'])) { 
    header("Location: login.php"); 
    exit; 
}

$id = mysqli_real_escape_string($conn, $_GET['sid']);

mysqli_query($conn, "DELETE FROM overview WHERE scene_id='$id'");
$_SESSION['status'] = "Structural segment clip dropped successfully.";
header('Location: overview.php');
exit;