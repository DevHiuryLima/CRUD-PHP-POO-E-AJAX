<?php
    declare (strict_types = 1);
    require_once '../models/Filmes.php';
    
    $filme = new Filmes();

    $data = $filme->getAll();  // Devolvera um array que ficara armazenado no data

    echo $filme->showTable($data);
?>