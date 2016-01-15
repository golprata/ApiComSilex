<?php
namespace Portal\model;

class AdminEmpresaDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objAdminEmpresa;
	private $listaAdminEmpresa = array();
	
	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(AdminEmpresa $objAdminEmpresa){
		$this->sql = sprintf("INSERT INTO adminempresa (idusuario, idempresa, status, observacao)
				VALUES(%d, %d, '%s', '%s')",
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getObjusuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getObjempresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getStatus() ),
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getObservacao() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(AdminEmpresa $objAdminEmpresa){
		$this->sql = sprintf("UPDATE adminempresa SET idusuario = %d, idempresa = %d, status = '%s', observacao = '%s', dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getObjusuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getObjempresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getStatus() ),
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getObservacao() ),
				mysqli_real_escape_string( date('Y-m-d') ), //pega data atual
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objAdminEmpresa = $objAdminEmpresa;
	}

	/*-- Deletar --*/
	function deletar(AdminEmpresa $objAdminEmpresa){
		$this->sql = sprintf("DELETE FROM adminempresa WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objAdminEmpresa = $objAdminEmpresa;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(AdminEmpresa $objAdminEmpresa){
		$this->sql = sprintf("SELECT * FROM adminempresa WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objAdminEmpresa->getId() ) );

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
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
				
			$this->objAdminEmpresa = new AdminEmpresa($row->id, $objUsuario, $objEmpresa, $row->status, $row->observacao, $row->datacadastro, $row->dataedicao);
		}

		return $this->objAdminEmpresa;
	}

	/*-- Listar Todos --*/
	function listarTodos(AdminEmpresa $objAdminEmpresa){
		$this->sql = "SELECT * FROM adminempresa";
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
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
				
			$this->objAdminEmpresa = new AdminEmpresa($row->id, $objUsuario, $objEmpresa, $row->status, $row->observacao, $row->datacadastro, $row->dataedicao);
			
			array_push($this->listaAdminEmpresa, $this->objAdminEmpresa);
		}

		return $this->listaAdminEmpresa;
	}
	
	/*-- Listar por empresa --*/
	function listarPorEmpresa(AdminEmpresa $objAdminEmpresa){
		$this->sql = "SELECT * FROM adminempresa WHERE idempresa = $idempresa";
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
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
	
			$this->objAdminEmpresa = new AdminEmpresa($row->id, $objUsuario, $objEmpresa, $row->status, $row->observacao, $row->datacadastro, $row->dataedicao);
				
			array_push($this->listaAdminEmpresa, $this->objAdminEmpresa);
		}
	
		return $this->listaAdminEmpresa;
	}
	
	/*-- Listar Por usuario --*/
	function listarPorUsuario($idusuario){
		$this->sql = "SELECT * FROM adminempresa WHERE idusuario = $idusuario";
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
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM adminempresa limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM adminempresa";
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