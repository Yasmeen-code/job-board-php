<?php
require_once 'includes/db.php';
include 'templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $role]);

    $user_id = $pdo->lastInsertId();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    $_SESSION['user'] = $user;

    header("Location: index.php");
    exit;
}
?>

<div class="wrapper">
    <main>
        <div class="form-container">

            <h2>Register</h2>

            <form method="post">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="seeker">Job Seeker</option>
                    <option value="employer">Employer</option>
                </select>
                <button type="submit">Register</button>
            </form>

            <p style="margin-top: 10px;">
                Already have an account?
                <a href="login.php">Login here</a>
            </p>

        </div>
    </main>

    <?php include 'templates/footer.php'; ?>
</div>
