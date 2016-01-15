<?php

namespace Portal\model;

class PremioDAO
{
    private $con;
    private $query;
    private $objPremio;
    private $lista;

    /**
     * PremioDAO constructor.
     * @param $con
     */
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function cadastrar(Premio $objPremio)
    {
        $this->query = sprintf("INSERT INTO premio (nome, descricao, imagem1, imagem2, imagem3, pontos, quantidade, validade) VALUES ('%s', '%s', '%s', '%s', '%s', %d, %d, '%s')",
            mysqli_real_escape_string($this->con, $objPremio->getNome()),
            mysqli_real_escape_string($this->con, $objPremio->getDescricao()),
            mysqli_real_escape_string($this->con, $objPremio->getImagem1()),
            mysqli_real_escape_string($this->con, $objPremio->getImagem2()),
            mysqli_real_escape_string($this->con, $objPremio->getImagem3()),
            mysqli_real_escape_string($this->con, $objPremio->getPontos()),
            mysqli_real_escape_string($this->con, $objPremio->getQuantidade()),
            mysqli_real_escape_string($this->con, $objPremio->getValidade()));

        if (!mysqli_query($this->con, $this->query)) {
            die('[ERRO] Cadastro: ' . mysqli_error($this->con));
        }

        /*-- Pegando ultimo obj cadastrado --*/
        return mysqli_insert_id($this->con);
    }

    public function atualizar(Premio $objPremio)
    {
        $this->query = sprintf("UPDATE premio SET nome='%S', descricao='%s', imagem1='%s', imagem2='%s', imagem3='%s', pontos=%d, quantidade=%d, validade='%s', dataedicao='%s' WHERE id = %d",
            mysqli_real_escape_string($this->con, $objPremio->getNome()),
            mysqli_real_escape_string($this->con, $objPremio->getDescricao()),
            mysqli_real_escape_string($this->con, $objPremio->getImagem1()),
            mysqli_real_escape_string($this->con, $objPremio->getImagem2()),
            mysqli_real_escape_string($this->con, $objPremio->getImagem3()),
            mysqli_real_escape_string($this->con, $objPremio->getPontos()),
            mysqli_real_escape_string($this->con, $objPremio->getQuantidade()),
            mysqli_real_escape_string($this->con, $objPremio->getValidade()),
            mysqli_real_escape_string($this->con, $objPremio->getDataedicao()),
            mysqli_real_escape_string($this->con, $objPremio->getId()));

        if (!mysqli_query($this->con, $this->query)) {
            die('[ERRO] Alteração: ' . mysqli_error($this->con));
        }
        return $this->objPremio = $objPremio;
    }

    function deletar(Premio $objPremio){
        $this->query = sprintf("DELETE FROM premio WHERE id = %d",
            mysqli_real_escape_string( $this->con, $objPremio->getId() ) );
        if(!mysqli_query($this->con, $this->query)){
            die('[ERRO] Exclusao: '.mysqli_error($this->con));
        }
        return $this->objPremio = $objPremio;
    }

    function buscarTodos(){
        $this->query = sprintf("SELECT * FROM premio");

        $result = mysqli_query($this->con, $this->query);
        if(!$result){
            die('[ERRO] no Pesquisar: '.mysqli_error($this->con));
        }
        while($row = mysqli_fetch_object($result)){

            $this->lista[] = $row;
        }

        return $this->lista;
    }

    function buscarPorId(Premio $objPremio){
        $this->query = sprintf("SELECT * FROM comunidade WHERE id = %d",
            mysqli_real_escape_string( $this->con, $objPremio->getId() ) );

        $result = mysqli_query($this->con, $this->query);
        if(!$result){
            die('[ERRO]: '.mysqli_error($this->con));
        }
        while($row = mysqli_fetch_object($result)){

            $this->objPremio = $row;
        }

        return $this->objPremio;
    }


}