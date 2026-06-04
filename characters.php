<?php
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Hub - Characters</title>
    <?php include("css.php"); ?>
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="showcase-title">Meet the Cast</h1>
                <p class="showcase-subtitle">The legendary racers and unforgettable citizens of Radiator Springs.</p>
            </div>
        </div>

        <div class="row align-items-center mb-4 row-gap-3">
            <div class="col-md-6">
                <h3 class="fw-bold text-white mb-0">Rosters</h3>
            </div>
            <div class="col-md-6 d-flex flex-wrap justify-content-md-end align-items-center gap-3">
                <form action="characters.php" method="GET" class="d-flex flex-grow-1 flex-md-grow-0" style="max-width: 280px; width: 100%;">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Search characters...">
                        <button type="submit" class="btn btn-primary-action px-3"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <?php if(isset($_SESSION['username'])): ?>
                    <a href="add_character.php" class="btn btn-sm btn-primary-action d-flex align-items-center gap-2"><i class="fa-solid fa-plus"></i> Add Character</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <?php
            $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
            $sql = "SELECT * FROM characters";
            if (!empty($search)) {
                $sql .= " WHERE name LIKE '%$search%'";
            }
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) == 0) {
                echo "<div class='col-12 text-center py-4'><p class='text-muted'>No matched character fields found.</p></div>";
            }
            while($row = mysqli_fetch_array($query)) {
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="display-card h-100 d-flex flex-column">
                    <!-- Character Image -->
                    <?php if(!empty($row['image'])): ?>
                    <div class="movie-poster-wrap">
                        <img src="<?= htmlspecialchars($row['image']) ?>"
                             alt="<?= htmlspecialchars($row['name']) ?>"
                             class="movie-poster-img">
                    </div>
                    <?php endif; ?>

                    <div class="p-4 d-flex flex-column flex-grow-1">
                        <h4 class="card-heading mt-1 mb-2"><?= htmlspecialchars($row['name']) ?></h4>
                        <p class="text-secondary flex-grow-1 mb-4" style="font-size: 0.92rem; line-height: 1.5; color: #cbd5e1 !important;">
                            <?= nl2br(htmlspecialchars($row['description'])) ?>
                        </p>
                        <?php if(isset($_SESSION['username'])): ?>
                        <div class="pt-3 border-top d-flex justify-content-end gap-2" style="border-color:rgba(255,255,255,.1) !important;">
                            <a href="edit_character.php?sid=<?= $row['character_id'] ?>" class="btn-action-icon"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="delete_character.php?sid=<?= $row['character_id'] ?>" class="btn-action-icon text-danger" onclick="return confirm('Purge character permanently?');"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <style>
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
