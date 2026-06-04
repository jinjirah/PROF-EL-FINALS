<?php
include("conn.php");

if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = hash('sha256', $_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user_data = mysqli_fetch_array($result);
        $_SESSION['username'] = $user_data['username'];
        
        mysqli_query($conn, "UPDATE users SET last_login=NOW() WHERE admin_id='".$user_data['admin_id']."'");
        
        header('Location: index.php');
        exit;
    } else {
        $error = "The validation data supplied doesn't align with local system profiles.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Dashboard Access Authentication</title>
    <?php include("css.php"); ?>
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="card p-4 shadow-lg w-100" style="max-width: 420px; border-radius: 20px; background: #121821;">
            <div class="text-center my-3">
                <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle rounded-circle mb-3" style="width: 64px; height: 64px; background-color: rgba(255,77,77,0.1) !important;">
                    <i class="fa-solid fa-user-shield fa-2x text-danger"></i>
                </div>
                <h3 class="fw-bold tracking-tight">Cars Admin</h3>
               
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger py-2 text-center border-0 small" style="background-color: rgba(255,77,77,0.15); color: #ff6666; border-radius: 8px;">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold">Username</label>
                    <input type="text" class="form-control" name="username" required autocomplete="off">
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small fw-bold">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-danger w-100 py-2.5 fw-bold d-flex align-items-center justify-content-center gap-2 mb-2">
                    <i class="fa-solid fa-key"></i> Log In
                </button>
            </form>
        </div>
    </div>
    <?php include("js.php"); ?>
</body>
</html>