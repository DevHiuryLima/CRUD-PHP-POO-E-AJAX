<?php
    declare (strict_types = 1);
    require_once "../models/filmes.php";
    $filme = new Filmes();
    
    // Captura do ajax os dados do evento.
    $opcao = $_POST['opcao'];
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $classificacao = $_POST['classificacao'];
    
    if (!empty($opcao)) {
        
        // Dependendo da opção acontece uma ação/chama um metodo.
        switch ($opcao) {
            case 'inserir':
                if (!empty($nome) && !empty($genero) && !empty($classificacao)) {
                    $filme->inserir($nome, $genero, $classificacao);
                }
                else {
                    echo "VAZIO";
                }
                break;
            case 'editar':
                if (!empty($id) && !empty($nome) && !empty($genero) && !empty($classificacao)) {
                    $filme->editar($id, $nome, $genero, $classificacao);
                }
                else {
                    echo "VAZIO";
                }
                break;
            case 'remover':
                if (!empty($id)) {
                    $filme->remover($id);
                }
                else {
                    echo "VAZIO";
                }
                break;
        }
    }
    else {
        echo "VAZIO";
    }
?>