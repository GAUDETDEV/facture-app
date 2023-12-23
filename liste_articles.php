<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css"/>
    <title>Connexion admin</title>
</head>

<body>
    <header>
        <?php
            include('header.php');
        ?>
    </header>
    <main>
        <!--liste articles-->
        <div class="container min-vh-100 d-flex justify-content-center align-items-center">

            <?php
            // liste the articles
                include('connect_bd.php');
                
                $req_select = "SELECT * FROM articles";
                $request = $bdd -> prepare($req_select);
                $request -> execute();

                $results = $request -> fetchAll();

                    ?>
                    <div class="container">
                    <h2 class="text-center bg-dark text-light">Facture</h2>
                    <table class="table table-light table-striped">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Designation</th>
                                <th>Prix(CFA)</th>
                                <th>Quantité</th>
                                <th>Image</th>
                                <th>Ajouté le</th>
                                <th>Modifié le</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($results as $result){

                                    ?>
                                        <tr>
                                            <td><?php echo $result['id']; ?></td>
                                            <td><?php echo $result['name_article']; ?></td>
                                            <td><?php echo $result['price_article']; ?></td>
                                            <td><?php echo $result['quantity_article']; ?></td>
                                            <td><?php echo "<img class='flex-shrink-0 me-3' src='".$result['image_article']."' style = 'width: 100px; height: 60px;' />"; ?></td>
                                            <td><?php echo $result['create_article']; ?></td>
                                            <td><?php echo $result['update_article']; ?></td>
                                            <td>
                                                <a class="btn btn-success" href="modify_article.php?id=<?php echo $result['id']; ?>" title="Modifier"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a class="btn btn-danger" href="?action=delete_article&amp;id=<?php echo $result['id']; ?>" title="Retirer"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    
                    </table>

                        <div class="bg-dark p-3">
                            <a class="btn btn-primary" href="#" title="Imprimer"><i class="fa-solid fa-print"></i></a>
                        </div>
                    
                    </div>
                        
                    <?php

            ?>
            <?php
                if(isset($_GET["action"]) && isset($_GET["id"])){

                    $id_article = $_GET['id'];

                    if($_GET["action"] == "delete_article"){

                        include('connect_bd.php');

                        $req_delete = "DELETE FROM articles WHERE id = :id";

                        $request = $bdd -> prepare($req_delete);

                        $request -> execute([
                            "id" => "$id_article"
                        ]);

                    }

                }

            ?>

        </div>

    </main>

    <script src="js/popup.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>