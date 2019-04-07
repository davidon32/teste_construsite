<?php
//faz o require da classe cliente
require_once("../model/Cliente.php");
        //instancia a classe cliente e chama o metodo carreggarpelo id que pega como parametro a variavel get id para listar determinado cliente
        $cliente = new Cliente();
        $cliente->carregarPeloId($_GET['id']);
        
?>
