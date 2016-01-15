<?php

namespace Portal\model;

class Notificacao implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $tipo;
	private $texto;
	private $objusuario;
	private $idremetente;
	private $tiporemetente;
	private $status;
	private $datacadastro;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		$tipo						 			= NULL,
		$texto				 					= NULL,
		Usuario $objusuario						= NULL,
		$idremetente							= NULL,
		$tiporemetente							= NULL,
		$status 								= NULL,
		$datacadastro							= NULL
	)
	{
		$this->id 					= $id;
		$this->tipo 				= $tipo;
		$this->texto 				= $texto;
		$this->objusuario 			= $objusuario;
		$this->idremetente 			= $idremetente;
		$this->tiporemetente		= $tiporemetente;
		$this->status 				= $status;
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
	public function getTipo() {
		return $this->tipo;
	}
	public function setTipo($tipo) {
		$this->tipo = $tipo;
		return $this;
	}
	public function getTexto() {
		return $this->texto;
	}
	public function setTexto($texto) {
		$this->texto = $texto;
		return $this;
	}
	public function getObjusuario() {
		return $this->objusuario;
	}
	public function setObjusuario($objusuario) {
		$this->objusuario = $objusuario;
		return $this;
	}
	public function getIdremetente() {
		return $this->idremetente;
	}
	public function setIdremetente($idremetente) {
		$this->idremetente = $idremetente;
		return $this;
	}
	public function getTiporemetente() {
		return $this->tiporemetente;
	}
	public function setTiporemetente($tiporemetente) {
		$this->tiporemetente = $tiporemetente;
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
	
	/*-- to string --*/
	public function __toString(){
		return sprintf("Notificacacao [ ID: %d, Tipo: %s, Texto: %s, Usuário: %s, ID Remetente: %s, Tipo Remetente: %s,  status: %s, Data Cadastro: %s]",
				$this->id, $this->tipo, $this->texto, $this->objusuario->getNome(), $this->idremetente, $this->tiporemetente, $this->status, $this->datacadastro );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'tipo'					=> $this->tipo,
			'texto'					=> $this->texto,
			'idusuario'				=> $this->objusuario->jsonSerialize(),
			'idremetente'			=> $this->idremetente,
			'tiporemetente'			=> $this->tiporemetente,
			'status'				=> $this->status,
			'datacadastro'			=> $this->datacadastro
		];
	}
	
	
	
	
}

?>