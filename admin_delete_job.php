<?php
require_once 'includes/db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied.");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM jobs WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin_dashboard.php");
exit;
