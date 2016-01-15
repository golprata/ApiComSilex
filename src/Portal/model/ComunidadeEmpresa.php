<?php

namespace Portal\model;

class ComunidadeEmpresa implements JsonSerializable {
	/*-- atributos --*/
	private $id;
	private $objcomunidade;
	private $objempresa;
	private $status;
	private $observacao;
	private $datacadastro;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 								= NULL,
		Comunidade $objcomunidade			= NULL,
		Empresa $objempresa					= NULL,
		$status								= NULL,
		$observacao							= NULL,
		$datacadastro						= NULL
	)
	{
		$this->id 								= $id;
		$this->objcomunidade					= $objcomunidade;
		$this->objempresa						= $objempresa;
		$this->status							= $status;
		$this->observacao						= $observacao;
		$this->datacadastro						= $datacadastro;
	}
	
	/*-- Getters and Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getObjcomunidade() {
		return $this->objcomunidade;
	}
	public function setObjcomunidade($objcomunidade) {
		$this->objcomunidade = $objcomunidade;
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
	public function getDatacadastro() {
		return $this->datacadastro;
	}
	public function setDatacadastro($datacadastro) {
		$this->datacadastro = $datacadastro;
		return $this;
	}
	
	/*-- to string --*/
	public function __toString(){
		return sprintf("ComunidadeEmpresa [ ID: %d, IDGeral: %d, TipoID: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->idgeral, $this->tipoid, $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id' 							=> $this->id,
			'objcomunidade'					=> $this->objcomunidade->jsonSerialize(),
			'objempresa'					=> $this->objempresa->jsonSerialize(),
			'status'						=> $this->status,
			'observacao'					=> $this->observacao,
			'datacadastro'					=> $this->datacadastro
		];
	}
	
}

?>