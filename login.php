<?php
require_once 'includes/db.php';
include 'templates/header.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<div class="wrapper">
    <main>
        <div class="form-container">
            <h2>Login</h2>

            <?php if (!empty($error)): ?>
                <p style="color: #FF9800; font-weight: bold;"><?= $error ?></p>
            <?php endif; ?>

            <form method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>

            <p>
                Don't have an account?
                <a href="register.php">Register here</a>
            </p>
        </div>
    </main>

    <?php include 'templates/footer.php'; ?>
</div>
