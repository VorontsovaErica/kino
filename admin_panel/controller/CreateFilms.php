<?php
require_once "Main.php";

    (new Main())->createFilms($_GET['name'], $_GET['id_jenre'], $_GET['duration'], $_GET['description'], $_GET['release_date']);

    header('Refresh: 2; url=../kino.php');

?>
