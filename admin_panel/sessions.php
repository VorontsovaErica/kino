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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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

    <section class="kino">
        <div class="container" style="display: block;">
        <div style="display: flex;">
        <h1 style = "color: #c2bfcf">Управление сеансами</h1>
        <a href="createSessions.php"><button type="button" class="c-button"> Добавить сеанс </button> </a>
        </div>
        
       <?php $stmt = pdo()->prepare("SELECT * FROM `sessions` JOIN films ON sessions.id_films = films.id_f JOIN halls ON sessions.id_halls = halls.id_h");
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
       <th scope="col">Удалить </th>

        </tr>
        </thead>
        <tbody>
            <?php  foreach ($array as $row): ?>
                <tr>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['time'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['name_h'] ?></td>
                    <td><button onclick="del(<?= $row['id_s'] ?>)" type="button" class="c-button"> Х </button></td>

                </tr>
                <?php endforeach; ?>
        </tbody>

        </table>
            </div>
    </section>

    <script>
   
function del(id_s)
    {
        $.ajax({
            url: 'controller/DeleteSessions.php',         /* Куда пойдет запрос */
            method: 'get',             /* Метод передачи (post или get) */
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: {id_s: id_s},     /* Параметры передаваемые в запросе. */
            success: function(){   /* функция которая будет выполнена после успешного запроса.  */
                location.reload();
            }
        });
    }

</script>