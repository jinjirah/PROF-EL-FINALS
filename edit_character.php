<?php 
include("conn.php"); 
if(!isset($_SESSION['username'])) { 
    header("Location: login.php"); 
    exit; 
}

$id = mysqli_real_escape_string($conn, $_GET['sid']);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);

    $sql = "UPDATE characters SET movie_id='$movie_id', name='$name', description='$description', image='$image' WHERE character_id='$id'";
    if(mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Character entry fields updated cleanly.";
        header("Location: characters.php");
        exit;
    }
}

$query = mysqli_query($conn, "SELECT * FROM characters WHERE character_id='$id'");
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiles Registry - Update Instance Data</title>
    <?php include("css.php"); ?>
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container" style="max-width: 650px; margin-top: 40px;">
        <div class="card p-5" style="background: #121821; border: 1px solid var(--border-subtle); border-radius: var(--card-radius);">
            <div class="d-flex align-items-center gap-3 mb-4">
                <i class="fa-solid fa-user-gear fa-2x text-danger"></i>
                <h2 class="section-header h3 mb-0 text-white">Modify Character Attributes</h2>
            </div>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Character Nominal Identifier</label>
                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($row['name'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Anchor Movie Mapping Relational Context</label>
                    <select name="movie_id" class="form-select" required>
                        <?php
                        $m_query = mysqli_query($conn, "SELECT movie_id, title FROM home ORDER BY release_year DESC");
                        while($m_row = mysqli_fetch_array($m_query)) {
                            $selected = ($m_row['movie_id'] == ($row['movie_id'] ?? '')) ? "selected" : "";
                            echo "<option value='".$m_row['movie_id']."' $selected>".htmlspecialchars($m_row['title'])."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Biographical Content Log</label>
                    <textarea class="form-control" name="description" rows="4"><?= htmlspecialchars($row['description'] ?? '') ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small fw-bold">Visual Rendering Route Filepath</label>
                    <input type="text" class="form-control font-monospace" name="image" value="<?= htmlspecialchars($row['image'] ?? '') ?>">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger flex-grow-1 py-2" style="border-radius: var(--input-radius);">Push Modification Records</button>
                    <a href="characters.php" class="btn btn-outline-secondary px-4 py-2" style="border-radius: var(--input-radius);">Abort</a>
                </div>
            </form>
        </div>
    </div>
    <?php include("js.php"); ?>
</body>
</html>