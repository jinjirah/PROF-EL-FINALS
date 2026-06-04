<?php
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Hub - Collection</title>
    <?php include("css.php"); ?>
</head>
<body>
    <?php include("navbar.php"); ?>

 
    <div class="hero-banner">
        <img src="images/makween.gif" alt="Radiator Springs">
        <div class="hero-overlay">
            <h1 class="hero-title">Life Is A Highway</h1>
            <p class="hero-sub">Speed, friendship, and the road that changes everything.</p>
        </div>
    </div>

    <div class="container mt-4">

        <?php if(isset($_SESSION['status'])): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['status']); ?>
        <?php endif; ?>

        <div class="row align-items-center mb-4 row-gap-3">
            <div class="col-md-6">
                <h3 class="fw-bold text-white mb-0">Movie Directory</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end">
                <?php if(isset($_SESSION['username'])): ?>
                    <a href="add_movie.php" class="btn btn-sm btn-primary-action d-flex align-items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Add Film Entity
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <?php
            $sql = "SELECT * FROM home ORDER BY release_year DESC";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) == 0) {
                echo "<div class='col-12 text-center py-4'><p class='text-muted'>No movie records found.</p></div>";
            }
            while($row = mysqli_fetch_array($query)) {
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="display-card h-100 d-flex flex-column">
                    
<div class="movie-poster-wrap">
                    <img src="<?= htmlspecialchars($row['poster_image']) ?>" 
                         alt="<?= htmlspecialchars($row['title']) ?> poster"
                         class="movie-poster-img">
                </div>

                    <div class="p-4 d-flex flex-column flex-grow-1">
                        <div class="mb-2 d-flex justify-content-between align-items-start gap-2">
                            <h4 class="card-heading my-0 text-white fw-bold"><?= htmlspecialchars($row['title']) ?></h4>
                            <span class="badge bg-danger font-monospace"><?= htmlspecialchars($row['release_year']) ?></span>
                        </div>
                        <p class="text-secondary flex-grow-1 mb-4" style="font-size:0.92rem; line-height:1.5; color:#cbd5e1 !important;">
                            <?= nl2br(htmlspecialchars($row['description'])) ?>
                        </p>
                        <?php if(isset($_SESSION['username'])): ?>
                        <div class="pt-3 border-top d-flex justify-content-end gap-2" style="border-color:rgba(255,255,255,.1) !important;">
                            <a href="edit_movie.php?sid=<?= $row['movie_id'] ?>" class="btn-action-icon text-warning">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="delete_movie.php?sid=<?= $row['movie_id'] ?>" class="btn-action-icon text-danger"
                               onclick="return confirm('Purge movie permanently?');">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <style>
        .hero-banner {
            position: relative;
            width: 100%;
            max-height: 360px;
            overflow: hidden;
        }
        .hero-banner img {
            width: 100%;
            height: 360px;
            object-fit: cover;
            display: block;
            filter: brightness(0.55);
        }
        .hero-overlay {
            position: absolute;
            bottom: 30px;
            left: 40px;
        }
        .hero-title {
            color: var(--accent-gold);
            font-weight: 800;
            font-size: 2.2rem;
            text-shadow: 0 2px 8px rgba(0,0,0,0.7);
            margin-bottom: 6px;
        }
        .hero-sub {
            color: #e5e7eb;
            font-size: 1.05rem;
            text-shadow: 0 1px 4px rgba(0,0,0,0.6);
        }
        .movie-poster-wrap {
            width: 100%;
            height: 220px;
            overflow: hidden;
            border-radius: 16px 16px 0 0;
        }
        .movie-poster-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }
        .display-card:hover .movie-poster-img {
            transform: scale(1.04);
        }
    </style>

    <?php include("js.php"); ?>
</body>
</html>
