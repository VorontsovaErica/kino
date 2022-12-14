<?php
require_once __DIR__.'/admin_panel/boot.php';

$user = null;

if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
   <link rel="stylesheet" href="styles/style.css"> 

</head>
<body>
    <header class="header">
        <div class="container">
        <nav class="menu">
            <ul>
               <a href="films.php"><li style = "color: #c2bfcf">Афиша</li> </a>
               <a href="sessionsfilms.php"><li style = "color: #c2bfcf">Сеансы</li></a>
               <a href="news.php"><li style = "color: #c2bfcf">Новости</li></a>
               <a href="stocks.php"><li style = "color: #c2bfcf">Акции</li></a>
               <a href="kinoteatr.php"><li style = "color: #c2bfcf">Кинотеатр</li></a>
            </ul>
        </nav>
        <?php if ($user) { ?>
           <div class="d-form"> 
            <div><p>Приветствую, <a href="admin_panel/admin.php"> <?=htmlspecialchars($user['username'])?> </a>!</p> </div>
            <form class="forms-c" method="post" action="/admin_panel/do_logout.php">
                <button type="submit" class="c-button">Выход</button>
            </form>
        </div>
<?php }?>
    </div>
    </header>
    
    <!--Название кинотеатра-->
    <section class="main">
        <div class="container">
            
        </div>
    </section>

    <?php $stmt = pdo()->prepare("SELECT * FROM `films` JOIN jenre ON films.id_jenre = jenre.id_j");
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

    <!--Секция с фильмами-->
    <section class="kino">
        <div class="container-menu">
            <nav class="menu">
                <ul>
                    <li style = "color: #1a123d">Сейчас в кино</li>
                </ul>
            </nav>
        </div>
        <div class="container">
            <div class="rows">
            <?php  foreach ($array as $row): ?>
                <div class="row">
                    <img src="<?= $row['photo'] ?>" alt="">
                    
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php $stmt = pdo()->prepare("SELECT * FROM `News`");
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
    <section class="news">
        <div class="container">
            <div class="rows">
            <?php  foreach ($array as $row): ?>
                <div class="row" style="background: no-repeat center/100% url(<?= $row['photos'] ?>);">
                    <p style="color: white;"> <b> <?= $row['header'] ?> </b></p> <hr>
                    <p style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; color: white;"> <?= $row['text'] ?> </p>
                    <!--<img src="images/kino1.jpg" alt=""> -->
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p style="color: #c2bfcf">г.Иркутск</p>
    </footer>

</body>
</html>