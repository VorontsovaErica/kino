<?php
require_once "Main.php";

    (new Main())->createHalls($_GET['name_h']);

    header('Refresh: 2; url=../createHalls.php');

?>
