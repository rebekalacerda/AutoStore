<?php

include "config.php";
include "database/conexao.php";

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-embedding-001:embedContent?key=" . GEMINI_API_KEY;

$sql = "SELECT * FROM carros";
$resultado = $conn->query($sql);

if(!$resultado){
    die("Erro ao consultar carros.");
}

while($carro = $resultado->fetch_assoc()){

    $texto = "
    Montadora: {$carro['montadora']}
    Modelo: {$carro['modelo']}
    Categoria: {$carro['categoria']}
    Ano: {$carro['ano']}
    Motor: {$carro['motor']}
    Potência: {$carro['potencia_cv']} cv
    Câmbio: {$carro['cambio']}
    Consumo: {$carro['consumo']}
    Preço: {$carro['preco']}
    Cores: {$carro['cores']}
    Descrição: {$carro['descricao']}
    Itens: {$carro['itens']}
    ";

    $dados = [

        "model" => "models/gemini-embedding-001",

        "content" => [

            "parts" => [

                [
                    "text" => $texto
                ]

            ]

        ]

    ];

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [

        "Content-Type: application/json"

    ]);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));

    $resposta = curl_exec($ch);

    curl_close($ch);

    $json = json_decode($resposta, true);

    if(isset($json["embedding"]["values"])){

        $embedding = json_encode($json["embedding"]["values"]);

        $stmt = $conn->prepare("
            UPDATE carros
            SET embedding=?
            WHERE id=?
        ");

        $stmt->bind_param(
            "si",
            $embedding,
            $carro["id"]
        );

        $stmt->execute();

        echo $carro["modelo"]." ✔<br>";

    }else{

        echo "Erro no ".$carro["modelo"]."<br>";
        echo "<pre>";
        print_r($json);
        echo "</pre>";

    }

}

$conn->close();

echo "<br>Embeddings gerados com sucesso!";