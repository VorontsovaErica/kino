<?php
require_once __DIR__.'/boot.php';

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
   <link rel="stylesheet" href="../styles/style.css"> 
<style>
    p{
        font-size: 30px;
    }
</style>
</body>
<head>
    <header class="header">
        <div class="container">
        <nav class="menu">
            <ul>
                <a href="admin.php"><li style = "color: #c2bfcf">Главная</li> </a>
               <a href="kino.php"><li style = "color: #c2bfcf">Фильмы</li> </a>
               <a href="sessions.php"><li style = "color: #c2bfcf">Сеансы</li></a>
               <a href="news.php"><li style = "color: #c2bfcf">Новости</li></a>
               <a href="stocks.php"><li style = "color: #c2bfcf">Акции</li></a>
               <a href="otchets.php"><li style = "color: #c2bfcf">Отчет</li></a>
            </ul>
        </nav>
        <?php if ($user) { ?>
           <div class="d-form"> 
                <div><p>Приветствую, <?=htmlspecialchars($user['username'])?>!</p> </div>
                <form class="forms-c" method="post" action="do_logout.php">
                   <button type="submit" class="c-button">Выход</button>
                </form>
            </div>
        <?php }?>
    </div>
    </header>

    <section class="kino" style="padding: 2%; font-size: 34px;">
        <div class="container" style="display: inline-block;">
            <h3 style="color: white;"> Добро пожаловать в панель администрирования ИС "Кинотеатр". Для управления данными выберите в меню необходимую вкладку: </h3>
       <div style="display: table-caption;">
       <a href="kino.php"> <button class="c-button"> <p>Управление фильмами </p></button> </a>
       <a href="sessions.php"><button class="c-button"> <p>Управление сеансами</p></button> </a>
       <a href="news.php"><button class="c-button"> <p>Управление новостной лентой</p></button> </a>
       <a href="stocks.php"><button class="c-button"> <p>Управление акциями</p></button> </a>
       <a href="otchets.php"><button class="c-button"> <p>Вывод отчетов</p></button>   </a>    
        </div>  
        </div>
    </section>