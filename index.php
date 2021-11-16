<?php require_once("./components/header.php"); ?>

<?php
    require_once("./utils/connection.php");
    require_once("./utils/date.php");
    require_once("./utils/validations.php");

    $list = [];
    $statement = $connection -> prepare("SELECT id, title, date, description, image_url FROM $table ORDER BY date DESC");

    try{
        $statement -> execute();

        $list = $statement -> fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $error){
        show_error($error);
    }
?>

<section class="list">
    <h2 class="list__subtitle subtitle">Listagem das publicações (10 últimas)</h2>
    
    <div class="list__container">
        <div class="list__items">
            <?php 
                if(!$list) echo "<div class='not-found'>Publicações não encontradas</div>";
                else{
                    foreach($list as $item){
                        $title = $item['title'];
                        $date = format_string($item['date']);
                        $description = $item['description'];
                        $image_url = $item['image_url'];
                        $id = $item['id'];

                        echo "<div class='list__card'>
                            <img class='list__card-image' src='$image_url' alt='$title'>
                            <div class='list__card-content'>
                                <h3 class='list__card-title'>$title ($date)</h3>
                                <p class='list__card-text'>$description</p>
                                <a href='./detail.php?id=$id' class='link link--red' target='_self'>Ler mais</a>
                            </div>
                        </div>";
                    }
                }
            ?>
        </div>
        <aside class="list__ad">
            <img src="./images/fiap.svg" class="list__ad-image" alt="Logo da FIAP">
        </aside>
    </div>
</div>

<?php require_once("./components/footer.php"); ?>
