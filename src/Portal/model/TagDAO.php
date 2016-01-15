<?php

namespace Portal\model;

class TagDAO
{
    private $con;
    private $query;
    private $objTag;
    private $lista;

    /**
     * TagDAO constructor.
     * @param $con
     */
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function cadastrar(Tag $tag)
    {
        $this->query = sprintf("INSERT INTO tag (nome) VALUES ('%s')",
            mysqli_real_escape_string($this->con, $tag->getNome()));

        if (!mysqli_query($this->con, $this->query)) {
            die('[ERRO] Cadastro: ' . mysqli_error($this->con));
        }

        /*-- Pegando ultimo obj cadastrado --*/
        return mysqli_insert_id($this->con);
    }

    public function alterar(Tag $tag)
    {
        $this->query = sprintf("UPDATE tag SET nome='%s', dataedicao='%s' WHERE id = %d",
            mysqli_real_escape_string($this->con, $tag->getNome()),
            mysqli_real_escape_string($this->con, date('Y-m-d H:i:s')),
            mysqli_real_escape_string($this->con, $tag->getId()));

        if (!mysqli_query($this->con, $this->query)) {
            die('[ERRO] Alteração: ' . mysqli_error($this->con));
        }

        return $this->objTag = $tag;
    }

    public function deletar(Tag $tag)
    {
        $this->query = sprintf("DELETE FROM tag WHERE id = '%s'",
            mysqli_real_escape_string($this->con, $tag->getId()));

        if (!mysqli_query($this->con, $this->query)) {
            die('[ERRO] Exclusão: ' . mysqli_error($this->con));
        }
        return $this->objTag = $tag;
    }

    public function buscarTodos()
    {
        $this->query = sprintf("SELECT * FROM tag");

        $result = mysqli_query($this->con, $this->query);
        if (!$result) {
            die('[ERRO] Listartodos: ' . mysqli_error($this->con));
        }
        while($row = mysqli_fetch_assoc($result))
        {
            $this->lista[] = $row;
        }
        return $this->lista;
    }

    public function buscarPorId(Tag $tag)
    {
        $this->query = sprintf("SELECT * FROM tag WHERE id = %d",
            mysqli_fetch_assoc($this->con, $tag->getId()));
        $result = mysqli_query($this->con, $this->query);
        if (!$result)
        {
            die('[ERRO] pesquisarporId: ' . mysqli_error($this->con));
        }
        while($row = mssql_fetch_assoc($result))
        {
            $this->objTag = $row;
        }
        return $this->objTag;
    }


}