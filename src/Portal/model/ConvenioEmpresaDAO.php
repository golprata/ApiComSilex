<?php

namespace Portal\model;

class ConvenioEmpresaDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objConvenioEmpresa;
	private $listaConvenioEmpresa = array();
	
	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(ConvenioEmpresa $objConvenioEmpresa){
		$this->sql = sprintf("INSERT INTO convenioempresa (idconvenio, idempresa, status, observacao, creditofixo)
				VALUES(%d, %d, '%s', '%s', %d)",
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getObjconvenio()->getId() ),
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getObjempresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getStatus() ),
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getObservacao() ),
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getCreditofixo() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(ConvenioEmpresa $objConvenioEmpresa){
		$this->sql = sprintf("UPDATE convenioempresa SET idconvenio = %d, idempresa = %d, status = '%s', observacao = '%s', creditofixo = %d, dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getObjconvenio()->getId() ),
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getObjempresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getStatus() ),
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getObservacao() ),
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getCreditofixo() ),
				mysqli_real_escape_string( date('Y-m-d') ), //pega data atual
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objConvenioEmpresa = $objConvenioEmpresa;
	}

	/*-- Deletar --*/
	function deletar(ConvenioEmpresa $objConvenioEmpresa){
		$this->sql = sprintf("DELETE FROM convenioempresa WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objConvenioEmpresa = $objConvenioEmpresa;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(ConvenioEmpresa $objConvenioEmpresa){
		$this->sql = sprintf("SELECT * FROM convenioempresa WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objConvenioEmpresa->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objConvenio = new Convenio();
			$objConvenio->setId($row->idconvenio);
			$objConvenioControl = new ConvenioControl($objConvenio);
			$objConvenio = $objConvenioControl->buscarPorId();
			
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
				
			$this->objConvenioEmpresa = new ConvenioEmpresa($row->id, $objConvenio, $objEmpresa, $row->status, $row->observacao, $row->creditofixo, $row->datacadastro, $row->dataedicao);
		}

		return $this->objConvenioEmpresa;
	}

	/*-- Listar Todos --*/
	function listarTodos(ConvenioEmpresa $objConvenioEmpresa){
		$this->sql = "SELECT * FROM convenioempresa";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objConvenio = new Convenio();
			$objConvenio->setId($row->idconvenio);
			$objConvenioControl = new ConvenioControl($objConvenio);
			$objConvenio = $objConvenioControl->buscarPorId();
			
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
				
			$this->objConvenioEmpresa = new ConvenioEmpresa($row->id, $objConvenio, $objEmpresa, $row->status, $row->observacao, $row->creditofixo, $row->datacadastro, $row->dataedicao);
			
			array_push($this->listaConvenioEmpresa, $this->objConvenioEmpresa);
		}

		return $this->listaConvenioEmpresa;
	}
	
	/*-- Listar por empresa --*/
	function listarPorEmpresa(ConvenioEmpresa $objConvenioEmpresa){
		$this->sql = "SELECT * FROM convenioempresa WHERE idempresa = $objConvenioEmpresa->getObjempresa->getId()";//$idempresa";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objConvenio = new Convenio();
			$objConvenio->setId($row->idconvenio);
			$objConvenioControl = new ConvenioControl($objConvenio);
			$objConvenio = $objConvenioControl->buscarPorId();
				
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
	
			$this->objConvenioEmpresa = new ConvenioEmpresa($row->id, $objConvenio, $objEmpresa, $row->status, $row->observacao, $row->creditofixo, $row->datacadastro, $row->dataedicao);
				
			array_push($this->listaConvenioEmpresa, $this->objConvenioEmpresa);
		}
	
		return $this->listaConvenioEmpresa;
	}
	
	/*-- Listar por convenio --*/
	function listarPorConvenio(ConvenioEmpresa $objConvenioEmpresa){
		$this->sql = "SELECT * FROM convenioempresa WHERE idconvenio = $objConvenioEmpresa->getObjconvenio->getId()";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objConvenio = new Convenio();
			$objConvenio->setId($row->idconvenio);
			$objConvenioControl = new ConvenioControl($objConvenio);
			$objConvenio = $objConvenioControl->buscarPorId();
	
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
	
			$this->objConvenioEmpresa = new ConvenioEmpresa($row->id, $objConvenio, $objEmpresa, $row->status, $row->observacao, $row->creditofixo, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaConvenioEmpresa, $this->objConvenioEmpresa);
		}
	
		return $this->listaConvenioEmpresa;
	}
	
	/*-- Listar Por usuario --*/
//	function listarPorConvenio($idconvenio){
//		$this->sql = "SELECT * FROM convenioempresa WHERE idconvenio = $idconvenio";
//		$result = mysqli_query ( $this->con, $this->sql );
//		if (! $result) {
//			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
//		}
//
//		$lista = array();
//
//		while ( $row = mysqli_fetch_assoc ( $result ) ) {
//			$lista[]=$row;
//		}
//		//teste
//		return $lista;
//	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM convenioempresa limit " . $start . ", " . $limit;
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}

		$lista = array();

		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			$lista[]=$row;
		}
		//teste
		return $lista;
	}

	/*-- Quantidade Total --*/
	function qtdTotal() {
		$this->sql = "SELECT count(*) as quantidade FROM convenioempresa";
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