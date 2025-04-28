<?php

require 'config.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM restaurants WHERE id = ?');
$stmt->execute([$id]);
$rest = $stmt->fetch();
if (!$rest) {
    http_response_code(404);
    echo "Restaurant not found.";
    exit;
}

// pull reviews
$stmt = $pdo->prepare(
  'SELECT r.rating, r.comment, r.created_at, u.username
   FROM reviews r
   JOIN users u ON r.user_id = u.id
   WHERE r.restaurant_id = ?
   ORDER BY r.created_at DESC'
);
$stmt->execute([$id]);
$reviews = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?=htmlspecialchars($rest['name'])?></title>
  <link rel="stylesheet" href="style/timbers.css">
</head>
<body>
  <header>
  <div class="headerLogo" onclick="window.location='index.php'">Redbird Eats</div>
    <div style="position:absolute; top:10px; right:10px;">
      <?php if (!empty($_SESSION['user_id'])): ?>
        Hello, <?=htmlspecialchars($_SESSION['username'])?> |
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php">Log in</a> |
        <a href="register.php">Sign up</a>
      <?php endif; ?>
    </div>
  </header>

  <h1 class="resturantName"><?=htmlspecialchars($rest['name'])?></h1>
  <div class="imgRoot">
    <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
    
    <?php 
        $files = scandir($rest['image_path']);
        foreach ($files as $file) {
          $filePath = $rest['image_path'] . '/' . $file;
          if (is_file($filePath)){
            echo "<img src='" . $rest['image_path'] . '/' . $file . "' class='slides'>";
          }
        }
      ?>
    <button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
  </div>

  <div class="locationInfo">
    <?= $rest['map_embed'] ?>
  </div>
  
  <section class="reviews">
    <h2>Reviews</h2>
    <?php if ($reviews): ?>
      <?php foreach($reviews as $r): ?>
        <div style="border-bottom:1px solid #ccc; margin-bottom:8px;">
          <strong><?=htmlspecialchars($r['username'])?></strong>
          (<?=date('M j, Y g:ia', strtotime($r['created_at']))?>)
          — Rating: <?= (int)$r['rating'] ?>/5
          <p><?=nl2br(htmlspecialchars($r['comment']))?></p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No reviews yet.</p>
    <?php endif; ?>
  </section>

  <?php if (!empty($_SESSION['user_id'])): ?>
    <section class="addReviews">
      <h2>Add Your Review</h2>
      <form method="POST" action="add_review.php">
        <input type="hidden" name="restaurant_id" value="<?=$id?>">
        <label>Rating:
          <select name="rating">
            <?php for($i=1;$i<=5;$i++): ?>
              <option value="<?=$i?>"><?=$i?></option>
            <?php endfor; ?>
          </select>
        </label><br>
        <label>Comment:<br>
          <textarea name="comment" rows="4" cols="50"></textarea>
        </label><br>
        <button type="submit">Submit Review</button>
      </form>
    </section>
  <?php else: ?>
    <p><a href="login.php">Log in</a> to add a review.</p>
  <?php endif; ?>

  <script src="js/slideShow.js"></script>
</body>
</html>