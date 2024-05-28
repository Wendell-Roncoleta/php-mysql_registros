<?php


//configurações gerais
$servidor="localhost";
$usuario="root";
$senha="";
$banco= "primeiro_banco";

//conexão PDO

$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

//função para sanitizar entradas(limpar entradas)

function limparPost($dado)
{
    $dado = trim($dado);
    $dado = stripcslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}


?>