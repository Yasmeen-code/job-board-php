<?php
require_once 'includes/db.php';
session_start();
include 'templates/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employer') {
    die("Access denied.");
}

$user_id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("
    SELECT jobs.title, users.name AS applicant_name, users.email, applications.applied_at
    FROM applications
    JOIN jobs ON applications.job_id = jobs.id
    JOIN users ON applications.user_id = users.id
    WHERE jobs.user_id = ?
    ORDER BY applications.applied_at DESC
");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();
?>

<div class="wrapper">
  <h2>👥 Applicants for Your Jobs</h2>

  <?php if (count($applications) == 0): ?>
    <p>No one has applied to your jobs yet.</p>
  <?php else: ?>
    <?php foreach ($applications as $app): ?>
      <div class="job-card">
        <h3><?= htmlspecialchars($app['title']) ?></h3>
        <p><strong>Applicant:</strong> <?= htmlspecialchars($app['applicant_name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($app['email']) ?></p>
        <p><small>Applied on: <?= $app['applied_at'] ?></small></p>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php include 'templates/footer.php'; ?>
