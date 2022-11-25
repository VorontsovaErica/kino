<?php
require_once "Main.php";

    (new Main())->createNews($_GET['header'], $_GET['text'], $_GET['photos']);

    header('Refresh: 2; url=../news.php');

?>
