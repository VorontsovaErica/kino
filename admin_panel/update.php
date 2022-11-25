<?php
require_once __DIR__.'/boot.php';
?>
<!DOCTYPE html>
<html lang="ru">
<body>
   <link rel="stylesheet" href="../styles/style.css"> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>
<head>
    <body style="margin-top: 2%;">
        <div class="container" style="display: block; text-align: center;">
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

<h3 style = "color: #c2bfcf;padding-bottom: 20px;font-size:28px">Изменение данных о фильме</h3>
<hr>

  <div class="rows">
  <form method='POST' class="forms" style="margin: auto; margin-top: 3%;color: #c2bfcf;font-size:18px;margin:0;left:38%;">

     <div class="form-control" style = "text-align:center;">

                  <input type='hidden' name='id_f' value='<?= $row['id_f']?>' />
                  <p>Название:
                  <input class="form-control" type='text' name='name' value='<?= $row['name']?>' /></p>

                  <p>Жанр:
                  <input class="form-control" type='number' name='id_jenre' value='<?= $row['id_jenre']?>' /></p>

                  <p>Время:
                  <input class="form-control" type='time' name='duration' value='<?= $row['duration']?>' /></p>

                  <p>Описание:
                  <textarea class="form-control" name='description' style = "width = 270px;min-height: 137px;"> <?= $row['description']?> </textarea></p>

                  <p>Год выхода:
                  <input class="form-control" type='year' name='release_date' value='<?= $row['release_date']?>' /></p>

                  <p>Обложка:
                  <input class="form-control" type='year' name='photo' value='<?= $row['photo']?>' /></p>

                  <input class="btn btn-primary" type='submit' value='Сохранить' />
      </div>
  </form>
  </div>

   <?php }
    else{
        echo "Фильм не найден";
    }
}
elseif (isset($_POST["id_f"]) OR isset($_POST["name"]) OR isset($_POST["id_jenre"]) OR isset($_POST["duration"]) OR isset($_POST["description"]) OR isset($_POST["release_date"]) OR isset($_POST["photo"])) {

    $sql = "UPDATE films SET name = :name, id_jenre = :id_jenre, duration = :duration, description = :description, release_date = :release_date, photo = :photo WHERE id_f = :films";
    $car = pdo()->prepare($sql);
    $car->bindValue(":films", $_POST["id_f"]);
    $car->bindValue(":name", $_POST["name"]);
    $car->bindValue(":id_jenre", $_POST["id_jenre"]);
    $car->bindValue(":duration", $_POST["duration"]);
    $car->bindValue(":description", $_POST["description"]);
    $car->bindValue(":release_date", $_POST["release_date"]);
    $car->bindValue(":photo", $_POST["photo"]);

    $car->execute();
    header("Location: kino.php");
}
else{
    echo "Некорректные данные";
}
?>
        </div>
    </body>
</html>