<?php

namespace Portal\model;

class NotificacaoDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objNotificacao;
	private $listaNotificacao = array();

	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(Notificacao $objNotificacao){
		$this->sql = sprintf("INSERT INTO notificacao ( tipo, texto, idusuario, idremetente, tiporemetente, status )
				VALUES('%s', '%s', %d, %d, '%s', '%s')",
				mysqli_real_escape_string( $this->con, $objNotificacao->getTipo() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getTexto() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getObjusuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getIdremetente() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getTiporemetente() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getStatus() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(Notificacao $objNotificacao){
		$this->sql = sprintf("UPDATE notificacao SET tipo = '%s', texto = '%s', idusuario = %d, idremetente = %d, tiporemetente = '%s', status = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objNotificacao->getTipo() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getTexto() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getObjusuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getIdremetente() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getIdTiporemetente() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getStatus() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objNotificacao = $objNotificacao;
	}

	/*-- Atualiza status para lido --*/
	function atualizarStatus(Notificacao $objNotificacao){
		$this->sql = sprintf("UPDATE notificacao SET status = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objNotificacao->getStatus() ),
				mysqli_real_escape_string( $this->con, $objNotificacao->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objNotificacao = $objNotificacao;
	}
	
	/*-- Deletar --*/
	function deletar(Notificacao $objNotificacao){
		$this->sql = sprintf("DELETE FROM notificacao WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objNotificacao->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objNotificacao = $objNotificacao;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(Notificacao $objNotificacao){
		$this->sql = sprintf("SELECT * FROM notificacao WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objNotificacao->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
	
			$this->objNotificacao = new Notificacao($row->id, $row->tipo, $row->texto, $objUsuario, $row->idremetente, $row->tiporemetente, $row->status, $row->datacadastro);
	
		}

		return $this->objNotificacao;
	}

	/*-- Listar Todos --*/
	function listarTodos(Notificacao $objNotificacao){
		$this->sql = "SELECT * FROM notificacao";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
	
			$this->objNotificacao = new Notificacao($row->id, $row->tipo, $row->texto, $objUsuario, $row->idremetente, $row->tiporemetente, $row->status, $row->datacadastro);
	
			array_push($this->listaNotificacao, $this->objNotificacao);
		}

		return $this->listaNotificacao;
	}
	
	/*-- Listar Todos Pendentes--*/
	function listarTodosPendentesPorUsuario(Notificacao $objNotificacao){
		$this->sql = "SELECT * FROM notificacao WHERE idusuario =" . $objNotificacao->getObjusuario()->getId() . " AND status = 'PENDENTE' ORDER BY ID DESC ";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
	
			$this->objNotificacao = new Notificacao($row->id, $row->tipo, $row->texto, $objUsuario, $row->idremetente, $row->tiporemetente, $row->status, $row->datacadastro);
	
			array_push($this->listaNotificacao, $this->objNotificacao);
		}
	
		return $this->listaNotificacao;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM notificacao limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM notificacao";
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
	
	/*-- Quantidade Total não lidos --*/
	function qtdTotalPendente(Notificacao $objNotificacao) {
		$this->sql = "SELECT count(*) as quantidade FROM notificacao WHERE idusuario=" . $objNotificacao->getObjusuario()->getId() . " AND status = 'PENDENTE' ";
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