<?php
require_once "Main.php";

    (new Main())->createJenre($_GET['name_j']);

    header('Refresh: 2; url=../createJenre.php');

?>
