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
            <a class="button" target="_self" href="./save.php">Criar</a>
        </div>
    </div>

    <?php
        if(!$results) echo "<div class='not-found'>Nenhuma publicação encontrada, crie uma acima</div>";
        else {
            $rows = "";

            foreach($results as $result){
                $id = $result['id'];
                $title = $result['title'];
                $date = format_string($result['date']);
                $category = $result['category'];

                $rows = "$rows
                <tr> 
                    <td class='table__column'>$title</td>
                    <td class='table__column'>$category</td>
                    <td class='table__column'>$date</td>
                    <td class='table__column'><a class='button button--black' href='./save.php?id=$id' target='_self'>Editar</a></td>
                    <td class='table__column'><a class='button' href='./delete.php?id=$id' target='_self'>Deletar</a></td>
                </tr>";
            }

            echo "<table class='table__list'> 
                <thead>
                    <tr>
                        <th class='table__column table__column--head'>Título</th>
                        <th class='table__column table__column--head'>Categoria</th>
                        <th class='table__column table__column--head'>Data</th>
                        <th class='table__column table__column--head'>Editar</th>
                        <th class='table__column table__column--head'>Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    $rows
                </tbody>
            </table>";
        }
    ?>
</div>

<?php require_once("../components/footer.php"); ?>
