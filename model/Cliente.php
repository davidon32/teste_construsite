<?php 
require_once("Sql.php");

class Cliente extends Sql{
	//atributos
	private $id;
	private $nome;
	private $email;
	private $telefone;
	private $senha;
	private $datan;

	//setters 
	public function setId($value){
		$this->id = $value;	
	}

	public function setNome($value){
		$this->nome = $value;	
	}

	public function setEmail($value){
		$this->email = $value;	
	}

	public function setTelefone($value){
		$this->telefone = $value;	
	}

	public function setSenha($value){
		$this->senha = $value;	
	}

	public function setDataN($value){
		$this->datan = $value;	
	}
	//getters
	public function getId(){
		return $this->id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function getSenha(){
		return $this->senha;
	}
	
	public function getDataN(){
		return $this->datan;
	}
	//metodo que carrega dados do banco a partir de um parametro id que e passado
	public function carregarPeloId($id){

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM clientes WHERE id_cliente = :id",array(
			":id"=>$id
		));
		//faz um count apos o insert e se for maior que 0 ele manda os parametros que foram retornardos da consulta para o metodo setData
		if(count($resultado) > 0) {
			$this->setData($resultado[0]); 
		}
	}

	//metodo para setar as variaveis nos setters apos a consulta
	public function setData($date){

		$this->setId($date['id_cliente']);
		$this->setNome($date['nome_cliente']);
		$this->setEmail($date['email_cliente']);
		$this->setTelefone($date['telefone_cliente']);
		$this->setSenha($date['senha_cliente']);
		$this->setDatan($date['data_nasc_cliente']);
	}

	//metodo que pega o ultimo registro do banco de dados
	public static function getList(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM clientes ORDER BY id_cliente DESC LIMIT 1");

	}
	//metodo para inserir no banco
	public function insert(){
		//chama o metodo query onde e passado a query, depois os parametros
		$sql = new Sql();
		//instancia a classe sql
		$results = $sql->select("INSERT INTO `clientes` (`id_cliente`, `nome_cliente`, `email_cliente`, `telefone_cliente`, `senha_cliente`, `data_nasc_cliente`) VALUES (NULL, :NOME, :EMAIL, :TELEFONE, :SENHA, :DATA)", array(
			  ":NOME"=>$this->getNome(),
			  ":EMAIL"=>$this->getEmail(),
			  ":TELEFONE"=>$this->getTelefone(),
			  ":SENHA"=>$this->getSenha(),
			  ":DATA"=>$this->getDataN()
		));
		//faz um count apos o insert e se for maior que 0 ele manda os parametros que foram retornardos da consulta para o metodo setData
		if (count($results) > 0){
			$this->setData($results[0]); 
		}

	}

	//metodo para fazer o update da tabela no banco
	public function update($nome, $email, $telefone, $senha, $data){
		//seta os metodos com os parametros passados
		$this->setNome($nome);
		$this->setEmail($email);
		$this->setTelefone($telefone);
		$this->setSenha($senha);
		$this->setDataN($data);
		//instancia a classe sql
		$sql = new Sql();
		//chama o metodo query onde e passado a query, depois os parametros
		$sql->query("UPDATE clientes SET nome_cliente=:NOME, email_cliente=:EMAIL, telefone_cliente=:TELEFONE, senha_cliente=:SENHA, data_nasc_cliente=:DATA WHERE id_cliente=:ID", array(
			 ":NOME"=>$this->getNome(),
			  ":EMAIL"=>$this->getEmail(),
			  ":TELEFONE"=>$this->getTelefone(),
			  ":SENHA"=>$this->getSenha(),
			  ":ID"=>$this->getId(),
			  ":DATA"=>$this->getDataN()

		));
	}
	//metodo construtor que seta os setters que e chamado sempre que a classe e instanciada 
	public function __construct($nome = "", $email = "",$telefone = "", $senha = "", $data = ""){

		$this->setNome($nome);
		$this->setEmail($email);
		$this->setTelefone($telefone);
		$this->setSenha($senha);
		$this->setDataN($data);
	}
}

?>