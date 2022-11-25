<?php
require_once __DIR__.'/boot.php';
$date = date("y.m.d"); //присваиваем дату текущую
$stmt = pdo()->prepare("SELECT * FROM `sessions` JOIN films ON sessions.id_films = films.id_f JOIN halls ON sessions.id_halls = halls.id_h");
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = pdo()->prepare("SELECT * FROM films");
$stmt->execute();
$mass = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
<head lang="ru">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/style.css"> 
</head>
<body>
<header class="header">
        <div class="container">
        <nav class="menu">
            <ul>
            <a href="admin.php"><li style = "color: #c2bfcf">Главная</li> </a>
            <a href="kino.php"><li style = "color: #c2bfcf">Фильмы</li> </a>
               <a href="sessions.php"><li style = "color: #c2bfcf">Сеансы</li></a>
               <a href="news.php"><li style = "color: #c2bfcf">Новости</li></a>
               <a href="otchets.php"><li style = "color: #c2bfcf">Отчет</li></a>
            </ul>
        </nav>
    </div>
    </header>
<section class="kino" style="margin-right:auto;">
    <div class="container" style="display: inline-block; background: white; padding: 5%;">
        <div >
        <h1 style = "color: #27263d; text-align: center;">Вывод списка сеансов</h1>
        </div>
        <br>
        <div>
        <p style="font-size: 18px;">Вывод сеансов на сегодняшнюю дату: <a href="otchet.php?date=<?=$date;?>"><button type="button" class="c-button"> Добавить сеанс </button> </a></p>
        </div>
        <br>
        <div>
            <form action="otchet.php?date=<?=$date;?>" class="form">
                <p style="font-size: 18px;"> Выбрать дату для вывода сеансов:
                    <input type="date" name="date" placeholder="Выберите дату" >
                    <button type="submit" class="c-button">Выбрать</button>
                </p>
            </form>
        </div>
        <br>
        <div>
        <form action="otchetF.php" method="GET" class="form" style= "color: #27263d; font-size: 18px;">
                <label for="exampleInputEmail1">Выбрать фильм для вывода сеансов:</label>
                <select class="form-select" name="id_f">
                         <option> Выберите фильм </option>
                         <?php foreach ($mass as $row): ?>
                           <option value=<?php echo $row['id_f']?>><?php echo $row['name']?></option>
                         <?php endforeach; ?>
                       </select>
                    <button type="submit" class="c-button">Выбрать</button>
            </form>
        </div>
    </div>
</section>
</body>
</html>