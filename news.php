<?php
require_once __DIR__.'/admin_panel/boot.php';
$stmt = pdo()->prepare("SELECT * FROM `News`");
$stmt->execute();
$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<body>
   <link rel="stylesheet" href="../styles/style.css"> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>
<head>
    <body>

    <header class="header">
        <div class="container">
        <nav class="menu">
            <ul>
            <a href="index.php"><li style = "color: #c2bfcf">Главная</li></a>
               <a href="films.php"><li style = "color: #c2bfcf">Афиша</li> </a>
               <a href="sessionsfilms.php"><li style = "color: #c2bfcf">Сеансы</li></a>
               <a href="news.php"><li style = "color: #c2bfcf">Новости</li></a>
               <a href="stocks.php"><li style = "color: #c2bfcf">Акции</li></a>
            </ul>
        </nav>
        </div>
    </header>
        <div class="container" style="display: block; text-align: center; margin-top:2%;">
        <?php foreach ($array as $row): ?>
        <div style="display: flex;">
            <div>
            <img src="<?= $row['photos']?>" width="80%" />
            </div>
            <div>
            <h3><?= $row['header']?> (<?= $row['datetime']?>)</h3>
            <hr>
            <div style="margin-top: 1%; text-align:left;color: #c2bfcf">
            <p> <?= $row['text']?> </p>
        </div>
        </div>
        </div>
        <hr>
        <?php endforeach; ?>
        </div>