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
if($_SERVER["REQUEST_METHOD"] === "GET" AND isset($_GET["id_stock"]))
{
    $news = $_GET["id_stock"];
    $sql = "SELECT * FROM stocks WHERE id_stock = :news";
    $new = pdo()->prepare($sql);
    $new->bindValue(":news", $news);
    // выполняем выражение и получаем данные по id
    $new->execute();
    if($new->rowCount() > 0){
        foreach ($new as $row) {
            $name = $row['name'];
            $text = $row['text'];
            $images = $row['images'];
        }?>
</div>
<h3 style = "color: #c2bfcf;padding-bottom: 20px;font-size:28px">Изменение данных об акции</h3>
<hr>
  <div class="rows">
  <form method='POST' class="forms" style="margin-left: 0; text-align: left; padding: 2% 2%;color: #c2bfcf;font-size:18px">

     <div class="form-control" >

                  <input type='hidden' name='id_stock' value='<?= $row['id_stock']?>' />
                  <p>Название:<input class="form-control" type='text' name='name' value='<?= $row['name']?>' /></p>

                  <p>Описание:
                  <textarea class="form-control" name='text' rows="10"> <?= $row['text']?> </textarea></p>

                  <p>Изображение:<input class="form-control" type='text' name='images' value='<?= $row['images']?>' /><p>

                  <input class="btn btn-primary" type='submit' value='Сохранить' />
      </div>
  </form>
  </div>

   <?php }
    else{
        echo "Акция не найдена";
    }
}
elseif (isset($_POST["id_stock"]) OR isset($_POST["name"]) OR isset($_POST["text"]) OR isset($_POST["images"])) {

    $sql = "UPDATE stocks SET name = :name, text = :text, images = :images WHERE id_stock = :news";
    $new = pdo()->prepare($sql);
    $new->bindValue(":news", $_POST["id_stock"]);
    $new->bindValue(":name", $_POST["name"]);
    $new->bindValue(":text", $_POST["text"]);
    $new->bindValue(":images", $_POST["images"]);
    $new->execute();
    header("Location: stocks.php");
}
else{
    echo "Некорректные данные";
}
?>
        </div>
    </body>
</html>