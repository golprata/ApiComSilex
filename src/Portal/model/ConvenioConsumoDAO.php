<?php

namespace Portal\model;

class ConvenioConsumoDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objConvenioConsumo;
	private $listaConvenioConsumo = array();
	
	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(ConvenioConsumo $objConvenioConsumo){
		$this->sql = sprintf("INSERT INTO convenioconsumo (idusuarioconvenio, valor)
				VALUES(%d, %d)",
				mysqli_real_escape_string( $this->con, $objConvenioConsumo->getObjusuarioconvenio()->getId() ),
				mysqli_real_escape_string( $this->con, $objConvenioConsumo->getValor() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(ConvenioConsumo $objConvenioConsumo){
		$this->sql = sprintf("UPDATE convenioconsumo SET idusuarioconvenio = %d, valor = %d, dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objConvenioConsumo->getObjusuarioconvenio()->getId() ),
				mysqli_real_escape_string( $this->con, $objConvenioConsumo->getValor() ),
				mysqli_real_escape_string( date('Y-m-d') ), //pega data atual
				mysqli_real_escape_string( $this->con, $objConvenioConsumo->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objConvenioConsumo = $objConvenioConsumo;
	}

	/*-- Deletar --*/
	function deletar(ConvenioConsumo $objConvenioConsumo){
		$this->sql = sprintf("DELETE FROM convenioconsumo WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objConvenioConsumo->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objConvenioConsumo = $objConvenioConsumo;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(ConvenioConsumo $objConvenioConsumo){
		$this->sql = sprintf("SELECT * FROM convenioconsumo WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objConvenioConsumo->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objConvenioUsuario = new ConvenioUsuario();
			$objConvenioUsuario->setId($row->idusuarioconvenio);
			$objConvenioUsuarioControl = new ConvenioUsuarioControl($objConvenioUsuario);
			$objConvenioUsuario = $objConvenioUsuarioControl->buscarPorId();
			
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->valor);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
				
			$this->objConvenioConsumo = new ConvenioConsumo($row->id, $objConvenioUsuario, $objEmpresa, $row->status, $row->observacao, $row->creditofixo, $row->datacadastro, $row->dataedicao);
		}

		return $this->objConvenioConsumo;
	}

	/*-- Listar Todos --*/
	function listarTodos(ConvenioConsumo $objConvenioConsumo){
		$this->sql = "SELECT * FROM convenioconsumo";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objConvenioUsuario = new ConvenioUsuario();
			$objConvenioUsuario->setId($row->idusuarioconvenio);
			$objConvenioUsuarioControl = new ConvenioUsuarioControl($objConvenioUsuario);
			$objConvenioUsuario = $objConvenioUsuarioControl->buscarPorId();
			
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->valor);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
				
			$this->objConvenioConsumo = new ConvenioConsumo($row->id, $objConvenioUsuario, $objEmpresa, $row->status, $row->observacao, $row->creditofixo, $row->datacadastro, $row->dataedicao);
			
			array_push($this->listaConvenioConsumo, $this->objConvenioConsumo);
		}

		return $this->listaConvenioConsumo;
	}
	
	/*-- Listar por convenio --*/
	function listarPorConvenioUsuario(ConvenioConsumo $objConvenioConsumo){
		$this->sql = "SELECT * FROM convenioconsumo WHERE idusuarioconvenio = $objConvenioConsumo->getObjusarioconvenio->getId()";//$idusuarioconvenio";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objConvenioUsuario = new ConvenioUsuario();
			$objConvenioUsuario->setId($row->idusuarioconvenio);
			$objConvenioUsuarioControl = new ConvenioUsuarioControl($objConvenioUsuario);
			$objConvenioUsuario = $objConvenioUsuarioControl->buscarPorId();
	
			$this->objConvenioConsumo = new ConvenioConsumo($row->id, $objConvenioUsuario, $row->valor, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaConvenioConsumo, $this->objConvenioConsumo);
		}
	
		return $this->listaConvenioConsumo;
	}
	
	/*-- Listar Por usuario --*/
//	function listarPorConvenioUsuario($idusuarioconvenio){
//		$this->sql = "SELECT * FROM convenioconsumo WHERE idusuarioconvenio = $idusuarioconvenio";
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
		$this->sql = "SELECT * FROM convenioconsumo limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM convenioconsumo";
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