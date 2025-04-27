<?php
// login.php
require 'config.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$u]);
    $user = $stmt->fetch();

    if ($user && password_verify($p, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        $errors[] = 'Invalid credentials.';
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Log In</title></head>
<body>
  <h1>Log In</h1>
  <?php foreach($errors as $e) echo "<p style='color:red;'>$e</p>"; ?>
  <form method="POST">
    <label>Username: <input name="username"></label><br>
    <label>Password: <input type="password" name="password"></label><br>
    <button type="submit">Log In</button>
  </form>
  <p>No account? <a href="register.php">Register here</a></p>
</body>
</html>