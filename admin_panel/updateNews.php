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
    <body>
        <div class="container" style="display: block; text-align: center; margin-top: 2%">
        <?php
// если запрос GET
if($_SERVER["REQUEST_METHOD"] === "GET" AND isset($_GET["id_n"]))
{
    $news = $_GET["id_n"];
    $sql = "SELECT * FROM News WHERE id_n = :news";
    $new = pdo()->prepare($sql);
    $new->bindValue(":news", $news);
    // выполняем выражение и получаем данные по id
    $new->execute();
    if($new->rowCount() > 0){
        foreach ($new as $row) {
            $header = $row['header'];
            $datetime = $row['datetime'];
            $text = $row['text'];
        }?>

<h3>Изменение данных о новости</h3>
<hr>
  <div class="rows">
  <form method='POST' class="forms" style="margin-left: 0; text-align: left; padding: 2% 2%;">

     <div class="form-control" >

                  <input type='hidden' name='id_n' value='<?= $row['id_n']?>' />
                  <p>Название:
                  <input class="form-control" type='text' name='header' value='<?= $row['header']?>' /></p>

                  <input type="hidden" name='datetime' value='<?= $row['datetime']?>' /></p>

                  <p>Описание:
                  <textarea class="form-control" name='text' rows="10"> <?= $row['text']?> </textarea></p>

                  <input class="btn btn-primary" type='submit' value='Сохранить' />
      </div>
  </form>
  </div>

   <?php }
    else{
        echo "Пользователь не найден";
    }
}
elseif (isset($_POST["id_n"]) OR isset($_POST["header"]) OR isset($_POST["datetime"]) OR isset($_POST["text"])) {

    $sql = "UPDATE News SET header = :header, datetime = :datetime, text = :text WHERE id_n = :news";
    $new = pdo()->prepare($sql);
    $new->bindValue(":news", $_POST["id_n"]);
    $new->bindValue(":header", $_POST["header"]);
    $new->bindValue(":datetime", $_POST["datetime"]);
    $new->bindValue(":text", $_POST["text"]);
    $new->execute();
    header("Location: news.php");
}
else{
    echo "Некорректные данные";
}
?>
        </div>
    </body>
</html>