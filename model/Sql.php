<?php 

class Sql extends PDO {

	private $conn;
	//construct que inicia a conexao sql
	public function __construct(){

		$this->conn = new PDO("mysql:dbname=teste_construsite;host=localhost", "root", "");

	}
	//metodo para setar os parametros que serao usados na query
	private function setParams($statement,$parameters = array()){

		foreach ($parameters as $key => $value) {

			$this->setParam($statement,$key,$value);
		
		}

	}
	//metodo para setar um parametro que sera chamado no metodo setParams
	private function setParam($statement,$key,$value){

		$statement->bindParam($key,$value);

	}
	//metodo para executar um comando no banco sem retorno
	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt,$params);

		$stmt->execute();

		return $stmt;
	}
	//metodo para executar um comando no banco com retorno
	public function select($rawQuery,$params = array()):array
	{

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}
}

?>