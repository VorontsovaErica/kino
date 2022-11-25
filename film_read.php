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
        <div class="container" style="display: block; text-align: center; margin-top:2%;">
        <?php
// если запрос GET
if($_SERVER["REQUEST_METHOD"] === "GET" AND isset($_GET["id_f"]))
{
    $films = $_GET["id_f"];
    $sql = "SELECT * FROM films JOIN jenre ON films.id_jenre = jenre.id_j WHERE id_f = :films";
    $film = pdo()->prepare($sql);
    $film->bindValue(":films", $films);
    // выполняем выражение и получаем данные по id
    $film->execute();
    if($film->rowCount() > 0){
        foreach ($film as $row) {
            $name = $row['name'];
            $id_jenre = $row['id_jenre'];
            $duration = $row['duration'];
            $description = $row['description'];
            $release_date = $row['release_date'];
            $photo = $row['photo'];
        }?>
            <div style="display:flex; border: 2px solid grey; padding: 2%;color: #c2bfcf; font-size: 20px">
            <div>
            <img src="<?= $row['photo']?>" />
            </div>
            <div>
            <h3><?= $row['name']?> (<?= $row['release_date']?>)</h3>
            <hr>
            <div style="margin-top: 1%; text-align:left;color: #c2bfcf">
            <p> <?= $row['description']?> </p>
            </div>
            <div style="margin-top: 1%; text-align: left; color: #c2bfcf">
            <p > <b>Жанр:</b> <?= $row['name_j']?> </p>
            <p><b>Время:</b> <?= $row['duration']?></p>
            </div>
            <div style="margin-top: 1%;">
            <?php $stmt = pdo()->prepare("SELECT * FROM `sessions` JOIN films ON sessions.id_films = films.id_f JOIN halls ON sessions.id_halls = halls.id_h WHERE id_films = :films AND date >= :date_today AND time >= :today ORDER BY date");
        $stmt->execute(array(':films' => $films, ':date_today' => $date_today, ':today' => $today));
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
    <!--Таблица сеансов-->
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
        <div>
            </div>
            </div>

   <?php }
    else{
        echo "Фильм не найден";
    }
}