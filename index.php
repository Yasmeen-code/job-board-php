<?php
require_once 'includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Job Board</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Available Jobs</h1>

  <div class="jobs">
    <?php
      $stmt = $pdo->query("SELECT * FROM jobs ORDER BY created_at DESC");
      while ($job = $stmt->fetch()):
    ?>
      <div class="job-card">
        <h2><?= htmlspecialchars($job['title']) ?></h2>
        <p><strong>Company:</strong> <?= htmlspecialchars($job['company']) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
        <p><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>
        <a href="#">View Details</a>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
