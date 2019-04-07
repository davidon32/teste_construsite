<?php
//faz o require da classe cliente
require_once ("../model/Cliente.php");
	//inicio da sessao parra guardar a mensagem caso o insert seja executado
	session_start();
	//verifica se os campos estao vazios
    if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['telefone']) || empty($_POST['senha'] || empty($_POST['data'] ))){
    	//mensagem algum campo esteja vazio
       echo  "<script>alert('Preencha todos os campos!');document.location='../view/index.php'</script>";

	}else{
		//define as constantes da funçao opensll
		define('SECRET_IV',pack('a16', 'senha'));
		define('SECRET',pack('a16', 'senha'));
		//defino o valor da senha que sera passado pelo post
		$senha = [
			"senha"=>$_POST['senha']
		];
		//encripto a senha do usuario para maior segurança
		$encriptado = openssl_encrypt(json_encode($senha), 'AES-128-CBC', SECRET,0,SECRET_IV);
		//alterando o formato da data para pode ser inserida no banco
        $data = $_POST['data'];
        $data = implode("-",array_reverse(explode("/",$data)));
		//insntancia a classe cliente e sao passado os parametros dos setters diretamente no metodo construtor depois e chamada o metodo insert para mandar os dados para a tabela no banco
		$cliente = new Cliente($_POST['nome'],$_POST['email'],$_POST['telefone'],$encriptado,$data);
        $cliente->insert();
        //chamo o metodo getList para poder pegar o ultimo id registrado no banco
        $resultado = $cliente->getList();
      	//se a inserçao retornar verdadeiro entra na condiçao
		if($cliente == TRUE){
		//atribui a mensagem de alteraçao a variavel de sessao
		$_SESSION['mensagem'] =  "<div style='margin-top:14px' class='alert alert-success' role='alert'>
 			  <a href='../view/editar.php?id=".$resultado[0]['id_cliente']."'class='alert-link'>alterar dados</a>
		</div>
		<div style='margin-top:14px' class='alert alert-primary' role='alert'>
 			  <a href='../view/index.php'class='alert-link'>Não desejo alterar</a>
		</div>";
		//mensagem de sucesso ao alterar que redireciona para a pagina de cadastro 
		echo "<script>alert('Cadastro realizado com sucesso!');document.location='../view/index.php'</script>";

		}else{
			//atribui uma mensagem de erro a variavel de sessao
			$_SESSION['mensagem'] = "erro no formulario";
	        echo "Erro ao inserir";
	    }
	}
        
        
?>