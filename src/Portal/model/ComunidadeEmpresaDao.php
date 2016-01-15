<?php

namespace Portal\model;

class ComunidadeEmpresaDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objExtratoGeral;
	private $listaExtratoGeral = array();

	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(ExtratoGeral $objExtratoGeral){
		$this->sql = sprintf("INSERT INTO extratrogeral (idusuario, idempresa, idgeral, tipoid, pontos, observacao)
				VALUES(%d, %d, %d, '%s', %d, '%s')",
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getObjusuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getObjempresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getIdgeral() ),
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getTipoid() ),
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getPontos() ),
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getObservacao() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(ExtratoGeral $objExtratoGeral){
		$this->sql = sprintf("UPDATE idusuario = %d, idempresa = %d, idgeral = %d, tipoid = %d, pontos = %d, observacao = '%s' WHERE id = %d ",
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getObjusuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getObjempresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getIdgeral() ),
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getTipoid() ),
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getPontos() ),
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getObservacao() ),
				mysqli_real_escape_string( $this->con, date('Y-m-d') ), //pega data atual
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objExtratoGeral = $objExtratoGeral;
	}

	/*-- Deletar --*/
	function deletar(ExtratoGeral $objExtratoGeral){
		$this->sql = sprintf("DELETE FROM extratrogeral WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objExtratoGeral = $objExtratoGeral;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(ExtratoGeral $objExtratoGeral){
		$this->sql = sprintf("SELECT * FROM extratrogeral WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objExtratoGeral->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
			
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idusuario);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
			
			$this->objExtratoGeral = new ExtratoGeral($row->id, $objUsuario, $objEmpresa, $row->idgeral, $row->tipoid, $row->pontos, $row->observacao, $row->datacadastro, $row->dataedicao);
		}

		return $this->objExtratoGeral;
	}

	/*-- Listar Por Usuário --*/
	function listarPorUsuario(ExtratoGeral $objExtratoGeral){
		$this->sql = "SELECT * FROM extratrogeral WHERE idusuario = $objExtratoGeral->getIdusuario()";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
				
			$this->objExtratoGeral = new ExtratoGeral($row->id, $objUsuario, $objEmpresa, $row->idgeral, $row->tipoid, $row->pontos, $row->observacao, $row->datacadastro, $row->dataedicao);

			array_push($this->listaExtratoGeral, $this->objExtratoGeral);
		}

		return $this->listaExtratoGeral;
	}

	/*-- Listar Todos --*/
	function listarTodos(ExtratoGeral $objExtratoGeral){
		$this->sql = "SELECT * FROM extratrogeral";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
				
			$this->objExtratoGeral = new ExtratoGeral($row->id, $objUsuario, $objEmpresa, $row->idgeral, $row->tipoid, $row->pontos, $row->observacao, $row->datacadastro, $row->dataedicao);

			array_push($this->listaExtratoGeral, $this->objExtratoGeral);
		}

		return $this->listaExtratoGeral;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM extratrogeral limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM extratrogeral";
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