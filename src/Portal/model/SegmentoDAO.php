<?php

namespace Portal\model;

class SegmentoDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objSegmento;
	private $listaSegmento = array();

	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(Segmento $objSegmento){
		$this->sql = sprintf("INSERT INTO segmento (descricao)
				VALUES('%s')",
				mysqli_real_escape_string( $this->con, $objSegmento->getDescricao() ));

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(Segmento $objSegmento){
		$this->sql = sprintf("UPDATE segmento SET descricao = '%s', dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objSegmento->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objSegmento->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objSegmento->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objSegmento = $objSegmento;
	}

	/*-- Deletar --*/
	function deletar(Segmento $objSegmento){
		$this->sql = sprintf("DELETE FROM segmento WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objSegmento->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objSegmento = $objSegmento;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(Segmento $objSegmento){
		$this->sql = sprintf("SELECT * FROM segmento WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objSegmento->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$this->objSegmento = new Segmento($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
		}

		return $this->objSegmento;
	}

	/*-- Listar Todos --*/
	function listarTodos(Segmento $objSegmento){
		$this->sql = "SELECT * FROM segmento";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$this->objSegmento = new Segmento($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);

			array_push($this->listaSegmento, $this->objSegmento);
		}

		return $this->listaSegmento;
	}
	
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM segmento limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM segmento";
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