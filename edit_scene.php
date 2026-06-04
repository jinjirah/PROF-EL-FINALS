<?php
include("conn.php");
if(!isset($_SESSION['username'])) { header("Location: login.php"); exit; }

$id = mysqli_real_escape_string($conn, $_GET['sid']);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
    $character_id = mysqli_real_escape_string($conn, $_POST['character_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $video_file = mysqli_real_escape_string($conn, $_POST['video_file']);
    $scene_description = mysqli_real_escape_string($conn, $_POST['scene_description']);

    $sql = "UPDATE overview SET movie_id='$movie_id', character_id='$character_id', title='$title', video_file='$video_file', scene_description='$scene_description' WHERE scene_id='$id'";
    if(mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Timeline sequence configurations changed successfully.";
        header("Location: overview.php");
        exit;
    }
}

$query = mysqli_query($conn, "SELECT * FROM overview WHERE scene_id='$id'");
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream Highlights - Update Timeline Element</title>
    <?php include("css.php"); ?>
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container" style="max-width: 650px;">
        <div class="card p-5" style="background: #121821;">
            <div class="d-flex align-items-center gap-3 mb-4">
                <i class="fa-solid fa-film fa-2x text-danger"></i>
                <h2 class="section-header h3 mb-0">Modify Scene Highlight</h2>
            </div>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Scene Header Title</label>
                    <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-secondary small fw-bold">Origin Film Context</label>
                        <select name="movie_id" class="form-select" required>
                            <?php
                            $m_query = mysqli_query($conn, "SELECT movie_id, title FROM home ORDER BY release_year DESC");
                            while($m_row = mysqli_fetch_array($m_query)) {
                                $selected = ($m_row['movie_id'] == $row['movie_id']) ? "selected" : "";
                                echo "<option value='".$m_row['movie_id']."' $selected>".htmlspecialchars($m_row['title'])."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary small fw-bold">Featured Target Character Focus</label>
                        <select name="character_id" class="form-select" required>
                            <?php
                            $c_query = mysqli_query($conn, "SELECT character_id, name FROM characters ORDER BY name ASC");
                            while($c_row = mysqli_fetch_array($c_query)) {
                                $selected = ($c_row['character_id'] == $row['character_id']) ? "selected" : "";
                                echo "<option value='".$c_row['character_id']."' $selected>".htmlspecialchars($c_row['name'])."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Digital Track Media Filename Target Route</label>
                    <input type="text" class="form-control font-monospace" name="video_file" value="<?= htmlspecialchars($row['video_file']) ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small fw-bold">Event Log Description Context</label>
                    <textarea class="form-control" name="scene_description" rows="4"><?= htmlspecialchars($row['scene_description']) ?></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger flex-grow-1 py-2">Push Modification Records</button>
                    <a href="overview.php" class="btn btn-outline-secondary px-4 py-2" style="border-radius:10px;">Abort</a>
                </div>
            </form>
        </div>
    </div>
    <?php include("js.php"); ?>
</body>
</html>