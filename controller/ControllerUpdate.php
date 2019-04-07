<?php
//faz o require da classe cliente
require_once("../model/Cliente.php");
        //alterando o formato da data para pode ser inserida no banco
        $data_nasc = $_POST['data'];
        $data_nasc = implode("-",array_reverse(explode("/",$data_nasc)));
		//define as constantes da funçao opensll
        define('SECRET_IV',pack('a16', 'senha'));
		define('SECRET',pack('a16', 'senha'));
		//defino o valor da senha que sera passado pelo post
		$senha = [
			"senha"=>$_POST['senha']
		];
		//encripto a senha do usuario para maior segurança 
		$encriptado = openssl_encrypt(json_encode($senha), 'AES-128-CBC', SECRET,0,SECRET_IV);
		//criando o objeto cliente pega o ultimo registro da tabela com o metodo get list e seta o id com o id que foi retornado depois sao passados os parametros para o metodo de update
        $cliente = new Cliente();
        $resultado = $cliente->getList();
       	$cliente->setId($resultado[0]['id_cliente']);
        $cliente->update($_POST['nome'], $_POST['email'], $_POST['telefone'], $encriptado, $data_nasc);
        //caso o update retorno true e mostrado o alerta de sucesso caso contrario o alerta de erro
        if($cliente == TRUE){

        	echo "<script>alert('Cadastro alterado com sucesso! Redirecionando');document.location='../view/index.php'</script>";

        }else{

        	echo "<script>alert('Erro ao Alterar! Redirecionando');document.location='../view/index.php'</script>";
        }

?>