<?php require_once("../components/header.php"); ?>

<?php
    require_once("../utils/connection.php");
    require_once("../utils/redirects.php");

    $id = intval($_REQUEST['id'] ?? null);
    $statement = $connection -> prepare("DELETE FROM $table WHERE id=$id");

    try{
        $statement -> execute();

        redirect("./index.php", "Publicação deletada");
    } catch(Exception $error){
        show_error($error);
    }
?>

<?php require_once("../components/footer.php"); ?>
