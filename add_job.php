<?php
require_once 'includes/db.php';
include 'templates/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'employer') {
    die("<p style='color:red;'>⛔ Access denied. Employers only.</p>");
}

$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title    = $_POST['title'];
    $desc     = $_POST['description'];
    $company  = $_POST['company'];
    $location = $_POST['location'];
    $salary   = $_POST['salary'];
    $user_id  = $_SESSION['user']['id'];

    $stmt = $pdo->prepare("INSERT INTO jobs (title, description, company, location, salary, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $desc, $company, $location, $salary, $user_id]);

    $success = "✅ Job added successfully!";
}
?>

<h2>Add New Job</h2>

<?php if ($success): ?>
  <p style="color: green; font-weight: bold;"><?= $success ?></p>
<?php endif; ?>

<form method="post">
    <input type="text" name="title" placeholder="Job Title" required>
    <textarea name="description" placeholder="Job Description" required></textarea>
    <input type="text" name="company" placeholder="Company Name" required>
    <input type="text" name="location" placeholder="Location" required>
    <input type="text" name="salary" placeholder="Salary" required>
    <button type="submit">Add Job</button>
</form>

<?php include 'templates/footer.php'; ?>
