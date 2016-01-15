<?php
namespace Portal\model;

class AdminEmpresa implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $objusuario;
	private $objempresa;
	private $status;
	private $observacao;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		Usuario $objusuario 					= NULL,
		Empresa $objempresa 					= NULL,
		$status									= NULL,
		$observacao								= NULL,
		$datacadastro							= NULL,
		$dataedicao 							= NULL
	)
	{
		$this->id 					= $id;
		$this->objusuario 			= $objusuario;
		$this->objempresa 			= $objempresa;
		$this->status 				= $status;
		$this->observacao 			= $observacao;
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
	public function getObjusuario() {
		return $this->objusuario;
	}
	public function setObjusuario($objusuario) {
		$this->objusuario = $objusuario;
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
	public function getDataedicao() {
		return $this->dataedicao;
	}
	public function setDataedicao($dataedicao) {
		$this->dataedicao = $dataedicao;
		return $this;
	}
	
	/*-- to string --*/
	public function __toString(){
		return sprintf("ComplementosPF [ ID: %d, Pessoa Física: %s, Empresa: %s, Segmento: %s, IDImportado: %d, Dados: %s,  Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->objusuario->getNome(), $this->objempresa->getNomereduzido(), $this->objsegmento->getDescricao(), $this->status, $this->observacao, $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'idusuario'				=> $this->objusuario->jsonSerialize(),
			'idempresa'				=> $this->objempresa->jsonSerealize(),
			'status'				=> $this->status,
			'observacao'			=> $this->observacao,
			'datacadastro'			=> $this->datacadastro,
			'dataedicao'			=> $this->dataedicao
		];
	}
	
	
	
}

?>