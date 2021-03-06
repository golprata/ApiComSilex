<?php

namespace Portal;


class LocalidadeDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objLocalidade;
	private $listaLocalidade = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(Localidade $objLocalidade){
		$this->sql = sprintf("INSERT INTO localidade (codigoIBGE, uf, cidade, idpais) 
				VALUES(%d, '%s', '%s', %d)",
				mysqli_real_escape_string( $this->con, $objLocalidade->getCodigoIBGE() ),
				mysqli_real_escape_string( $this->con, $objLocalidade->getUf() ),
				mysqli_real_escape_string( $this->con, $objLocalidade->getCidade() ),
				mysqli_real_escape_string( $this->con, $objLocalidade->getObjPais()->getId() ) );
				
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(Localidade $objLocalidade){
		$this->sql = sprintf("UPDATE localidade SET codigoIBGE = %d, uf = '%s', cidade = '%s', dataedicao = '%s', idpais = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLocalidade->getCodigoIBGE() ),
				mysqli_real_escape_string( $this->con, $objLocalidade->getUf() ),
				mysqli_real_escape_string( $this->con, $objLocalidade->getCidade() ),
				mysqli_real_escape_string( $this->con, $objLocalidade->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objLocalidade->getObjPais()->getId() ),
				mysqli_real_escape_string( $this->con, $objLocalidade->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objLocalidade = $objLocalidade;
	}
	
	/*-- Deletar --*/
	function deletar(Localidade $objLocalidade){
		$this->sql = sprintf("DELETE FROM localidade WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLocalidade->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objLocalidade = $objLocalidade;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(Localidade $objLocalidade){
		$this->sql = sprintf("SELECT * FROM localidade WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLocalidade->getId() ) );
		
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPais = new Pais();
			$objPais->setId($row->idpais);
			$objPaisControl = new PaisControl($objPais);
			$objPais = $objPaisControl->buscarPorId();
			
			$this->objLocalidade = new Localidade($row->id, $row->codigoIBGE, $row->uf, $row->cidade, $row->datacadastro, $row->dataedicao, $objPais); 
		}
		
		return $this->objLocalidade;
	}
	
	/*-- Buscar por CodigoIBGE --*/
	function buscarPorIBGE(Localidade $objLocalidade){
		$this->sql = sprintf("SELECT * FROM localidade WHERE codigoIBGE = %d",
				mysqli_real_escape_string( $this->con, $objLocalidade->getId() ) );
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPais = new Pais();
			$objPais->setId($row->idpais);
			$objPaisControl = new PaisControl($objPais);
			$objPais = $objPaisControl->buscarPorId();
				
			$this->objLocalidade = new Localidade($row->id, $row->codigoIBGE, $row->uf, $row->cidade, $row->datacadastro, $row->dataedicao, $objPais);
		}
	
		return $this->objLocalidade;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(){
		$this->sql = "SELECT * FROM localidade";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
				
			$objPais = new Pais();
			$objPais->setId($row->idpais);
			$objPaisControl = new PaisControl($objPais);
			$objPais = $objPaisControl->buscarPorId();
				
			$this->objLocalidade = new Localidade($row->id, $row->codigoIBGE, $row->uf, $row->cidade, $row->datacadastro, $row->dataedicao, $objPais); 
				
			array_push($this->listaLocalidade, $this->objLocalidade);
		}
		
		return $this->listaLocalidade;
	}	
	
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM localidade LIMIT " . $start . ", " . $limit;
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_assoc( $result ) ) {	
	
			$lista [] = $row;
		}
			
		return $lista;
	}
	
	function qtdTotal() {
		$this->sql = "SELECT count(*) as quantidade FROM localidade";
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		$total = 0;
		while ( $row = mysqli_fetch_object ( $result ) ) {
			$total = $row->quantidade;
		}
	
		return $total;
	}
	
			
}
?>