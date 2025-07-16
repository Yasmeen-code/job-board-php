<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Job Board</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <header class="main-header">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h1>🌟 Job Board</h1>
            </div>

            <div class="header-right">
                <nav>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'seeker'): ?>
                        <a href="my_applications.php">📄 My Applications</a>
                    <?php elseif (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'employer'): ?>
                        <a href="view_applicants.php">👥 View Applicants</a>
                    <?php endif; ?>

                    <a href="index.php">🏠 Home</a>

                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'employer'): ?>
                        <a href="add_job.php">➕ Add Job</a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="user-info">👤 <?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                        <a href="logout.php">🚪 Logout</a>
                    <?php else: ?>
                        <a href="login.php">🔐 Login</a>
                        <a href="register.php">📝 Register</a>
                    <?php endif; ?>
                </nav>
            </div>
        </header>