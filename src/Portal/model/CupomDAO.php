<?php

namespace Portal\model;

class CupomDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objCupom;
	private $listaCupom = array();

	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(Cupom $objCupom){
		$this->sql = sprintf("INSERT INTO cupom (nome, de_valor, para_valor, desconto, quantidade, descricao, categoria, marca, imagem1, imagem2, imagem3, regras, data_inicial, data_final, validade, tipo, tag)
				VALUES('%s', %f, %f, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, '%s', '%s')",
				mysqli_real_escape_string( $this->con, $objCupom->getNome() ),
				mysqli_real_escape_string( $this->con, $objCupom->getDeValor() ),
				mysqli_real_escape_string( $this->con, $objCupom->getParaValor() ),
				mysqli_real_escape_string( $this->con, $objCupom->getDesconto() ),
				mysqli_real_escape_string( $this->con, $objCupom->getQuantidade() ),
				mysqli_real_escape_string( $this->con, $objCupom->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objCupom->getCategoria() ),
				mysqli_real_escape_string( $this->con, $objCupom->getMarca() ),
				mysqli_real_escape_string( $this->con, $objCupom->getImagem1() ),
				mysqli_real_escape_string( $this->con, $objCupom->getImagem2() ),
				mysqli_real_escape_string( $this->con, $objCupom->getImagem3() ),
				mysqli_real_escape_string( $this->con, $objCupom->getRegras() ),
				mysqli_real_escape_string( $this->con, $objCupom->getDataInicial() ),
				mysqli_real_escape_string( $this->con, $objCupom->getDataFinal() ),
				mysqli_real_escape_string( $this->con, $objCupom->getValidade() ),
				mysqli_real_escape_string( $this->con, $objCupom->getTipo() ),
				mysqli_real_escape_string( $this->con, $objCupom->getTag() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] CadastroCupom: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(Cupom $objCupom){
		$this->sql = sprintf("UPDATE cupom SET nome = '%s', de_valor = %f, para_valor = %f, desconto = %d, quantidade = %d, descricao = '%s', categoria = '%s', marca = '%s', imagem1 = '%s', imagem2 = '%s', imagem3 = '%s', regras = '%s', data_inicial = '%s', data_final = '%s', validade = '%s', tipo = '%s', tag = '%s', dataedeicao = '%s' WHERE id = %d ",
				mysqli_real_escape_string( $this->con, $objCupom->getNome() ),
				mysqli_real_escape_string( $this->con, $objCupom->getDeValor() ),
				mysqli_real_escape_string( $this->con, $objCupom->getParaValor() ),
				mysqli_real_escape_string( $this->con, $objCupom->getDesconto() ),
				mysqli_real_escape_string( $this->con, $objCupom->getQuantidade() ),
				mysqli_real_escape_string( $this->con, $objCupom->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objCupom->getCategoria() ),
				mysqli_real_escape_string( $this->con, $objCupom->getMarca() ),
				mysqli_real_escape_string( $this->con, $objCupom->getImagem1() ),
				mysqli_real_escape_string( $this->con, $objCupom->getImagem2() ),
				mysqli_real_escape_string( $this->con, $objCupom->getImagem3() ),
				mysqli_real_escape_string( $this->con, $objCupom->getRegras() ),
				mysqli_real_escape_string( $this->con, $objCupom->getDataInicial() ),
				mysqli_real_escape_string( $this->con, $objCupom->getDataFinal() ),
				mysqli_real_escape_string( $this->con, $objCupom->getValidade() ),
				mysqli_real_escape_string( $this->con, $objCupom->getTipo() ),
				mysqli_real_escape_string( $this->con, $objCupom->getTag() ),
				mysqli_real_escape_string( $this->con, date('Y-m-d') ), //pega data atual
				mysqli_real_escape_string( $this->con, $objCupom->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objCupom = $objCupom;
	}

	/*-- Deletar --*/
	function deletar(Cupom $objCupom){
		$this->sql = sprintf("DELETE FROM cupom WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objCupom->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objCupom = $objCupom;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(Cupom $objCupom){
		$this->sql = sprintf("SELECT * FROM cupom WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objCupom->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			
			$this->objCupom = new Cupom($row->id, $row->nome, $row->de_valor, $row->para_valor, $row->desconto, $row->quantidade, $row->descricao, $row->categoria, $row->marca, $row->imagem1, $row->imagem2, $row->imagem3, $row->regras, $row->data_inicial, $row->data_final, $row->validade, $row->tipo, $row->tag, $row->datacadastro, $row->dataedicao);
		}

		return $this->objCupom;
	}

	/*-- Listar Todos --*/
	function listarTodos(Cupom $objCupom){
		$this->sql = "SELECT * FROM cupom WHERE DATE(data_final) >= CURDATE()";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
				
			$this->objCupom = new Cupom($row->id, $row->nome, $row->de_valor, $row->para_valor, $row->desconto, $row->quantidade, $row->descricao, $row->categoria, $row->marca, $row->imagem1, $row->imagem2, $row->imagem3, $row->regras, $row->data_inicial, $row->data_final, $row->validade, $row->tipo, $row->tag, $row->datacadastro, $row->dataedicao);

			array_push($this->listaCupom, $this->objCupom);
		}

		return $this->listaCupom;
	}
	
	/*-- Listar Todos --*/
	function listarPorAdmin($idadm){
		$this->sql = "SELECT * FROM cupom WHERE idadm = $idadm";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
	
			$this->objCupom = new Cupom($row->id, $row->nome, $row->de_valor, $row->para_valor, $row->desconto, $row->quantidade, $row->descricao, $row->categoria, $row->marca, $row->imagem1, $row->imagem2, $row->imagem3, $row->regras, $row->data_inicial, $row->data_final, $row->validade, $row->tipo, $row->tag, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaCupom, $this->objCupom);
		}
	
		return $this->listaCupom;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM cupom limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM cupom";
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