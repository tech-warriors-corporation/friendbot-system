<?php require_once("./components/header.php"); ?>

<?php
    require_once("./utils/connection.php");
    require_once("./utils/date.php");
    require_once("./utils/validations.php");
    require_once("./utils/redirects.php");

    $list = [];
    $statement = $connection -> prepare("SELECT id, title, date, description, image_url FROM $table WHERE category='$current_category' AND (title LIKE '%$current_search%' OR description LIKE '%$current_search%') ORDER BY date DESC LIMIT 10");

    try{
        $statement -> execute();

        $list = $statement -> fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $error){
        show_error($error);
    }
?>

<section class="list">
    <?php echo !$current_search ? "" : "<p class='list__search'>Sua busca: $current_search</p>" ?>

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
                        $params_index = create_params_index($current_category, $current_search);

                        echo "<div class='list__card'>
                            <div class='square-image' aria-label='$title' tabindex='0' style='background-image: url($image_url)'></div>
                            <div class='list__card-content'>
                                <h3 class='list__card-title'>$title ($date)</h3>
                                <p class='list__card-text'>$description</p>
                                <a href='./detail.php?id=$id&$params_index' class='link link--red' target='_self'>Ler mais</a>
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
