<?php
require_once 'includes/db.php';

$q = $_GET['q'] ?? '';
$q = trim($q);

$stmt = $pdo->prepare("SELECT * FROM jobs WHERE title LIKE ? OR company LIKE ? OR location LIKE ? ORDER BY created_at DESC");
$stmt->execute(["%$q%", "%$q%", "%$q%"]);

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
