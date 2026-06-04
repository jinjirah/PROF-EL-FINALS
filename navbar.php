<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="images/cars_logo.png" alt="Cars Logo">
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'characters.php') ? 'active' : '' ?>" href="characters.php">Characters</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'overview.php') ? 'active' : '' ?>" href="overview.php">Overview</a>
                </li>
            
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item ms-lg-3">
                        <a href="logout.php" class="btn btn-sm btn-outline-danger px-3 py-1.5 font-monospace" style="border-radius: 8px; font-size: 0.85rem;">Sign Out (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3">
                        <a href="login.php" class="btn btn-sm btn-outline-light px-3 py-1.5" style="border-radius: 8px; font-size: 0.85rem; border-color: rgba(255,255,255,0.3);">Admin Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>