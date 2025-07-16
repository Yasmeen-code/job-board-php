<?php
require_once 'includes/db.php';
include 'templates/header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p style='color:red; text-align:center;'>Invalid Job ID.</p>";
    include 'templates/footer.php';
    exit;
}

$job_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();

if (!$job) {
    echo "<p style='color:red; text-align:center;'>Job not found.</p>";
    include 'templates/footer.php';
    exit;
}
?>

<div class="wrapper">
    <main>
        <div class="job-card" style="max-width: 700px; margin: auto;">
            <h2><?= htmlspecialchars($job['title']) ?></h2>
            <p><strong>Company:</strong> <?= htmlspecialchars($job['company']) ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
            <p><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>
            <p><strong>Description:</strong><br> <?= nl2br(htmlspecialchars($job['description'])) ?></p>

            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'seeker'): ?>
                <form method="post" action="apply.php">
                    <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
                    <button type="submit" class="apply-btn">✅ Apply Now</button>
                </form>
            <?php else: ?>
                <p style="margin-top:20px; font-size:14px; color:#888;">
                    Only job seekers can apply.
                </p>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'templates/footer.php'; ?>
</div>