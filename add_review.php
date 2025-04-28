<?php

require 'config.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $rid = (int)$_POST['restaurant_id'];
    $rating  = (int)$_POST['rating'];
    $comment = trim($_POST['comment'] ?? '');

    $stmt = $pdo->prepare(
      'INSERT INTO reviews (restaurant_id, user_id, rating, comment)
       VALUES (?, ?, ?, ?)'
    );
    $stmt->execute([$rid, $_SESSION['user_id'], $rating, $comment]);
}

header("Location: restaurant.php?id=$rid");
exit;