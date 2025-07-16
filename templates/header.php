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
       <header>
  <div class="header-content">
    <h1>🌟 Job Board</h1>
    <nav>
      <a href="index.php">🏠 Home</a>

      <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'employer'): ?>
        <a href="add_job.php">➕ Add Job</a>
        <a href="manage_applicants.php">👥 Manage Applicants</a>
      <?php endif; ?>

      <?php if (isset($_SESSION['user'])): ?>
        <a href="profile.php">👤 <?= htmlspecialchars($_SESSION['user']['name']) ?></a>
        <a href="logout.php">🚪 Logout</a>
      <?php else: ?>
        <a href="login.php">🔐 Login</a>
        <a href="register.php">📝 Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
