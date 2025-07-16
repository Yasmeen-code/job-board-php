<?php
require_once 'includes/db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'seeker') {
    die("Access denied.");
}

if (!isset($_POST['job_id'])) {
    die("No job selected.");
}

$job_id = $_POST['job_id'];
$user_id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("SELECT * FROM applications WHERE job_id = ? AND user_id = ?");
$stmt->execute([$job_id, $user_id]);
$existing = $stmt->fetch();

if ($existing) {
    echo "<p style='color: orange; font-weight: bold; text-align:center;'>You have already applied to this job.</p>";
    echo "<p style='text-align:center;'><a href='index.php'>🔙 Back to Home</a></p>";
    exit;
}

$stmt = $pdo->prepare("INSERT INTO applications (job_id, user_id) VALUES (?, ?)");
$stmt->execute([$job_id, $user_id]);

echo "<p style='color: green; font-weight: bold; text-align:center;'>🎉 Application submitted successfully!</p>";
echo "<p style='text-align:center;'><a href='index.php'>🔙 Back to Home</a></p>";
