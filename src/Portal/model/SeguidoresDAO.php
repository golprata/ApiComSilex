<?php

namespace Portal\model;

class SeguidoresDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objSeguidores;
	private $listaSeguidores = array();
	
	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(Seguidores $objSeguidores){
		$this->sql = sprintf("INSERT INTO seguidores (idusuario, idseguido, tiposeguido, status)
				VALUES(%d, %d, '%s', '%s')",
				mysqli_real_escape_string( $this->con, $objSeguidores->getObjusuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objSeguidores->getIdseguido() ),
				mysqli_real_escape_string( $this->con, $objSeguidores->getTiposeguido() ),
				mysqli_real_escape_string( $this->con, $objSeguidores->getStatus() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(Seguidores $objSeguidores){
		$this->sql = sprintf("UPDATE seguidores SET idusuario = %d, idseguido  %d, tiposeguido = '%s', status = '%s', dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objSeguidores->getObjusuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objSeguidores->getIdseguido() ),
				mysqli_real_escape_string( $this->con, $objSeguidores->getTiposeguido() ),
				mysqli_real_escape_string( $this->con, $objSeguidores->getStatus() ),
				mysqli_real_escape_string( date('Y-m-d') ), //pega data atual
				mysqli_real_escape_string( $this->con, $objSeguidores->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objSeguidores = $objSeguidores;
	}

	/*-- Deletar --*/
	function deletar(Seguidores $objSeguidores){
		$this->sql = sprintf("DELETE FROM seguidores WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objSeguidores->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objSeguidores = $objSeguidores;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(Seguidores $objSeguidores){
		$this->sql = sprintf("SELECT * FROM seguidores WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objSeguidores->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objobjUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($obj);
			$objUsuario = $objUsuarioControl->buscarPorId();
			
			$this->objSeguidores = new Seguidores($row->id, $objUsuario, $row->idusuario, $row->idseguido, $row->tiposeguido, $row->status, $row->datacadastro, $row->dataedicao);
		}

		return $this->objSeguidores;
	}

	/*-- Listar Todos --*/
	function listarTodos(Seguidores $objSeguidores){
		$this->sql = "SELECT * FROM seguidores";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
	while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objobjUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($obj);
			$objUsuario = $objUsuarioControl->buscarPorId();
			
			$this->objSeguidores = new Seguidores($row->id, $objUsuario, $row->idusuario, $row->idseguido, $row->tiposeguido, $row->status, $row->datacadastro, $row->dataedicao);
			array_push($this->listaSeguidores, $this->objSeguidores);
		}

		return $this->listaSeguidores;
	}
	
	/*-- Listar Por Pessoa Fisica --*/
	function listarPorUsuario($idusuario){
		$this->sql = "SELECT * FROM seguidores WHERE idusuario = $idusuario";
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

	/*-- Listar Por Pessoa Fisica --*/
	function listarSeguidosPF($idusuario){
		$this->sql = "SELECT * FROM seguidores WHERE idusuario = $idusuario";
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

	/*-- Listar Por Pessoa Fisica --*/
	function listarSeguidosPJ($idusuario){
		$this->sql = "SELECT * FROM seguidores WHERE idusuario = $idusuario";
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

	function listarSeguidores($idseguido){
		$this->sql = "SELECT * FROM seguidores WHERE idseguido = $idseguido AND tiposeguido = 'PF'";
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

	function listarSeguidoresPJ($idseguido){
		$this->sql = "SELECT * FROM seguidores WHERE idseguido = $idseguido AND tiposeguido = 'PJ'";
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
		$this->sql = "SELECT * FROM seguidores limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM seguidores";
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