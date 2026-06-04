<?php
include("conn.php");
if(!isset($_SESSION['username'])) { header("Location: login.php"); exit; }

$id = mysqli_real_escape_string($conn, $_GET['sid']);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $release_year = mysqli_real_escape_string($conn, $_POST['release_year']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $poster_image = mysqli_real_escape_string($conn, $_POST['poster_image']);

    $sql = "UPDATE home SET title='$title', release_year='$release_year', description='$description', poster_image='$poster_image' WHERE movie_id='$id'";
    if(mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Movie cluster definitions changed successfully.";
        header("Location: index.php");
        exit;
    }
}

$query = mysqli_query($conn, "SELECT * FROM home WHERE movie_id='$id'");
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog Management - Update Film Parameters</title>
    <?php include("css.php"); ?>
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container" style="max-width: 650px;">
        <div class="card p-5" style="background: #121821;">
            <div class="d-flex align-items-center gap-3 mb-4">
                <i class="fa-solid fa-sliders fa-2x text-danger"></i>
                <h2 class="section-header h3 mb-0">Modify Film Configuration</h2>
            </div>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Movie Title Name</label>
                    <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Release Calendar Year</label>
                    <input type="number" class="form-control" name="release_year" value="<?= htmlspecialchars($row['release_year']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Cinematic Synopsis Description</label>
                    <textarea class="form-control" name="description" rows="4"><?= htmlspecialchars($row['description']) ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small fw-bold">Graphic Asset Poster Filepath Route</label>
                    <input type="text" class="form-control font-monospace" name="poster_image" value="<?= htmlspecialchars($row['poster_image']) ?>">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger flex-grow-1 py-2">Push Modification Records</button>
                    <a href="index.php" class="btn btn-outline-secondary px-4 py-2" style="border-radius:10px;">Abort</a>
                </div>
            </form>
        </div>
    </div>
    <?php include("js.php"); ?>
</body>
</html>