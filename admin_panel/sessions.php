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

    <section class="kino">
        <div class="container" style="display: block;">
        <h1>Управление фильмами</h1>
        
       <?php $stmt = pdo()->prepare("SELECT * FROM `sessions` JOIN films ON sessions.id_films = films.id JOIN halls ON sessions.id_halls = halls.id");
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table class="table">
        <thead>
        <tr>
        <th scope="col">Дата </th>
       <th scope="col">Время </th>
       <th scope="col">Фильм </th>
       <th scope="col">Зал </th>
        </tr>
        </thead>
        <tbody>
            <?php  foreach ($array as $row): ?>
                <tr>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['time'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['name_h'] ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>

        </table>
            </div>
    </section>