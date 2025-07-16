<?php
require_once 'includes/db.php';
session_start();
include 'templates/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'employer') {
    die("Access denied.");
}

$employer_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $app_id = $_POST['application_id'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE applications SET status = ? WHERE id = ?");
    $stmt->execute([$status, $app_id]);
}

$stmt = $pdo->prepare("
    SELECT applications.id AS application_id, users.name, users.email,
           jobs.title, applications.status, applications.applied_at
    FROM applications
    JOIN jobs ON applications.job_id = jobs.id
    JOIN users ON applications.user_id = users.id
    WHERE jobs.user_id = ?
    ORDER BY applications.applied_at DESC
");
$stmt->execute([$employer_id]);
$applicants = $stmt->fetchAll();
?>

<div class="wrapper">
  <h2>👥 Manage Applicants</h2>

  <?php if (count($applicants) == 0): ?>
    <p>No applicants yet.</p>
  <?php else: ?>
    <table class="app-table">
      <tr>
        <th>Job</th>
        <th>Applicant</th>
        <th>Email</th>
        <th>Applied At</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      <?php foreach ($applicants as $app): ?>
        <tr>
          <td><?= htmlspecialchars($app['title']) ?></td>
          <td><?= htmlspecialchars($app['name']) ?></td>
          <td><?= htmlspecialchars($app['email']) ?></td>
          <td><?= $app['applied_at'] ?></td>
          <td><?= $app['status'] ?></td>
          <td>
            <form method="post" style="display: flex; gap: 5px;">
              <input type="hidden" name="application_id" value="<?= $app['application_id'] ?>">
              <button name="status" value="Accepted" style="color:green;">✅ Accept</button>
              <button name="status" value="Rejected" style="color:red;">❌ Reject</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
</div>

<?php include 'templates/footer.php'; ?>
