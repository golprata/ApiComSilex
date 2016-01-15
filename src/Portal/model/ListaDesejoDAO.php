<?php

namespace Portal\model;

class ListaDesejoDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objListaDesejo;
	private $listaListaDesejo = array();

	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(ListaDesejo $objListaDesejo){
		$this->sql = sprintf("INSERT INTO listadesejo (idcupom, idusuario, status, observacao)
				VALUES(%d, %d, '%s', '%s')",
				mysqli_real_escape_string( $this->con, $objListaDesejo->getObjcupom()->getId() ),
				mysqli_real_escape_string( $this->con, $objListaDesejo->getObjusuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objListaDesejo->getStatus() ),
				mysqli_real_escape_string( $this->con, $objListaDesejo->getObservacao() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] CadastroListaDesejo: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(ListaDesejo $objListaDesejo){
		$this->sql = sprintf("UPDATE listadesejo SET idcupom = %d, idusuario = %d, status = '%s', observacao = '%s', dataedeicao = '%s' WHERE id = %d ",
				mysqli_real_escape_string( $this->con, $objListaDesejo->getObjcupom()->getId() ),
				mysqli_real_escape_string( $this->con, $objListaDesejo->getObjusuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objListaDesejo->getStatus() ),
				mysqli_real_escape_string( $this->con, $objListaDesejo->getObservacao() ),
				mysqli_real_escape_string( $this->con, date('Y-m-d') ), //pega data atual
				mysqli_real_escape_string( $this->con, $objListaDesejo->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objListaDesejo = $objListaDesejo;
	}

	/*-- Deletar --*/
	function deletar(ListaDesejo $objListaDesejo){
		$this->sql = sprintf("DELETE FROM listadesejo WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objListaDesejo->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objListaDesejo = $objListaDesejo;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(ListaDesejo $objListaDesejo){
		$this->sql = sprintf("SELECT * FROM listadesejo WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objListaDesejo->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objCupom = new Cupom();
			$objCupom->setId($row->idcupom);
			$objCupomControl = new CupomControl($objCupom);
			$objCupom = $objCupomControl->buscarPorId();
			
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
			
			$this->objListaDesejo = new ListaDesejo($row->id, $objCupom, $objUsuario, $row->status, $row->observacao, $row->datacadastro, $row->dataedicao);
		}

		return $this->objListaDesejo;
	}

	/*-- Listar Todos --*/
	function listarTodos(ListaDesejo $objListaDesejo){
		$this->sql = "SELECT * FROM listadesejo WHERE DATE(data_final) >= CURDATE()";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objCupom = new Cupom();
			$objCupom->setId($row->idcupom);
			$objCupomControl = new CupomControl($objCupom);
			$objCupom = $objCupomControl->buscarPorId();
				
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
				
			$this->objListaDesejo = new ListaDesejo($row->id, $objCupom, $objUsuario, $row->status, $row->observacao, $row->datacadastro, $row->dataedicao);

			array_push($this->listaListaDesejo, $this->objListaDesejo);
		}

		return $this->listaListaDesejo;
	}
	
	/*-- Listar Todos --*/
	function listarPorAdmin($idadm){
		$this->sql = "SELECT * FROM listadesejo WHERE idadm = $idadm";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objCupom = new Cupom();
			$objCupom->setId($row->idcupom);
			$objCupomControl = new CupomControl($objCupom);
			$objCupom = $objCupomControl->buscarPorId();
				
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
				
			$this->objListaDesejo = new ListaDesejo($row->id, $objCupom, $objUsuario, $row->status, $row->observacao, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaListaDesejo, $this->objListaDesejo);
		}
	
		return $this->listaListaDesejo;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM listadesejo limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM listadesejo";
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