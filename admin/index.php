<?php require_once("../components/header.php"); ?>

<?php
    require_once("../utils/connection.php");
    require_once("../utils/date.php");
    require_once("../utils/validations.php");

    $results = [];
    $statement = $connection -> prepare("SELECT id, title, date, category FROM $table");

    try{
        $statement -> execute();

        $results = $statement -> fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $error){
        show_error($error);
    }
?>

<div class="table">
    <div class="table__head">
        <h2 class="subtitle">Administração das publicações</h2>
        <div class="table__actions">
            <a class="button button--black" target="_self" href="../index.php">Voltar</a>
            <a class="button button--black" target="_self" href="./save.php">Criar</a>
        </div>
    </div>

    <?php
        if(!$results) echo "<div class='not-found'>Nenhuma publicação encontrada, crie uma acima</div>";
        else {

        }
    ?>
</div>

<?php require_once("../components/footer.php"); ?>
