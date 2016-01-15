<?php

namespace Portal\model;

class Lead implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $objsegmento;
	private $objempresa;
	private $usuario;
	private $senha;
	private $dadospf;
	private $datacadastro;
	private $dataedicao;
	private $dataexpiracao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		Segmento $objsegmento					= NULL,
		Empresa $objempresa 					= NULL,
		$usuario 								= NULL,
		$senha 									= NULL,
		$dadospf	 							= NULL,
		$datacadastro							= NULL,
		$dataedicao 							= NULL,
		$dataexpiracao 							= NULL
	)
	{
		$this->id 					= $id;
		$this->objsegmento 			= $objsegmento;
		$this->objempresa			= $objempresa;
		$this->usuario		 		= $usuario;
		$this->senha		 		= $senha;
		$this->dadospf		 		= $dadospf;
		$this->datacadastro 		= $datacadastro;
		$this->dataedicao 			= $dataedicao;
		$this->dataexpiracao 		= $dataexpiracao;
	}
	
	/*-- Getters and Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getObjsegmento() {
		return $this->objsegmento;
	}
	public function setObjsegmento($objsegmento) {
		$this->objsegmento = $objsegmento;
		return $this;
	}
	public function getObjempresa() {
		return $this->objempresa;
	}
	public function setObjempresa($objempresa) {
		$this->objempresa = $objempresa;
		return $this;
	}
	public function getUsuario() {
		return $this->usuario;
	}
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
		return $this;
	}
	public function getSenha() {
		return $this->senha;
	}
	public function setSenha($senha) {
		$this->senha = $senha;
		return $this;
	}
	public function getDadospf() {
		return $this->dadospf;
	}
	public function setDadospf($dadospf) {
		$this->dadospf = $dadospf;
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
	public function getDataexpiracao() {
		return $this->dataexpiracao;
	}
	public function setDataexpiracao($dataexpiracao) {
		$this->dataexpiracao = $dataexpiracao;
		return $this;
	}
	
	
	/*-- to string --*/
	public function __toString(){
		return sprintf("Lead [ ID: %d, Segmento: %s, Empresa: %s, Usu�rio: %s, Senha: %s, DadosPF: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->objsegmento->getDescricao(), $this->objempresa, $this->usuario, $this->senha, $this->dadospf, $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'idsegmento'			=> $this->objsegmento->jsonSerialize(),
			'idempresa'				=> $this->objempresa,
			'usuario'				=> $this->usuario,
			'senha'					=> $this->senha,
			'dadospf'				=> $this->dadospf,
			'datacadastro'			=> $this->datacadastro,
			'dataedicao'			=> $this->dataedicao,
			'dataexpiracao'			=> $this->dataexpiracao
		];
	}
	
	
}

?>