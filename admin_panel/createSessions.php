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
    $stmt = pdo()->prepare("SELECT * FROM `films`");
    $stmt->execute();
    $arrayf = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = pdo()->prepare("SELECT * FROM `halls`");
    $stmt->execute();
    $arrayh = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <body style="margin-top: 2%;background-color:#27263D;text-align: center">
        <div class="container" style="display: block; background-color:#4f4d7a;text-align: center;border-radius:4%; height: 380px; width:40%">
            <!-- Форма добавления фильма-->
            <h3 style = "color: #c2bfcf;">Добавление сеанса</h3>
            <form action="controller/CreateSessions.php" method="GET" class="form-inline">
            <div class="form-group">
                <label for="exampleInputEmail1" style= "color: #c2bfcf">Дата</label>
                <input class="form-control" type="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" style= "color: #c2bfcf">Время</label>
                <input class="form-control" id="appt-time" step="2" type="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" style= "color: #c2bfcf">Фильм</label>
                <select class="form-select" name="id_films" style = "color:#d4d4d4">
                         <option> Выберите фильм </option>
                         <?php foreach ($arrayf as $row): ?>
                           <option value=<?php echo $row['id_f']?>><?php echo $row['name']?></option>
                         <?php endforeach; ?>
                       </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" style= "color: #c2bfcf">Зал</label>
                <select class="form-select" name="id_halls" style = "color:#d4d4d4">
                         <option> Выберите зал </option>
                         <?php foreach ($arrayh as $row): ?>
                           <option value=<?php echo $row['id_h']?>><?php echo $row['name_h']?></option>
                         <?php endforeach; ?>
                       </select>
            </div>
            <br>
            <button type="submit" class="btn btn-outline-light">Добавить фильм</button>
        </form>
        </div>
