<?php
require_once __DIR__.'/boot.php';
?>
<!DOCTYPE html>
<html lang="ru">
<body>
   <link rel="stylesheet" href="../admin_panel/style.css"> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</body>
<head>
    <body style="margin-top: 2%;background-color:#27263D;text-align: center">
        <div class="container" style="display: block; text-align: center; background-color: #4f4d7a;">
            <h1 style = "color: #c2bfcf;">Управление залами</h1>        
            <hr>
            <!-- Форма добавления зала-->
            <h3 style="text-align: center;color: #c2bfcf">Добавление зала</h3>
            <form action="controller/CreateHalls.php" method="GET" class="form-inline" style="width:40%; margin-left: 30%;margin-top: 30px;margin-bottom: 0px;">
            <div class="form-group">
                <label for="exampleInputEmail1"style = "color: #c2bfcf" >Название</label>
                <input class="form-control" type="text" name="name_h" required style ="margin-left:-1%;width: 80%">
            </div>
            <br>
            <button type="submit" class="btn btn-outline-light" style = "margin-left: 80%;margin-top: -22%;margin-right: 0px;width: 20%;">Добавить</button>
        </form>
        <?php $stmt = pdo()->prepare("SELECT * FROM `halls`");
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table class="table" style="width:40%; text-align:center; margin-left: 30%; margin-top: 0px;">
        <thead style>
        <tr>
        <th scope="col" style = "color: #c2bfcf">Название </th>
       <th scope="col" style = "color: #c2bfcf">Удалить </th>
       <th scope="col" style = "color: #c2bfcf">Управление залом </th>
        </tr>
        </thead>
        <tbody style = "color: #c2bfcf">
            <?php  foreach ($array as $row): ?>
                <tr>
                    <td><?= $row['name_h'] ?></td>
                    <td><button onclick="del(<?= $row['id_h'] ?>)"  type="button" class="btn btn-outline-light"> Х </button></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
        </div>
        <script>
   
function del(id_h)
    {
        $.ajax({
            url: 'controller/DeleteHalls.php',         /* Куда пойдет запрос */
            method: 'get',             /* Метод передачи (post или get) */
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: {id_h: id_h},     /* Параметры передаваемые в запросе. */
            success: function(){   /* функция которая будет выполнена после успешного запроса.  */
                location.reload();
            }
        });
    }

</script>