<?php
require_once __DIR__.'/boot.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" AND isset($_GET["id_f"])){
    $id_f = $_GET["id_f"];
    $stmt = pdo()->prepare("SELECT * FROM `sessions` JOIN films ON sessions.id_films = films.id_f JOIN halls ON sessions.id_halls = halls.id_h WHERE id_films = :id_f ORDER BY date");
    $stmt->bindValue(":id_f", $id_f);
    $stmt->execute();
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head lang="ru">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/style.css"> 
</head>
<body onload="window.print();">
<section class="kino">
        <div class="container" style="display: block;">
        <div style="display: flex;">
        <h1 style = "color: #c2bfcf">Сеансы</h1>
</div>
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
        <?php }?>