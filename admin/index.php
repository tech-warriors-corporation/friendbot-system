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
        showError($error);
    }
?>

<div class="table">
    <?php
        if(!$results) echo "<div class='not-found'>Nenhuma publicação encontrada, crie uma acima</div>";
        else {

        }
    ?>
</div>

<?php require_once("../components/footer.php"); ?>
