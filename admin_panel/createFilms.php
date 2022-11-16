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

    <?php
    $stmt = pdo()->prepare("SELECT * FROM `jenre`");
    $stmt->execute();
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <body style="margin-top: 2%;">
        <div class="container" style="display: block; text-align: center;">
            <!-- Форма добавления фильма-->
            <h3>Добавление фильма</h3>
            <form action="controller/CreateFilms.php" method="GET" class="form-inline">
            <div class="form-group">
                <label for="exampleInputEmail1">Название</label>
                <input class="form-control" type="text" name="name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Время</label>
                <input class="form-control" id="appt-time" step="2" type="time" name="duration" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Описание</label>
                <input class="form-control" type="text" name="description" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Жанр</label>
                <select class="form-select" name="id_jenre">
                         <option> Выберите жанр </option>
                         <?php foreach ($array as $row): ?>
                           <option value=<?php echo $row['id_j']?>><?php echo $row['name_j']?></option>
                         <?php endforeach; ?>
                       </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Год выхода</label>
                <input class="form-control" type="year" name="release_date" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Добавить фильм</button>
        </form>
        </div>
