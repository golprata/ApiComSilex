<?php

namespace Portal\model;

class ComplementoPF implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $objpessoafisica;
	private $objempresa;
	private $objsegmento;
	private $idimportado;
	private $dados;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		PessoaFisica $objpessoafisica 			= NULL,
		Empresa $objempresa 					= NULL,
		Segmento $objsegmento					= NULL,
		$idimportado							= NULL,
		$dados									= NULL,
		$datacadastro							= NULL,
		$dataedicao 							= NULL
	)
	{
		$this->id 					= $id;
		$this->objpessoafisica 		= $objpessoafisica;
		$this->objempresa 			= $objempresa;
		$this->objsegmento 			= $objsegmento;
		$this->idimportado 			= $idimportado;
		$this->dados 				= $dados;
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
	public function getObjpessoafisica() {
		return $this->objpessoafisica;
	}
	public function setObjpessoafisica($objpessoafisica) {
		$this->objpessoafisica = $objpessoafisica;
		return $this;
	}
	public function getObjempresa() {
		return $this->objempresa;
	}
	public function setObjempresa($objempresa) {
		$this->objempresa = $objempresa;
		return $this;
	}
	public function getObjsegmento() {
		return $this->objsegmento;
	}
	public function setObjsegmento($objsegmento) {
		$this->objsegmento = $objsegmento;
		return $this;
	}
	public function getIdimportado() {
		return $this->idimportado;
	}
	public function setIdimportado($idimportado) {
		$this->idimportado = $idimportado;
		return $this;
	}
	public function getDados() {
		return $this->dados;
	}
	public function setDados($dados) {
		$this->dados = $dados;
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
				$this->id, $this->objpessoafisica->getNome(), $this->objempresa->getNomereduzido(), $this->objsegmento->getDescricao(), $this->idimportado, $this->dados, $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'idpessoafisica'		=> $this->objpessoafisica->jsonSerialize(),
			'idempresa'				=> $this->objempresa->jsonSerealize(),
			'idsegmento'			=> $this->objsegmento->jsonSerialize(),
			'idimportado'			=> $this->idimportado,
			'dados'					=> $this->dados,
			'datacadastro'			=> $this->datacadastro,
			'dataedicao'			=> $this->dataedicao
		];
	}
	
	
	
}

?>