<?php require_once("./components/header.php"); ?>

<?php
    require_once("./utils/connection.php");
    require_once("./utils/redirects.php");
    require_once("./utils/date.php");
    require_once("./utils/validations.php");

    $id = intval($_REQUEST['id']);
    $has_id = has_id($id);
    $title = "";
    $date = "";
    $description = "";
    $image_url = "";

    if($has_id){
        $statement = $connection -> prepare("SELECT title, description, image_url, date FROM $table WHERE id=$id");

        try{
            $statement -> execute();

            $post = $statement -> fetch(PDO::FETCH_OBJ);

            $title = $post -> title;
            $description = $post -> description;
            $date = format_string($post -> date);
            $image_url = $post -> image_url;

            if(!$title) redirect('./index.php', "Id inválido");
        } catch(Exception $error){
            show_error($error);
        }
    } else redirect('./index.php', "Sem id");
?>

<?php require_once("./components/footer.php"); ?>
