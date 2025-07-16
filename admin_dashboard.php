<?php
require_once 'includes/db.php';
include 'templates/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied.");
}
?>

<div class="container">
    <h2>Admin Dashboard</h2>

    <h3>All Users</h3>
    <table class="app-table">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th>
        </tr>
        <?php
        $stmt = $pdo->query("SELECT * FROM users");
        while ($user = $stmt->fetch()):
        ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['role'] ?></td>
            <td>
                <?php if ($user['role'] !== 'admin'): ?>
                    <a href="admin_delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                <?php else: ?>
                    ---
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3 style="margin-top:40px;">All Jobs</h3>
    <table class="app-table">
        <tr>
            <th>ID</th><th>Title</th><th>Company</th><th>Posted By</th><th>Action</th>
        </tr>
        <?php
        $stmt = $pdo->query("SELECT jobs.*, users.name AS employer FROM jobs JOIN users ON jobs.user_id = users.id");
        while ($job = $stmt->fetch()):
        ?>
        <tr>
            <td><?= $job['id'] ?></td>
            <td><?= htmlspecialchars($job['title']) ?></td>
            <td><?= htmlspecialchars($job['company']) ?></td>
            <td><?= htmlspecialchars($job['employer']) ?></td>
            <td>
                <a href="admin_delete_job.php?id=<?= $job['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include 'templates/footer.php'; ?>
