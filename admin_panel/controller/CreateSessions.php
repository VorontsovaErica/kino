<?php
require_once "Main.php";

    (new Main())->createSessions($_GET['date'], $_GET['time'], $_GET['id_films'], $_GET['id_halls']);

    header('Refresh: 2; url=../sessions.php');

?>
