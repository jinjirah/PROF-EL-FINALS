<?php 
include("conn.php"); 
if(!isset($_SESSION['username'])) { 
    header("Location: login.php"); 
    exit; 
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
    $character_id = mysqli_real_escape_string($conn, $_POST['character_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $video_file = mysqli_real_escape_string($conn, $_POST['video_file']);
    $scene_description = mysqli_real_escape_string($conn, $_POST['scene_description']);

    $sql = "INSERT INTO overview (movie_id, character_id, title, video_file, scene_description) VALUES ('$movie_id', '$character_id', '$title', '$video_file', '$scene_description')";
    if(mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Segment timeline data successfully recorded!";
        header("Location: overview.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream Highlights Registry - Add Highlight</title>
    <?php include("css.php"); ?>
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container" style="max-width: 650px; margin-top: 40px;">
        <div class="card p-5" style="background: #121821; border: 1px solid var(--border-subtle); border-radius: var(--card-radius);">
            <div class="d-flex align-items-center gap-3 mb-4">
                <i class="fa-solid fa-photo-film fa-2x text-danger"></i>
                <h2 class="section-header h3 mb-0 text-white">Record Segment Highlight</h2>
            </div>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Scene Header Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-secondary small fw-bold">Origin Film Context</label>
                        <select name="movie_id" class="form-select" required>
                            <option value="">Choose Film Alignment...</option>
                            <?php
                            $m_query = mysqli_query($conn, "SELECT movie_id, title FROM home ORDER BY release_year DESC");
                            while($m_row = mysqli_fetch_array($m_query)) {
                                echo "<option value='".$m_row['movie_id']."'>".htmlspecialchars($m_row['title'])."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary small fw-bold">Featured Target Character Focus</label>
                        <select name="character_id" class="form-select" required>
                            <option value="">Choose Target Focus...</option>
                            <?php
                            $c_query = mysqli_query($conn, "SELECT character_id, name FROM characters ORDER BY name ASC");
                            while($c_row = mysqli_fetch_array($c_query)) {
                                echo "<option value='".$c_row['character_id']."'>".htmlspecialchars($c_row['name'])."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Media Filename Route</label>
                    <input type="text" class="form-control font-monospace" name="video_file" placeholder="videos/scene_track.mp4" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small fw-bold">Event Log Description Context</label>
                    <textarea class="form-control" name="scene_description" rows="4"></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger flex-grow-1 py-2" style="border-radius: var(--input-radius);">Add Scene</button>
                    <a href="overview.php" class="btn btn-outline-secondary px-4 py-2" style="border-radius: var(--input-radius);">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <?php include("js.php"); ?>
</body>
</html>