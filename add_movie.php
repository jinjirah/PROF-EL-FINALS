<?php 
include("conn.php"); 
if(!isset($_SESSION['username'])) { 
    header("Location: login.php"); 
    exit; 
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $release_year = mysqli_real_escape_string($conn, $_POST['release_year']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $poster_image = mysqli_real_escape_string($conn, $_POST['poster_image']);

    $sql = "INSERT INTO home (title, release_year, description, poster_image) VALUES ('$title', '$release_year', '$description', '$poster_image')";
    if(mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Movie successfully tracked inside dynamic index!";
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Registry - Add Film</title>
    <?php include("css.php"); ?>
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container" style="max-width: 650px; margin-top: 40px;">
        <div class="card p-5" style="background: #121821; border: 1px solid var(--border-subtle); border-radius: var(--card-radius);">
            <div class="d-flex align-items-center gap-3 mb-4">
                <i class="fa-solid fa-square-plus fa-2x text-danger"></i>
                <h2 class="section-header h3 mb-0 text-white">Add Movie</h2>
            </div>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Movie Title Name</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Release Calendar Year</label>
                    <input type="number" class="form-control" name="release_year" min="1900" max="2100" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Cinematic Synopsis Description</label>
                    <textarea class="form-control" name="description" rows="4"></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small fw-bold">Poster Filepath Route</label>
                    <input type="text" class="form-control font-monospace" name="poster_image" placeholder="images/poster_file.jpg">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger flex-grow-1 py-2" style="border-radius: var(--input-radius);">Add Movie Scene</button>
                    <a href="index.php" class="btn btn-outline-secondary px-4 py-2" style="border-radius: var(--input-radius);">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <?php include("js.php"); ?>
</body>
</html>