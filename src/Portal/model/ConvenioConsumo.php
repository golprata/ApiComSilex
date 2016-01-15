<?php

namespace Portal\model;

class UsuarioConveioConsumo implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $objusarioconvenio;
	private $objempresa;
	private $status;
	private $observacao;
	private $valor;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		UsuarioConveio $objusarioconvenio 		= NULL,
		$valor									= NULL,
		$datacadastro							= NULL
	)
	{
		$this->id 					= $id;
		$this->objusarioconvenio 	= $objusarioconvenio;
		$this->valor 				= $valor;
		$this->datacadastro 		= $datacadastro;
	}
	
	/*-- Getters and Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getObjusarioconvenio() {
		return $this->objusarioconvenio;
	}
	public function setObjusarioconvenio($objusarioconvenio) {
		$this->objusarioconvenio = $objusarioconvenio;
		return $this;
	}
	public function getObjempresa() {
		return $this->objempresa;
	}
	public function setObjempresa($objempresa) {
		$this->objempresa = $objempresa;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
	public function getObservacao() {
		return $this->observacao;
	}
	public function setObservacao($observacao) {
		$this->observacao = $observacao;
		return $this;
	}
	public function getValor() {
		return $this->valor;
	}
	public function setValor($valor) {
		$this->valor = $valor;
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
		return sprintf("UsuarioConveioConsumo [ ID: %d, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'idusuarioconvenio'		=> $this->objusarioconvenio->jsonSerialize(),
			'valor'					=> $this->valor,
			'datacadastro'			=> $this->datacadastro,
		];
	}
	
	
}

?>