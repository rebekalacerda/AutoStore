<?php

include "database/conexao.php";
include "includes/header.php";

$id = intval($_GET['id']);

$sql = "SELECT * FROM carros WHERE id = $id";
$resultado = $conn->query($sql);

$carro = $resultado->fetch_assoc();

if(!$carro){
    die("Carro não encontrado.");
}

?>

<section class="catalogo">

<div class="container">

<div class="detalhes-carro">

<?php

$baseImagem = preg_replace('/_01\.jpg$/', '', $carro['imagem']);

?>

<?php

$imagemPrincipal = $carro['imagem']; // imagens/byd_dolphin.jpg

$arquivo = basename($imagemPrincipal);          // byd_dolphin.jpg
$base = pathinfo($arquivo, PATHINFO_FILENAME);  // byd_dolphin

$galeria = [
    $arquivo,
    $base . "_02.jpg",
    $base . "_03.jpg",
    $base . "_04.jpg"
];

?>

<div class="imagem">

    <img
        id="imagemPrincipal"
        src="assets/imagens/<?php echo $arquivo; ?>"
        alt="<?php echo $carro['modelo']; ?>">

    <div class="miniaturas">

        <?php foreach($galeria as $img){ ?>

            <?php if(file_exists("assets/imagens/".$img)){ ?>

                <img
                    class="thumb"
                    src="assets/imagens/<?php echo $img; ?>"
                    onclick="trocarImagem(this)"
                    alt="">

            <?php } ?>

        <?php } ?>

    </div>

</div>

<div class="info">

<h1><?php echo $carro['montadora']." ".$carro['modelo']; ?></h1>

<h2>R$ <?php echo number_format($carro['preco'],2,",","."); ?></h2>

<p><strong>Categoria:</strong> <?php echo $carro['categoria']; ?></p>

<p><strong>Ano:</strong> <?php echo $carro['ano']; ?></p>

<p><strong>Motor:</strong> <?php echo $carro['motor']; ?></p>

<p><strong>Potência:</strong> <?php echo $carro['potencia_cv']; ?></p>

<p><strong>Câmbio:</strong> <?php echo $carro['cambio']; ?></p>

<p><strong>Consumo:</strong> <?php echo $carro['consumo']; ?></p>

<button class="btn" onclick="abrirFormulario()">
    Tenho Interesse
</button>

</div>

</div>

<div class="descricao">

<h2>Descrição</h2>

<p><?php echo $carro['descricao']; ?></p>

<h2>Itens de série</h2>

<p><?php echo $carro['itens']; ?></p>

<h2>Cores disponíveis</h2>

<p><?php echo $carro['cores']; ?></p>

</div>

</div>

</section>

<div id="modalLead" class="modal">

    <div class="modal-content">

        <span class="fechar" onclick="fecharFormulario()">&times;</span>

        <h2>Solicitar Contato</h2>

        <form id="formLead">

            <input
                type="text"
                name="nome"
                placeholder="Nome"
                required>

            <input
                type="email"
                name="email"
                placeholder="E-mail"
                required>

            <input
                type="text"
                name="telefone"
                placeholder="Telefone"
                required>

            <input
                type="hidden"
                name="carro_interesse"
                value="<?php echo $carro['montadora'].' '.$carro['modelo']; ?>">

            <textarea
                name="mensagem"
                placeholder="Mensagem (opcional)"></textarea>

            <button type="submit" class="btn">
                Enviar Interesse
            </button>

        </form>

    </div>

</div>

<?php include "includes/footer.php"; ?>