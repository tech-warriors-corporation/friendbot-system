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

<div class="detail">
    <div class="square-image square-image--large" aria-label="<?php echo $title ?>" tabindex="0" style="background-image: url(<?php echo $image_url ?>)"></div>
    <div class="detail__content">
        <h3 class="subtitle"><?php echo $title ?> (<?php echo $date ?>)</h3>
        <p class="detail__description"><?php echo $description ?></p>
        <a href="./index.php?categoria=<?php echo $current_category ?>" class="link link--red" target="_self">Voltar</a>
    </div>
</div>

<?php require_once("./components/footer.php"); ?>
