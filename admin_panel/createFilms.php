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

    <?php
    $stmt = pdo()->prepare("SELECT * FROM `jenre`");
    $stmt->execute();
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <body style="margin-top: 2%;background-color:#27263D">
        <div class="container" style="display: block; text-align: center;background-color: #4f4d7a; border-radius:5%; height: 550px; width:40%">
            <!-- Форма добавления фильма-->
            <h3 style = "color: #c2bfcf;">Добавление фильма</h3>
            <form action="controller/CreateFilms.php" method="GET" class="form-inline" style = "font-size: 18px">
            <div class="form-group" >
                <label for="exampleInputEmail1" style= "color: #c2bfcf;">Название</label>
                <input class="form-control" type="text" name="name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" style= "color: #c2bfcf">Время</label>
                <input class="form-control" id="appt-time" step="2" type="time" name="duration" required>
            </div>
            <div class="form-group">
                <label class="text-md-start" for="exampleInputEmail1" style= "color: #c2bfcf">Описание</label>
                <input class="form-control" type="text" name="description" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" style= "color: #c2bfcf">Жанр</label>
                <select class="form-select" name="id_jenre" style = "color:#d4d4d4">
                         <option> Выберите жанр </option>
                         <?php foreach ($array as $row): ?>
                           <option value=<?php echo $row['id_j']?>><?php echo $row['name_j']?></option>
                         <?php endforeach; ?>
                       </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" style= "color: #c2bfcf">Год выхода</label>
                <input class="form-control" type="year" name="release_date" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" style= "color: #c2bfcf">Фото</label>
                <input class="form-control" type="text" name="photo" required>
            </div>
            <br>
            <button type="submit" class="btn btn-outline-light">Добавить фильм</button>
        </form>
                         </div>
