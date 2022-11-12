<?php
require_once __DIR__.'/boot.php';

$user = null;

if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Админка</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>

<div class="container">
  <div class="row py-5">
    <div class="col-lg-6">

        <?php if ($user) { ?>

          <h1>Приветствую, <?=htmlspecialchars($user['username'])?>!</h1>

          <form class="mt-5" method="post" action="do_logout.php">
            <button type="submit" class="btn btn-primary">Выйти</button>
          </form>

        <?php } else { ?>

          <h1 class="mb-5">Регистрация сотрудника</h1>

            <?php flash(); ?>

          <form method="post" action="do_register.php">
            <div class="mb-3">
              <label for="username" class="form-label">Логин</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Пароль</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">Регистрация</button>
            </div>
          </form>

        <?php } ?>

    </div>
  </div>
</div>

</body>
</html>