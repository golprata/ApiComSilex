<?php

namespace Portal\model;

class LeadDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objLead;
	private $listaLead = array();

	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(Lead $objLead){
		$this->sql = sprintf("INSERT INTO lead (idsegmento, idempresa, usuario, senha, dadospf, dataexpiracao)
				VALUES(%d, %d, '%s', '%s', '%s', '%s')",
				mysqli_real_escape_string( $this->con, $objLead->getObjsegmento()->getId() ),
				mysqli_real_escape_string( $this->con, $objLead->getObjempresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objLead->getUsuario() ),
				mysqli_real_escape_string( $this->con, $objLead->getSenha() ),
				mysqli_real_escape_string( $this->con, $objLead->getDadospf() ),
				mysqli_real_escape_string( $this->con, $objLead->getDataexpiracao() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(Lead $objLead){
		$this->sql = sprintf("UPDATE lead SET idsegmento = %d, idempresa = %d, usuario = '%s', senha = '%s', dadospf = '%s', dataedicao = '%s', dataexpiracao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLead->getObjsegmento()->getId() ),
				mysqli_real_escape_string( $this->con, $objLead->getObjempresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objLead->getUsuario() ),
				mysqli_real_escape_string( $this->con, $objLead->getSenha() ),
				mysqli_real_escape_string( $this->con, $objLead->getDadospf() ),
				mysqli_real_escape_string( $this->con, $objLead->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objLead->getDataexpiracao() ),
				mysqli_real_escape_string( $this->con, $objLead->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objLead = $objLead;
	}

	/*-- Deletar --*/
	function deletar(Lead $objLead){
		$this->sql = sprintf("DELETE FROM lead WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLead->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objLead = $objLead;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(Lead $objLead){
		$this->sql = sprintf("SELECT * FROM lead WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLead->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();

			$objSegmento = new Segmento();
			$objSegmento->setId($row->idsegmento);
			$objSegmentoControl = new SegmentoControl($objSegmento);
			$objSegmento = $objSegmentoControl->buscarPorId();
			
			$this->objLead = new Lead($row->id, $objSegmento, $objEmpresa, $row->usuario, $row->senha, $row->dadospf, $row->datacadastro, $row->dataedicao, $row->dataexpiracao);
		
		}

		return $this->objLead;
	}

	/*-- Listar Todos --*/
	function listarTodos(){
		$this->sql = "SELECT * FROM lead";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();

			$objSegmento = new Segmento();
			$objSegmento->setId($row->idsegmento);
			$objSegmentoControl = new SegmentoControl($objSegmento);
			$objSegmento = $objSegmentoControl->buscarPorId();
			
			$this->objLead = new Lead($row->id, $objSegmento, $objEmpresa, $row->usuario, $row->senha, $row->dadospf, $row->datacadastro, $row->dataedicao, $row->dataexpiracao);
			
			array_push($this->listaLead, $this->objLead);
		}

		return $this->listaLead;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM lead limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM lead";
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