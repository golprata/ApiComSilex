<?php

namespace Portal\model;

class ListaDesejo implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $objcupom;
	private $objusuario;
	private $status;
	private $observacao;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		Cupom $objcupom							= NULL,
		Usuario $objusuario						= NULL,
		$status									= NULL,
		$observacao								= NULL,
		$datacadastro							= NULL,
		$dataedicao 							= NULL
	)
	{
		$this->id 								= $id;
		$this->objcupom							= $objcupom;
		$this->objusuario						= $objusuario;
		$this->status							= $status;
		$this->observacao						= $observacao;
		$this->datacadastro 					= $datacadastro;
		$this->dataedicao 						= $dataedicao;
	}
	
	/*-- Getters and Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getIdcupom() {
		return $this->objcupom;
	}
	public function setIdcupom($objcupom) {
		$this->objcupom = $objcupom;
		return $this;
	}
	public function getIdusuario() {
		return $this->objusuario;
	}
	public function setIdusuario($objusuario) {
		$this->objusuario = $objusuario;
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
	public function getDataedicao() {
		return $this->dataedicao;
	}
	public function setDataedicao($dataedicao) {
		$this->dataedicao = $dataedicao;
		return $this;
	}
	
	/*-- to string --*/
	public function __toString(){
		return sprintf("ListaDesejo [ ID: %d, Nome: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->nome, $this->datacadastro, $this->dataedicao );
	}
	
	public static function factory($data) {
		return new ListaDesejo(
				$data['id'],
				$data['objcupom'],
				$data['objusuario'],
				$data['status'],
				$data['observacao']
			 );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id' 							=> $this->id,
			'objcupom'						=> $this->objcupom->jsonSerialize(),
			'objusuario'					=> $this->objusuario->jsonSerialize(),
			'status'						=> $this->status,
			'observacao'					=> $this->observacao,
			'datacadastro' 					=> $this->datacadastro,
			'dataedicao' 					=> $this->dataedicao
		];
	}
	
	
}

?>