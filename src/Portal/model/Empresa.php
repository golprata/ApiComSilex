<?php

namespace Portal\model;

class Empresa {
	private $id;
	private $nomeFantasia;
	private $razaoSocial;
	private $nomeReduzido;
	private $CNPJ;
	private $inscricaoEstadual;
	private $inscricaoMunicipal;
	private $endereco;
	private $numero;
	private $complemento;
	private $bairro;
	private $cep;
    private $cidade;
    private $tel_fixo;
    private $tel_celular;
    private $email;
    private $site;
	private $imagemLogotipo;
	private $datacadastro;
	private $dataedicao;
	private $objLocalidade;
	
	function __construct(
        $id=null, $nomeFantasia=null,
        $razaoSocial=null,
        $nomeReduzido=null,
        $CNPJ=null,
        $inscricaoEstadual=null,
        $inscricaoMunicipal=null,
        $endereco=null,
        $numero=null,
        $complemento=null,
        $bairro=null,
        $cep=null,
        $cidade=null,
        $tel_fixo=null,
        $tel_celular=null,
        $email=null,
        $site=null,
        $imagemLogotipo=null,
        $datacadastro=null,
        $dataedicao=null,
        Localidade $objLocalidade=null,
        Imposto $objImposto=null) {
            $this->id = $id;
            $this->nomeFantasia = $nomeFantasia;
            $this->razaoSocial = $razaoSocial;
            $this->nomeReduzido = $nomeReduzido;
            $this->CNPJ = $CNPJ;
            $this->inscricaoEstadual = $inscricaoEstadual;
            $this->inscricaoMunicipal = $inscricaoMunicipal;
            $this->endereco = $endereco;
            $this->numero = $numero;
            $this->complemento = $complemento;
            $this->bairro = $bairro;
            $this->cep = $cep;
            $this->cidade = $cidade;
            $this->tel_fixo = $tel_fixo;
            $this->tel_celular = $tel_celular;
            $this->email = $email;
            $this->site = $site;
            $this->imagemLogotipo = $imagemLogotipo;
            $this->datacadastro = $datacadastro;
            $this->dataedicao = $dataedicao;
            $this->objLocalidade = $objLocalidade;
     }

    /**
     * @return null
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param null $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @return null
     */
    public function getTelCelular()
    {
        return $this->tel_celular;
    }

    /**
     * @param null $tel_celular
     */
    public function setTelCelular($tel_celular)
    {
        $this->tel_celular = $tel_celular;
    }

    /**
     * @return null
     */
    public function getTelFixo()
    {
        return $this->tel_fixo;
    }

    /**
     * @param null $tel_fixo
     */
    public function setTelFixo($tel_fixo)
    {
        $this->tel_fixo = $tel_fixo;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return null
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param null $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

        function getId() {
            return $this->id;
        }

        function getNomeFantasia() {
            return $this->nomeFantasia;
        }

        function getRazaoSocial() {
            return $this->razaoSocial;
        }

        function getNomeReduzido() {
            return $this->nomeReduzido;
        }

        function getCNPJ() {
            return $this->CNPJ;
        }

        function getInscricaoEstadual() {
            return $this->inscricaoEstadual;
        }

        function getInscricaoMunicipal() {
            return $this->inscricaoMunicipal;
        }

        function getEndereco() {
            return $this->endereco;
        }

        function getNumero() {
            return $this->numero;
        }

        function getComplemento() {
            return $this->complemento;
        }

        function getBairro() {
            return $this->bairro;
        }

        function getCep() {
            return $this->cep;
        }

        function getImagemLogotipo() {
            return $this->imagemLogotipo;
        }

        function getDatacadastro() {
            return $this->datacadastro;
        }

        function getDataedicao() {
            return $this->dataedicao;
        }

        function getObjLocalidade() {
            return $this->objLocalidade;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNomeFantasia($nomeFantasia) {
            $this->nomeFantasia = $nomeFantasia;
        }

        function setRazaoSocial($razaoSocial) {
            $this->razaoSocial = $razaoSocial;
        }

        function setNomeReduzido($nomeReduzido) {
            $this->nomeReduzido = $nomeReduzido;
        }

        function setCNPJ($CNPJ) {
            $this->CNPJ = $CNPJ;
        }

        function setInscricaoEstadual($inscricaoEstadual) {
            $this->inscricaoEstadual = $inscricaoEstadual;
        }

        function setInscricaoMunicipal($inscricaoMunicipal) {
            $this->inscricaoMunicipal = $inscricaoMunicipal;
        }

        function setEndereco($endereco) {
            $this->endereco = $endereco;
        }

        function setNumero($numero) {
            $this->numero = $numero;
        }

        function setComplemento($complemento) {
            $this->complemento = $complemento;
        }

        function setBairro($bairro) {
            $this->bairro = $bairro;
        }

        function setCep($cep) {
            $this->cep = $cep;
        }

        function setImagemLogotipo($imagemLogotipo) {
            $this->imagemLogotipo = $imagemLogotipo;
        }

        function setDatacadastro($datacadastro) {
            $this->datacadastro = $datacadastro;
        }

        function setDataedicao($dataedicao) {
            $this->dataedicao = $dataedicao;
        }

        function setObjLocalidade($objLocalidade) {
            $this->objLocalidade = $objLocalidade;
        }

    public function __toString(){
    	return sprintf("Empresa: ID: %d, NomeFantasia: %s", $this->id, $this->nomeFantasia);
    }
                	
	public function jsonSerialize() {
		return [ 
				'id' => $this->id,
				'nomeFantasia' => $this->nomeFantasia,
				'razaoSocial' => $this->razaoSocial,
				'nomeReduzido' => $this->nomeReduzido,
				'CNPJ' => $this->CNPJ,
				'inscricaoEstadual' => $this->inscricaoEstadual,
				'inscricaoMunicipal' => $this->inscricaoMunicipal,
				'endereco' => $this->endereco,
				'numero' => $this->numero,
				'complemento' => $this->complemento,
				'bairro' => $this->bairro,
				'cep' => $this->cep,
                'cidade' => $this->cidade,
                'tel_fixo' => $this->tel_fixo,
                'tel_celular' => $this->tel_celular,
                'email' => $this->email,
                'site' => $this->site,
				'imagemLogotipo' => $this->imagemLogotipo,
				'datacadastro' => $this->datacadastro,  
				'dataedicao' => $this->dataedicao,
				'idlocalidade' => $this->objLocalidade
		];
	}
}