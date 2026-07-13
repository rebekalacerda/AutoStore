<?php

include 'database/conexao.php';
include 'includes/header.php';


$busca = isset($_GET['busca']) ? trim($_GET['busca']) : "";
$categoria = isset($_GET['categoria']) ? trim($_GET['categoria']) : "";

$sql = "SELECT * FROM carros WHERE 1=1";

if($busca != ""){

    $busca = $conn->real_escape_string($busca);

    $sql .= " AND (
        montadora LIKE '%$busca%'
        OR modelo LIKE '%$busca%'
        OR categoria LIKE '%$busca%'
    )";

}

if($categoria != ""){

    $categoria = $conn->real_escape_string($categoria);

    $sql .= " AND categoria = '$categoria'";

}

$sql .= " ORDER BY montadora, modelo";

$resultado = $conn->query($sql);

?>

<section class="catalogo">

    <div class="container">

        <h1>Catálogo de Veículos</h1>

        <div class="filtros">

    <a href="catalogo.php" class="filtro">Todos</a>

    <a href="catalogo.php?categoria=SUV" class="filtro">SUV</a>

    <a href="catalogo.php?categoria=Sedan" class="filtro">Sedan</a>

    <a href="catalogo.php?categoria=Hatch" class="filtro">Hatch</a>

    <a href="catalogo.php?categoria=Picape" class="filtro">Picape</a>

</div>

    <form method="GET" class="form-pesquisa">

     <?php if($categoria != ""){ ?>
        <input
            type="hidden"
            name="categoria"
            value="<?php echo htmlspecialchars($categoria); ?>">
    <?php } ?>

    <input
        type="text"
        name="busca"
        placeholder="Pesquisar por montadora, modelo ou categoria..."
        value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">

    <button type="submit">Pesquisar</button>
   
    </form>

        <div class="cards">

            <?php while($carro = $resultado->fetch_assoc()) { ?>

                <div class="card">

                    <img src="assets/<?php echo $carro['imagem']; ?>" alt="<?php echo $carro['modelo']; ?>">

                    <div class="card-body">

                        <h3>

                            <?php echo $carro['montadora']; ?>

                            <?php echo $carro['modelo']; ?>

                        </h3>

                        <p>

                            <?php echo $carro['categoria']; ?>

                        </p>

                        <p>

                            <?php echo $carro['ano']; ?>

                        </p>

                        <div class="preco">

                            R$
                            <?php echo number_format($carro['preco'],2,",","."); ?>

                        </div>

                        <a
                            href="carro.php?id=<?php echo $carro['id']; ?>"
                            class="btn-card">

                            Ver detalhes

                        </a>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>

<?php include 'includes/footer.php'; ?>