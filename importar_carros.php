<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include 'database/conexao.php';

// Caminho do JSON
$json = file_get_contents("assets/carros_catalogo.json");

$carros = json_decode($json, true);

if (!$carros) {
    die("Erro ao ler o JSON.");
}

$importados = 0;

foreach ($carros as $carro) {

    $id = $carro["id"];
    $montadora = $carro["montadora"];
    $modelo = $carro["modelo"];
    $categoria = $carro["categoria"];
    $ano = $carro["ano"];
    $motor = $carro["motor"];
    $potencia = $carro["potencia_cv"];
    $cambio = $carro["cambio"];
    $consumo = $carro["consumo"];
    $preco = $carro["preco_a_partir_rs"];
    $precoObs = $carro["preco_obs"];
    $cores = $carro["cores"];
    $itens = $carro["itens"];
    $descricao = $carro["desc"];
    $imagem = $carro["imagem_arquivo"];

    $sql = "INSERT INTO carros
    (id,montadora,modelo,categoria,ano,motor,potencia_cv,cambio,consumo,preco,preco_obs,cores,itens,descricao,imagem)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "isssissssdsssss",
        $id,
        $montadora,
        $modelo,
        $categoria,
        $ano,
        $motor,
        $potencia,
        $cambio,
        $consumo,
        $preco,
        $precoObs,
        $cores,
        $itens,
        $descricao,
        $imagem
    );

    if ($stmt->execute()) {
        $importados++;
    }

}

echo "<h2>Importação concluída!</h2>";
echo "<p>$importados carros importados.</p>";

?>