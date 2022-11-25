<?php
require_once __DIR__.'/admin_panel/boot.php';
$date_today = date("y.m.d"); //присваиваем дату текущую
$today = date("h:i:s"); //присваиваем текущее время

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
            <a href="index.php"><li style = "color: #c2bfcf">Главная</li></a>
               <a href="films.php"><li style = "color: #c2bfcf">Афиша</li> </a>
               <a href="sessionsfilms.php"><li style = "color: #c2bfcf">Сеансы</li></a>
               <a href="news.php"><li style = "color: #c2bfcf">Новости</li></a>
               <a href="stocks.php"><li style = "color: #c2bfcf">Акции</li></a>
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
    <?php $stmt = pdo()->prepare("SELECT * FROM `sessions` JOIN films ON sessions.id_films = films.id_f JOIN halls ON sessions.id_halls = halls.id_h WHERE date >= :date_today AND time >= :today ORDER BY date");
       $stmt->execute(array(':date_today' => $date_today, ':today' => $today));
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
    <!--Секция с рекламой-->
    <section class="advertisement">
    <div class="container">
    <table class="table">
        <thead>
        <tr>
        <th scope="col"></th>
        <th scope="col">Дата </th>
       <th scope="col">Время </th>
       <th scope="col">Фильм </th>
       <th scope="col">Зал </th>

        </tr>
        </thead>
        <tbody>
            <?php  foreach ($array as $row): ?>
                <tr>
                <td><img src="<?= $row['photo'] ?>"/></td>
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

    <footer class="footer" style="margin-top: 3%;">
        <p style="color: #c2bfcf">г.Иркутск</p>
    </footer>

</head>
</html>