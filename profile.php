<?php
require_once 'includes/db.php';
session_start();
include 'templates/header.php';

if (!isset($_SESSION['user'])) {
    die("Access denied.");
}

$user_id = $_SESSION['user']['id'];
$user = $_SESSION['user'];

$stmt = $pdo->prepare("
    SELECT jobs.title, jobs.company, jobs.location, applications.status, applications.applied_at
    FROM applications
    JOIN jobs ON applications.job_id = jobs.id
    WHERE applications.user_id = ?
    ORDER BY applications.applied_at DESC
");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();
?>

<div class="wrapper">
  <h2>👤 My Profile</h2>
  <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
  <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
  <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>

  <h3 style="margin-top: 30px;">📄 My Applications</h3>
  <?php if (count($applications) == 0): ?>
    <p>You haven't applied to any jobs yet.</p>
  <?php else: ?>
    <table class="app-table">
      <tr>
        <th>Job</th>
        <th>Company</th>
        <th>Location</th>
        <th>Applied At</th>
        <th>Status</th>
      </tr>
      <?php foreach ($applications as $app): ?>
        <tr>
          <td><?= htmlspecialchars($app['title']) ?></td>
          <td><?= htmlspecialchars($app['company']) ?></td>
          <td><?= htmlspecialchars($app['location']) ?></td>
          <td><?= $app['applied_at'] ?></td>
          <td><?= $app['status'] ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
</div>

<?php include 'templates/footer.php'; ?>
