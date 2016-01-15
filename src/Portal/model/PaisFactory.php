<?php

namespace Portal\model;


class PaisFactory
{
    public static function create($array)
    {
        return new Pais( null, $array['descricao'],$array['nasc']);
    }
}