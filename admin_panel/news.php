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
        <h1 style = "color: #c2bfcf">Управление новостями</h1>
        <a href="createNews.php"><button type="button" class="c-button"> Добавить новость </button> </a>
        </div>
        
       <?php $stmt = pdo()->prepare("SELECT * FROM `News`");
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table class="table">
        <thead>
        <tr>
        <th scope="col">Заголовок </th>
       <th scope="col">Дата и время публикации </th>
       <th scope="col">Текст </th>
       <th scope="col">Обложка </th>
       <th scope="col">Удалить </th>
       <th scope="col">Изменить </th>
        </tr>
        </thead>
        <tbody>
            <?php  foreach ($array as $row): ?>
                <tr>
                    <td><?= $row['header'] ?></td>
                    <td><?= $row['datetime'] ?></td>
                    <td><?= $row['text'] ?></td>
                    <td> <img src="<?= $row['photos'] ?>" width=100% /></td>
                    <td><button onclick="del(<?= $row['id_n'] ?>)" type="button" class="c-button"> Х </button></td>
                    <td><a href="updateNews.php?id_n=<?= $row["id_n"] ?>"> <button type="button" class="c-button"> V </button></a> </td>
                </tr>
                <?php endforeach; ?>
        </tbody>

        </table>
            </div>
    </section>

    <script>
   
function del(id_n)
    {
        $.ajax({
            url: 'controller/DeleteNews.php',         /* Куда пойдет запрос */
            method: 'get',             /* Метод передачи (post или get) */
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: {id_n: id_n},     /* Параметры передаваемые в запросе. */
            success: function(){   /* функция которая будет выполнена после успешного запроса.  */
                location.reload();
            }
        });
    }

</script>