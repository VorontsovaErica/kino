<?php

require_once "Main.php";

    return (new Main())->deleteStock($_GET['id_stock']);
