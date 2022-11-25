<?php
require_once "Main.php";

    (new Main())->createStocks($_GET['name'], $_GET['text'], $_GET['images']);

    header('Refresh: 2; url=../stocks.php');

?>
