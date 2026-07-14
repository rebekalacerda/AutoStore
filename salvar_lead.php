<?php

header("Content-Type: application/json");

include "database/conexao.php";

$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$carro = $_POST["carro_interesse"] ?? "";
$mensagem = $_POST["mensagem"] ?? "";

if(
    trim($nome)=="" ||
    trim($email)=="" ||
    trim($telefone)=="" ||
    trim($carro)==""
){

    echo json_encode([
        "sucesso"=>false,
        "mensagem"=>"Preencha todos os campos obrigatórios."
    ]);

    exit;
}

$sql = "INSERT INTO leads
(nome,email,telefone,carro,mensagem)
VALUES (?,?,?,?,?)";

$stmt = $conn->prepare($sql);

if(!$stmt){
    echo json_encode([
        "sucesso"=>false,
        "mensagem"=>$conn->error
    ]);
    exit;
}

$stmt->bind_param(
    "sssss",
    $nome,
    $email,
    $telefone,
    $carro,
    $mensagem
);

if($stmt->execute()){

    echo json_encode([
        "sucesso"=>true,
        "mensagem"=>"Lead enviado com sucesso!"
    ]);

}else{

    echo json_encode([
        "sucesso"=>false,
        "mensagem"=>$stmt->error
    ]);

}

$stmt->close();
$conn->close();