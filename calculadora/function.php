<?php
error_reporting(E_ERROR);

$acao = $_POST["acao"];
$filtros = $_POST["filtros"];

if ($acao == "gravarResultado") {
    print json_encode(gravarResultado($filtros));
} else if ($acao == "lerHistorico") {
    print json_encode(lerHistorico($filtros));
} else if ($acao == "apagarHistorico") {
    print json_encode(apagarHistorico($filtros));
}

function gravarResultado($filtros): array
{
    $result = false;
    $debug = [];

    $conexao = mysqli_connect("localhost", "root", "", "projetoiniciante");
    $sql = "select * from historico_calculadora order by resultado desc limit 1";
    $get = mysqli_query($conexao, $sql);
    array_push($debug, $sql);
    $novoID = 1 + intval(mysqli_fetch_all($get, MYSQLI_ASSOC)[0]["resultado"]);

    $sql = "INSERT INTO historico_calculadora (resultado, valor, conta) VALUES ($novoID, " . $filtros["resultado"] . ", '" . $filtros["conta"] . "');";
    $get = mysqli_query($conexao, $sql);
    array_push($debug, $sql);
    if ($get) {
        $result = true;
    }

    return ["resultado" => $result, "debug" => $debug];
}

function apagarHistorico($filtros): array
{
    $result = false;
    $debug = [];

    $conexao = mysqli_connect("localhost", "root", "", "projetoiniciante");
    $sql = "DELETE FROM historico_calculadora";
    $get = mysqli_query($conexao, $sql);
    array_push($debug, $sql);
    if ($get) {
        $result = true;
    }

    return ["resultado" => $result];
}

function lerHistorico($filtros): array
{
    $result = false;
    $debug = [];

    $conexao = mysqli_connect("localhost", "root", "", "projetoiniciante");
    $sql = "SELECT * FROM historico_calculadora;";
    $get = mysqli_query($conexao, $sql);
    $historico = (mysqli_fetch_all($get, MYSQLI_ASSOC));
    array_push($debug);

    if ($get) {
        $result = true;
    }

    $html = "";
    foreach ($historico as $reg) {
        foreach ($reg as $fim) {
            $html .= "$fim<br>";
        }
        $html = "$html-------------------------------------------------<br>";
    }

    return ["resultado" => $result, "debug" => $debug, "historico" => $html];
}
