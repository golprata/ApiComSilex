<?php

namespace Portal\model;

class ComplementoPFDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objComplementoPF;
	private $listaComplementoPF = array();
	
	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(ComplementoPF $objComplementoPF){
		$this->sql = sprintf("INSERT INTO complementopf (idpessoafisica, idempresa, idsegmento, idimportado, dados)
				VALUES(%d, %d, %d, %d, '%s')",
				mysqli_real_escape_string( $this->con, $objComplementoPF->getObjpessoafisica()->getId() ),
				mysqli_real_escape_string( $this->con, $objComplementoPF->getObjempresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objComplementoPF->getObjsegmento()->getId() ),
				mysqli_real_escape_string( $this->con, $objComplementoPF->getIdimportado() ),
				mysqli_real_escape_string( $this->con, $objComplementoPF->getDados() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(ComplementoPF $objComplementoPF){
		$this->sql = sprintf("UPDATE complementopf SET idpessoafisica = %d, idempresa = %d, idsegmento = %d, idimportado = %d, dados = '%s', dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objComplementoPF->getObjpessoafisica()->getId() ),
				mysqli_real_escape_string( $this->con, $objComplementoPF->getObjempresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objComplementoPF->getObjsegmento()->getId() ),
				mysqli_real_escape_string( $this->con, $objComplementoPF->getIdimportado() ),
				mysqli_real_escape_string( $this->con, $objComplementoPF->getDados() ),
				mysqli_real_escape_string( date('Y-m-d') ), //pega data atual
				mysqli_real_escape_string( $this->con, $objComplementoPF->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objComplementoPF = $objComplementoPF;
	}

	/*-- Deletar --*/
	function deletar(ComplementoPF $objComplementoPF){
		$this->sql = sprintf("DELETE FROM complementopf WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objComplementoPF->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objComplementoPF = $objComplementoPF;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(ComplementoPF $objComplementoPF){
		$this->sql = sprintf("SELECT * FROM complementopf WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objComplementoPF->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idpessoafisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();
			
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
				
			$objSegmento = new Segmento();
			$objSegmento->setId($row->idsegmento);
			$objSegmentoControl = new SegmentoControl($objSegmento);
			$objSegmento = $objSegmentoControl->buscarPorId();
			
			$this->objComplementoPF = new ComplementoPF($row->id, $objPessoaFisica, $objEmpresa, $objSegmento, $row->idimportado, $row->dados, $row->datacadastro, $row->dataedicao);
		}

		return $this->objComplementoPF;
	}

	/*-- Listar Todos --*/
	function listarTodos(ComplementoPF $objComplementoPF){
		$this->sql = "SELECT * FROM complementopf";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idpessoafisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();
			
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
				
			$objSegmento = new Segmento();
			$objSegmento->setId($row->idsegmento);
			$objSegmentoControl = new SegmentoControl($objSegmento);
			$objSegmento = $objSegmentoControl->buscarPorId();
			
			$this->objComplementoPF = new ComplementoPF($row->id, $objPessoaFisica, $objEmpresa, $objSegmento, $row->idimportado, $row->dados, $row->datacadastro, $row->dataedicao);
		
			array_push($this->listaComplementoPF, $this->objComplementoPF);
		}

		return $this->listaComplementoPF;
	}
	
	/*-- Listar Por Pessoa Fisica --*/
	function listarPorPessoaFisica($idpessoafisica){
		$this->sql = "SELECT * FROM complementopf WHERE idpessoafisica = $idpessoafisica";
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
		$this->sql = "SELECT * FROM complementopf limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM complementopf";
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