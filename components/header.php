<?php
    $is_at_admin = str_contains($_SERVER['REQUEST_URI'], 'admin');
    $prefix_folder = $is_at_admin ? '..' : '.';
    $categories = ['Customização física', 'Customização eletrônica', 'Game'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>Publicações do FriendBot</title>    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta name="description" content="Publicações do FriendBot para mostrar os conteúdos do projeto.">
        <meta name="keywords" content="crud, php, friendbot">
        <meta name="author" content="Tech Warriors">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="copyright" content="Tech Warriors">
        <meta name="rating" content="general">
        <link href="<?php echo $prefix_folder ?>/images/logo.jpeg" type="image/jpeg" rel="icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $prefix_folder ?>/stylesheets/styles.css">
    </head>
    <body class="body">
        <header class="header">
            <div class="header__container header__container--red">
                <span class="header__date content">
                    <?php
                        require_once("$prefix_folder/utils/date.php");

                        say_now();
                    ?>
                </span>
            </div>
            <div class="header__container header__container--black">
                <div class="header__principal content">
                    <img class="header__image" src="<?php echo $prefix_folder ?>/images/logo.jpeg" alt="Logo do Tech Warriors">
                    <h1 class="title">Publicações do FriendBot</h1>
                </div>
            </div>
            <div class="header__container header__container--dark-grey">
                <div class="header__categories content">
                    <?php 
                        foreach($categories as $category){
                            echo "<a class='header__category' target='_self' href='$prefix_folder/index.php?categoria=$category'>$category</a>";
                        }
                    ?>
                </div>
            </div>
            <div class="header__container header__container--grey">
                <div class="header__search content">
                    <form action="<?php echo $prefix_folder ?>/index.php" 
                          class="header__form"
                          name="form_search"
                          method="GET">
                        <div class="field">
                            <label class="field__label" for="search">Busca</label>
                            <input class="field__input" placeholder="Busque por título ou descrição" type="text" name="busca" id="search" maxlength="250">
                        </div>

                        <input class="button" value="Buscar" name="botao-busca" type="submit">
                    </form>

                    <a class="button button--black" target="_self" href="<?php echo $is_at_admin ? '.' : './admin' ?>/index.php">Administrador</a>
                </div>
            </div>
        </header>

        <main class="content content--main">
