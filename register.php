<?php

require 'config.php';

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';

    if(strlen($u) < 3){
        $errors[] = 'Your Username is too short.';
    }
    if(strlen($p) < 6){
        $errors[] = 'Password must be 6 or more characters.';
    }

    if(!$errors){
        try{
            $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
            $stmt->execute([$u]);
            if($stmt->fetch()) {
            $errors[] = 'Username already taken.';
            } else {
            $hash = password_hash($p, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)');
            $stmt->execute([$u, $hash]);
            header('Location: login.php');
            exit;
            }
        } catch (PDOException $ex) {
            echo "<p style='color:red;'>SQL error: " . htmlspecialchars($ex->getMessage()) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="style/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Register</title>
</head>
<body>
  <h1>Sign Up</h1>
  <?php foreach($errors as $e) echo "<p style='color:red;'>$e</p>"; ?>
  <form method="POST">
    <label>Username: <input name="username"></label><br>
    <label>Password: <input type="password" name="password"></label><br>
    <button type="submit">Register</button>
  </form>
  <p>Already have an account? <a href="login.php">Log in</a></p>
</body>
</html>