<?php

namespace Portal\model;

class ConvenioEmpresa implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $objconvenio;
	private $objempresa;
	private $status;
	private $observacao;
	private $creditofixo;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		Convenio $objconvenio 					= NULL,
		Empresa $objempresa 					= NULL,
		$status									= NULL,
		$observacao								= NULL,
		$creditofixo							= NULL,
		$datacadastro							= NULL,
		$dataedicao 							= NULL
	)
	{
		$this->id 					= $id;
		$this->objconvenio 			= $objconvenio;
		$this->objempresa 			= $objempresa;
		$this->status 				= $status;
		$this->observacao 			= $observacao;
		$this->creditofixo 			= $creditofixo;
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
	public function getObjconvenio() {
		return $this->objconvenio;
	}
	public function setObjconvenio($objconvenio) {
		$this->objconvenio = $objconvenio;
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
	public function getCreditofixo() {
		return $this->creditofixo;
	}
	public function setCreditofixo($creditofixo) {
		$this->creditofixo = $creditofixo;
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
		return sprintf("ConvenioEmpresa [ ID: %d, Nome: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->objconvenio->getNome(), $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'idconvenio'			=> $this->objconvenio->jsonSerialize(),
			'idempresa'				=> $this->objempresa->jsonSerealize(),
			'status'				=> $this->status,
			'observacao'			=> $this->observacao,
			'creditofixo'			=> $this->creditofixo,
			'datacadastro'			=> $this->datacadastro,
			'dataedicao'			=> $this->dataedicao
		];
	}
	
	
	
}

?>