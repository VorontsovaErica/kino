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

</body>
<head>
    <header class="header">
        <div class="container">
        <nav class="menu">
            <ul>
               <a href="kino.php"><li>Фильмы</li> </a>
               <a href="sessions.php"><li>Сеансы</li></a>
               <a href="news.php"><li>Новости</li></a>
               <a href="#"><li>Отчет</li></a>
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

    <section>
        <div class="container">
            <h3> Здесь нужно добавить добавление сотрудников и вывод их </h3>
        </div>
    </section>