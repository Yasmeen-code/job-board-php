<?php
require_once 'includes/db.php';
include 'templates/header.php';
?>
<div class="wrapper">
  <main>
    <!-- Header and search input -->
    <div class="jobs-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
      <h2 style="color: #64B5F6;">Available Jobs</h2>
      <input type="text" id="searchInput" placeholder="Search..." style="padding: 8px 12px; font-size: 16px; border-radius: 6px; border: none; width: 250px;">
    </div>

    <!-- Jobs list (results will be dynamically updated) -->
    <div id="jobList" class="jobs">
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

<script>
  const searchInput = document.getElementById('searchInput');
  const jobList = document.getElementById('jobList');

  searchInput.addEventListener('input', function() {
    const query = this.value;

    fetch('live_search.php?q=' + encodeURIComponent(query))
      .then(response => response.text())
      .then(data => {
        jobList.innerHTML = data;
      });
  });
</script>

