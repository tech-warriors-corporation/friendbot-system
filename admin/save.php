<?php require_once("../components/header.php") ?>

<?php
    require_once("../utils/connection.php");
    require_once("../utils/redirects.php");
    require_once("../utils/validations.php");

    $statement = null;
    $submitted = isset($_POST['submit']);
    $id = intval($_REQUEST['id']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $has_id = has_id($id);
    $message = null;

    if($has_id && $submitted){
        $statement = $connection -> prepare("UPDATE $table set title='$title', description='$description', image_url='$image_url', date='$date', category='$category' WHERE id=$id");

        try{
            $statement -> execute();

            $message = "Publicação atualizada";
        } catch(Exception $error){
            show_error($error);
        }
    } else if($has_id){
        $statement = $connection -> prepare("SELECT title, description, image_url, date, category FROM $table WHERE id=$id");

        try{
            $statement -> execute();

            $result = $statement -> fetch(PDO::FETCH_OBJ);

            $title = $result -> title;
            $description = $result -> description;
            $image_url = $result -> image_url;
            $date = $result -> date;
            $category = $result -> category;

            if(!$title) redirect('./index.php', "Id inválido");
        } catch(Exception $error){
            show_error($error);
        }
    } else if($submitted){
        $statement = $connection -> prepare("INSERT INTO $table(title, description, image_url, date, category) VALUES ('$title', '$description', '$image_url', '$date', '$category')");

        try{
            $statement -> execute();

            $message = "Publicação criada";
        } catch(Exception $error){
            show_error($error);
        }
    }

    if($message) redirect('./index.php', $message);
?>

<form class="form" name="save_form" action="./save.php" method="POST">
    <fieldset class="form__fieldset">
        <legend class="form__subtitle subtitle"><?php echo $has_id ? "Editar" : "Criar" ?> publicação</legend>

        <input value="<?php echo $id ?>" type="hidden" name="id" id="id">

        <div class="field">
            <label class="field__label" for="title">Título</label>
            <input autofocus class="field__input" placeholder="Coloque o título" value="<?php echo $title ?>" type="text" name="title" id="title" maxlength="250" required>
        </div>

        <div class="field">
            <label class="field__label" for="categories">Categorias</label>
            <select name="category" required id="categories" class="field__input">
                <?php 
                    foreach($categories as $key => $category_select){
                        echo ($key === 0 && !$has_id) || $category_select === $category ? "<option selected value='$category_select'>$category_select</option>" : "<option value='$category_select'>$category_select</option>";
                    }
                ?>
            </select>
        </div>

        <div class="field">
            <label class="field__label" for="date">Data</label>
            <input class="field__input" placeholder="Coloque a data" value="<?php echo $date ?>" type="date" name="date" id="date" required>
        </div>

        <div class="field">
            <label class="field__label" for="url-image">URL da imagem</label>
            <input class="field__input" placeholder="Coloque a URL" value="<?php echo $image_url ?>" type="url" name="image_url" id="url-image" maxlength="5000" required>
        </div>

        <div class="field">
            <label class="field__label" for="description">Descrição</label>
            <textarea class="field__input" name="description" id="description" rows="6" required maxlength="1000" placeholder="Coloque a descrição"><?php echo $description ?></textarea>
        </div>

        <div class="form__actions">
            <a class="button button--black" href="./index.php" target="_self">Voltar</a>
            <input class="button" value="<?php echo $has_id ? 'Salvar' : 'Criar' ?>" name="submit" type="submit">
        </div>
    </fieldset>
</form>

<?php require_once("../components/footer.php") ?>
