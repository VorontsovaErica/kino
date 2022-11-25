<?php
require_once __DIR__.'/boot.php';
?>
<!DOCTYPE html>
<html lang="ru">
<body>
   <link rel="stylesheet" href="../styles/style.css"> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</body>
<head>
    <body style="margin-top: 2%;background-color:#27263D">
        <div class="container" style="display: block; text-align: center;background-color: #4f4d7a; border-radius:5%; height: 550px; width:80%">
            <!-- Форма добавления новости-->
            <h3 style = "color: #c2bfcf;">Добавление новости</h3>
            <form action="controller/CreateStocks.php" method="GET" class="form-inline">
            <div class="form-group" style = "color: #c2bfcf;font-size: 18px">
                <label for="exampleInputEmail1" placeholder="Введите название акции">Название</label>
                <input class="form-control" type="text" name="name" required>
            </div>
            <div class="form-group" style = "color: #c2bfcf;font-size: 18px">
                <label for="exampleInputEmail1" placeholder="Введите описание">Описание акции</label>
                <textarea class="form-control" name="text" cols="20" rows="10"></textarea>
            </div>
            <div class="form-group" style = "color: #c2bfcf;font-size: 18px">
                <label for="exampleInputEmail1" placeholder="обложка акции">Обложка</label>
                <input class="form-control" type="text" name="images" required>
            </div>
            <br>
            <button type="submit" class="btn btn-outline-light">Добавить новость</button>
        </form>
        </div>
        