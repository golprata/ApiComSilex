<?php

namespace Portal\model;

class Cupom implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $nome;
	private $de_valor;
	private $para_valor;
	private $desconto;
	private $quantidade;
	private $descricao;
	private $categoria;
	private $marca;
	private $imagem1;
	private $imagem2;
	private $imagem3;
	private $regras;
	private $data_inicial;
	private $data_final;
	private $validade;
	private $tag;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		$nome 									= NULL,
		$de_valor								= NULL,
		$para_valor 							= NULL,
		$desconto 								= NULL,
		$quantidade								= NULL,
		$descricao								= NULL,
		$categoria								= NULL,
		$marca 									= NULL,
		$imagem1								= NULL,
		$imagem2								= NULL,
		$imagem3								= NULL,
		$regras									= NULL,
		$data_inicial							= NULL,
		$data_final								= NULL,
		$validade								= NULL,
		$tipo									= NULL,
		$tag									= NULL,
		$datacadastro							= NULL,
		$dataedicao 							= NULL
	)
	{
		$this->id 					= $id;
		$this->nome					= $nome;
		$this->de_valor				= $de_valor;
		$this->para_valor			= $para_valor;
		$this->desconto				= $desconto;
		$this->quantidade 			= $quantidade;
		$this->descricao 			= $descricao;
		$this->categoria 			= $categoria;
		$this->marca 				= $marca;
		$this->imagem1 				= $imagem1;
		$this->imagem2 				= $imagem2;
		$this->imagem3 				= $imagem3;
		$this->regras 				= $regras;
		$this->data_inicial 		= $data_inicial;
		$this->data_final 			= $data_final;
		$this->validade 			= $validade;
		$this->tipo 				= $tipo;
		$this->tag 					= $tag;
		$this->datacadastro 		= $datacadastro;
		$this->dataedicao 			= $dataedicao;
	}
	
	/*-- Getters and Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
		return $this;
	}
	public function getDeValor() {
		return $this->de_valor;
	}
	public function setDeValor($de_valor) {
		$this->de_valor = $de_valor;
		return $this;
	}
	public function getParaValor() {
		return $this->para_valor;
	}
	public function setParaValor($para_valor) {
		$this->para_valor = $para_valor;
		return $this;
	}
	public function getDesconto() {
		return $this->desconto;
	}
	public function setDesconto($desconto) {
		$this->desconto = $desconto;
		return $this;
	}
	public function getQuantidade() {
		return $this->quantidade;
	}
	public function setQuantidade($quantidade) {
		$this->quantidade = $quantidade;
		return $this;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}
	public function getCategoria() {
		return $this->categoria;
	}
	public function setCategoria($categoria) {
		$this->categoria = $categoria;
		return $this;
	}
	public function getMarca() {
		return $this->marca;
	}
	public function setMarca($marca) {
		$this->marca = $marca;
		return $this;
	}
	public function getImagem1() {
		return $this->imagem1;
	}
	public function setImagem1($imagem1) {
		$this->imagem1 = $imagem1;
		return $this;
	}
	public function getImagem2() {
		return $this->imagem2;
	}
	public function setImagem2($imagem2) {
		$this->imagem2 = $imagem2;
		return $this;
	}
	public function getImagem3() {
		return $this->imagem3;
	}
	public function setImagem3($imagem3) {
		$this->imagem3 = $imagem3;
		return $this;
	}
	public function getRegras() {
		return $this->regras;
	}
	public function setRegras($regras) {
		$this->regras = $regras;
		return $this;
	}
	public function getDataInicial() {
		return $this->data_inicial;
	}
	public function setDataInicial($data_inicial) {
		$this->data_inicial = $data_inicial;
		return $this;
	}
	public function getDataFinal() {
		return $this->data_final;
	}
	public function setDataFinal($data_final) {
		$this->data_final = $data_final;
		return $this;
	}
	public function getValidade() {
		return $this->validade;
	}
	public function setValidade($validade) {
		$this->validade = $validade;
		return $this;
	}
	public function getTipo() {
		return $this->tipo;
	}
	public function setTipo($tipo) {
		$this->tipo = $tipo;
		return $this;
	}
	public function getTag() {
		return $this->tag;
	}
	public function setTag($tag) {
		$this->tag = $tag;
		return $this;
	}
	public function getDatacadastro() {
		return $this->datacadastro;
	}
	public function setDatacadastro($datacadastro) {
		$this->datacadastro = $datacadastro;
		return $this;
	}
	public function getDataedicao() {
		return $this->dataedicao;
	}
	public function setDataedicao($dataedicao) {
		$this->dataedicao = $dataedicao;
		return $this;
	}
	
	
	/*-- to string --*/
	public function __toString(){
		return sprintf("Cupom [ ID: %d, Nome: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->nome, $this->datacadastro, $this->dataedicao );
	}
	
	/*
		create
	*/
	
	public static function factory($data) {
		return new Cupom(
				$data['id'],
				$data['nome'],
				$data['de_valor'],
				$data['para_valor'],
				$data['desconto'],
				$data['quantidade'],
				$data['descricao'],
				$data['categoria'],
				$data['marca'],
				$data['imagem1'],
				$data['imagem2'],
				$data['imagem3'],
				$data['regras'],
				$data['data_inicial'],
				$data['data_final'],
				$data['validade'],
				$data['tipo'],
				$data['tag']
				);
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'nome'					=> $this->nome,
			'de_valor'				=> $this->de_valor,
			'para_valor'			=> $this->para_valor,
			'desconto'				=> $this->desconto,
			'quantidade'			=> $this->quantidade,
			'descricao'				=> $this->descricao,
			'categoria'				=> $this->categoria,
			'marca'					=> $this->marca,
			'imagem1'				=> $this->imagem1,
			'imagem2'				=> $this->imagem2,
			'imagem3'				=> $this->imagem3,
			'regras'				=> $this->regras,
			'data_inicial'			=> $this->data_inicial,
			'data_final'			=> $this->data_final,
			'validade'				=> $this->validade,
			'tipo'					=> $this->tipo,
			'tag'					=> $this->tag,
			'datacadastro'			=> $this->datacadastro,
			'dataedicao'			=> $this->dataedicao
		];
	}
	
	
	
}

?>