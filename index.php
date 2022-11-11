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
<body>
   <link rel="stylesheet" href="styles/style.css"> 

</body>
<head>
    <header class="header">
        <div class="container">
        <nav class="menu">
            <ul>
               <a href="#"><li>Афиша</li> </a>
               <a href="#"><li>Сеансы</li></a>
               <a href="#"><li>Акции</li></a>
               <a href="#"><li>Кинотеатр</li></a>
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
    
    <!--Секция с рекламой-->
    <section class="main">
        <div class="container">
            
        </div>
    </section>

    <?php $stmt = pdo()->prepare("SELECT * FROM `films` JOIN jenre ON films.id_jenre = jenre.id");
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

    <!--Секция с фильмами-->
    <section class="kino">
        <div class="container-menu">
            <nav class="menu">
                <ul>
                    <li>Сейчас в кино</li>
                    <li>Скоро на экранах</li>
                </ul>
            </nav>

                <form class="forms">
                  <input type="text" placeholder="Искать здесь...">
                  <button type="submit"></button>
                </form>
        </div>
        <div class="container">
            <div class="rows">
            <?php  foreach ($array as $row): ?>
                <div class="row">
                    <img src="images/kino1.jpg" alt="">
                    <h5><?= $row['name'] ?></h5>
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
                <div class="row">
                    <p> <?= $row['header'] ?> </p>
                    <!--<img src="images/kino1.jpg" alt=""> -->
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>г.Иркутск, ул.Ленина, 5а, ИАТ</p>
     <p>&copy; 2022 OOO VORONTSOVA</p>
    </footer>

</head>
</html>