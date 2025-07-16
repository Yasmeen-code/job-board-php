<?php
require_once 'includes/db.php';
include 'templates/header.php';
?>

<div class="wrapper">
  <main>
    <h2 style="text-align: center; margin-bottom: 30px; color: #64B5F6;">Available Jobs</h2>

    <div class="jobs">
      <?php
      $stmt = $pdo->query("SELECT * FROM jobs ORDER BY created_at DESC");
      while ($job = $stmt->fetch()):
      ?>
        <div class="job-card">
          <h3><?= htmlspecialchars($job['title']) ?></h3>
          <p><strong>Company:</strong> <?= htmlspecialchars($job['company']) ?></p>
          <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
          <p><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>
          <a href="job_details.php?id=<?= $job['id'] ?>">View Details</a>
        </div>
      <?php endwhile; ?>
    </div>
  </main>

  <?php include 'templates/footer.php'; ?>
</div>