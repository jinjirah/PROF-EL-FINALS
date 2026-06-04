<?php 
include("conn.php"); 
if(!isset($_SESSION['username'])) { 
    header("Location: login.php"); 
    exit; 
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);

    $sql = "INSERT INTO characters (movie_id, name, description, image) VALUES ('$movie_id', '$name', '$description', '$image')";
    if(mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Character catalog item mapped to cluster.";
        header("Location: characters.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registry Index - New Profile</title>
    <?php include("css.php"); ?>
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container" style="max-width: 650px; margin-top: 40px;">
        <div class="card p-5" style="background: #121821; border: 1px solid var(--border-subtle); border-radius: var(--card-radius);">
            <div class="d-flex align-items-center gap-3 mb-4">
                <i class="fa-solid fa-user-plus fa-2x text-danger"></i>
                <h2 class="section-header h3 mb-0 text-white">Append Character Profile</h2>
            </div>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Character Nominal Identifier</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Anchor Movie Mapping Relational Context</label>
                    <select name="movie_id" class="form-select" required>
                        <option value="">Select Anchor Context Film...</option>
                        <?php
                        $m_query = mysqli_query($conn, "SELECT movie_id, title FROM home ORDER BY release_year DESC");
                        while($m_row = mysqli_fetch_array($m_query)) {
                            echo "<option value='".$m_row['movie_id']."'>".htmlspecialchars($m_row['title'])."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Biographical Content Log</label>
                    <textarea class="form-control" name="description" rows="4"></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small fw-bold">Visual Rendering Route Filepath</label>
                    <input type="text" class="form-control font-monospace" name="image" placeholder="images/rendering_asset.jpg">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger flex-grow-1 py-2" style="border-radius: var(--input-radius);">Commit Entity Storage</button>
                    <a href="characters.php" class="btn btn-outline-secondary px-4 py-2" style="border-radius: var(--input-radius);">Abort</a>
                </div>
            </form>
        </div>
    </div>
    <?php include("js.php"); ?>
</body>
</html>