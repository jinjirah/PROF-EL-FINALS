<?php
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Hub - Overview & Scenes</title>
    <?php include("css.php"); ?>
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="showcase-title">Overview & Iconic Scenes</h1>
                <p class="showcase-subtitle">Explore the high-octane sequences and scenic route timelines.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
         
            <div class="col-lg-4">
                <div class="display-card p-4 h-100">
                    <span class="card-meta">Production Overview</span>
                    <h3 class="text-white fw-bold mt-2 mb-3">The Franchise</h3>
                    <p class="text-secondary" style="font-size: 0.95rem; line-height: 1.6; color: #cbd5e1 !important;">
                        Pixar's Cars franchise blends cutting-edge visual technology with heartfelt storytelling. From the neon-drenched paths of Route 66 to international racing tracks, the series celebrates speed, community, and classic Americana.
                    </p>
                    <hr class="border-secondary my-4" style="--bs-border-opacity: .15;">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="btn-action-icon"><i class="fa-solid fa-film"></i></div>
                            <div>
                                <div class="small text-muted">Primary Studio</div>
                                <div class="text-white fw-medium">Pixar Animation Studios</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="btn-action-icon"><i class="fa-solid fa-palette"></i></div>
                            <div>
                                <div class="small text-muted">Visual Style</div>
                                <div class="text-white fw-medium">Ray-Traced Photorealism</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="col-lg-8">
                <div class="display-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-white fw-bold mb-0">Captured Cinematics</h4>
                        <?php if(isset($_SESSION['username'])): ?>
                            <a href="add_scene.php" class="btn btn-sm btn-primary-action"><i class="fa-solid fa-plus me-1"></i> Add Scene</a>
                        <?php endif; ?>
                    </div>

                    <div class="row g-3">
                        <?php
                        $sql = "SELECT * FROM overview ORDER BY scene_id ASC";
                        $query = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($query) == 0) {
                            echo "<div class='col-12 text-center py-4'><p class='text-muted'>No captured cinematic entries found.</p></div>";
                        }
                        while($row = mysqli_fetch_array($query)) {
                        ?>
                        <div class="col-12">
                            <div class="scene-card p-3 rounded-3" style="background: rgba(255,255,255,0.02); border: 1px solid var(--border-subtle);">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <span class="text-warning font-monospace small fw-bold">SCENE MODULE #<?= $row['scene_id'] ?></span>
                                        <h5 class="text-white fw-bold mt-1 mb-1"><?= htmlspecialchars($row['title']) ?></h5>
                                        <p class="text-muted small mb-2"><?= nl2br(htmlspecialchars($row['scene_description'])) ?></p>
                                    </div>
                                    <?php if(isset($_SESSION['username'])): ?>
                                    <div class="d-flex gap-2 ms-3">
                                        <a href="edit_scene.php?sid=<?= $row['scene_id'] ?>" class="btn-action-icon"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="delete_scene.php?sid=<?= $row['scene_id'] ?>" class="btn-action-icon text-danger" onclick="return confirm('Purge scene record?');"><i class="fa-solid fa-trash-can"></i></a>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                
                                <?php if(!empty($row['video_file'])): ?>
                                <div class="mt-2">
                                    <video controls class="w-100 rounded-3" style="max-height: 320px; background:#000;">
                                        <source src="<?= htmlspecialchars($row['video_file']) ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="text-muted small mt-1 font-monospace">
                                        <i class="fa-solid fa-video me-1"></i><?= htmlspecialchars($row['video_file']) ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("js.php"); ?>
</body>
</html>