<?php

use App\Models\Entrada_produto;
use App\Models\Saida_produto;

function cnpj($cnpj)
{
    // retorna o cnpj formatado
    if (strlen($cnpj) == 13) {

        return '0' . substr($cnpj, 0, 1) . '.' . substr($cnpj, 1, 3) . '.' . substr($cnpj, 4, 3) . '/' . substr($cnpj, 7, 4) . '-' . substr($cnpj, 11, 2);
    } else {

        return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
    }
}

//=========================================================================================================
function telefone($tel)
{
    // retorna o telefone formatado
    return '(' . substr($tel, 0, 2) . ') ' . substr($tel, 2, 1) . ' ' . substr($tel, 3, 8);
}

//=========================================================================================================
function cep($cep)
{
    return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
}

//=========================================================================================================
function uf($uf)
{
    $pos = 0;
    $saida = '';
    while (($pos = strpos($uf, ' ', $pos)) !== false) {
        if (isset($uf[$pos + 1]) && $uf[$pos + 1] != ' ') {
            $saida .= substr($uf, $pos + 1, 1);
        }
        $pos++;
    }

    return $uf[0] . $saida;
}

//=========================================================================================================
function primeiro_nome($nome)
{
    // retorna o primeiro nome de uma string
    $primeiro = explode(' ', $nome);

    return $primeiro[0] . ' ' . $primeiro[1];
}

//=========================================================================================================
const MOTIVO_ENTRADA = [
    'compra' => 'Compra',
    'doacao' => 'Doação',
    'acerto_de_estoque' => 'Acerto de Estoque'
];

const MOTIVO_SAIDA = [
    'venda' => 'Venda',
    'doacao' => 'Doação',
    'acerto_de_estoque' => 'Acerto de Estoque'
];

//=========================================================================================================
