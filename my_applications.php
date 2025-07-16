<?php
require_once 'includes/db.php';
include 'templates/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'seeker') {
    die("Access denied.");
}

$user_id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("
    SELECT jobs.title, jobs.company, jobs.location, jobs.salary, applications.applied_at
    FROM applications
    JOIN jobs ON applications.job_id = jobs.id
    WHERE applications.user_id = ?
    ORDER BY applications.applied_at DESC
");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();
?>

<div class="wrapper">
  <h2>📄 My Applications</h2>

  <?php if (count($applications) == 0): ?>
    <p>You haven't applied to any jobs yet.</p>
  <?php else: ?>
    <?php foreach ($applications as $app): ?>
      <div class="job-card">
        <h3><?= htmlspecialchars($app['title']) ?></h3>
        <p><strong>Company:</strong> <?= htmlspecialchars($app['company']) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($app['location']) ?></p>
        <p><strong>Salary:</strong> <?= htmlspecialchars($app['salary']) ?></p>
        <p><small>Applied on: <?= $app['applied_at'] ?></small></p>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php include 'templates/footer.php'; ?>
