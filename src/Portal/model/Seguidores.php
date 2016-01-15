<?php

namespace Portal\model;

class Seguidores implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $objusuario;
	private $idseguido;
	private $tiposeguido;
	private $status;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		Usuario $objusuario						= NULL,
		$idseguido								= NULL,
		$tiposeguido							= NULL,
		$status									= NULL,
		$datacadastro							= NULL,
		$dataedicao 							= NULL
	)
	{
		$this->id 					= $id;
		$this->objusuario 			= $objusuario;
		$this->idseguido			= $idseguido;
		$this->tiposeguido			= $tiposeguido;
		$this->status				= $status;
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
	public function getIdseguido() {
		return $this->idseguido;
	}
	public function setIdseguido($idseguido) {
		$this->idseguido = $idseguido;
		return $this;
	}
	public function getTiposeguido() {
		return $this->tiposeguido;
	}
	public function setTiposeguido($tiposeguido) {
		$this->tiposeguido = $tiposeguido;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
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
		return sprintf("Seguidores [ ID: %d, Usuário: %s, ID Seguido: %d, Tipo Seguido: %s, Status: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->objusuario->getNome(), $this->idseguido, $this->tiposeguido, $this->status, $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'idusuario'				=> $this->objusuario->jsonSerialize(),
			'idseguido'				=> $this->idseguido,
			'tiposeguido'			=> $this->tiposeguido,
			'status'				=> $this->status,
			'datacadastro'			=> $this->datacadastro,
			'dataedicao'			=> $this->dataedicao
		];
	}
	
}

?>