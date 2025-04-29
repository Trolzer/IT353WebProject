<?php

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
        $errors[] = 'Invalid credentials. Username or Password is incorrect or does not exist.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style/global.css">
  <link rel="stylesheet" href="style/forms.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <title>Log In</title>

</head>
<body>
  <?php foreach($errors as $e) echo "<p style='color:red; text-align:center;'>$e</p>"; ?>
  <form method="POST">
    <h1>Log In</h1>
    <label>Username: <input type="text" name="username"></label><br>
    <label>Password: <input type="password" name="password"></label><br>
    <button type="submit">Log In</button>
    <p>No account? <a href="register.php">Register here</a></p>
  </form>
</body>
</html>