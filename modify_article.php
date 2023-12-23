<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <?php
            include('header.php');
        ?>
    </header>
    <?php

        if(isset($_GET["id"])){

            $id_article = $_GET["id"];

            include('connect_bd.php');


            $req_select = "SELECT * FROM articles WHERE id = :id";
            $request = $bdd -> prepare($req_select);
            $request -> execute([
                "id" => "$id_article"
            ]);

            $results = $request -> fetchAll();

        }

    ?>
    <main>
        <form class="container d-flex justify-content-center min-vh-100" action="" method="POST" enctype="multipart/form-data">
            <div class="shadow p-5 mb-5 bg-body-light rounded w-100">
            <label class="py-3" for="name_article">Nom de l'article</label>
            <input class="form-control" type="text" id="name_article" name="name_article" value="<?php foreach($results as $result){ echo $result['name_article']; } ?>">

            <label class="py-3" for="price_article">Prix de l'article</label>
            <input class="form-control" type="number" id="price_article" name="price_article" value="<?php foreach($results as $result){ echo $result['price_article']; } ?>">

            <label class="py-3" for="quantity_article">Quantité</label>
            <input class="form-control" type="number" id="quantity_article" name="quantity_article" value="<?php foreach($results as $result){ echo $result['quantity_article']; } ?>">

            <label class="py-3" for="image_article">Importez une image</label>
            <input class="form-control" type="file" id="image_article" name="image_article" value="<?php foreach($results as $result){ echo $result['image_article']; } ?>">

            <div class="py-3">
                <button type="submit" name="submit" class="btn btn-primary">Mettre à jour <i class="fa-solid fa-upload"></i></button>
                <button type="reset" name="reset" class="btn btn-success">Annuler <i class="fa-solid fa-rotate-left"></i></button>
            </div>
            <?php
//article update
                if(isset($_POST['submit']) && isset($_GET["id"])){

                    $id_article = $_GET["id"];
                    $name_article = htmlspecialchars($_POST['name_article']);
                    $price_article = htmlspecialchars($_POST['price_article']);
                    $quantity_article = htmlspecialchars($_POST['quantity_article']);

                    if($name_article && $price_article && $quantity_article){
//systeme d'image
                        $image_article = $_FILES['image_article']['name'];

                        if(!empty($image_article)){

                            if($_FILES['image_article']['error'] == 0){

                                $taille_max = 1000000;

                                if($_FILES['image_article']['size'] <= $taille_max){
    
                                    $infos_image = pathinfo($_FILES['image_article']['name']);
                                    $extension_image = $infos_image['extension'];
                                    $all_extension = ['jpg','jpeg','png','gif'];
    
                                    if(in_array($extension_image, $all_extension)){

                                        $update_article = date("Y/m/d h:i:s");
    
                                        $path_image = 'images/'.basename($_FILES['image_article']['name']);   

                                        move_uploaded_file($_FILES['image_article']['tmp_name'], $path_image);
    
                                        include('connect_bd.php');
                                        
                                        $req_update = "UPDATE articles SET name_article = :name_article, price_article = :price_article, quantity_article = :quantity_article, image_article =:image_article, update_article = :update_article WHERE id = :id ";
                                        $request = $bdd -> prepare($req_update);

                                        $request -> execute([
                                            "id" => "$id_article",
                                            "name_article" => "$name_article",
                                            "price_article" => "$price_article",
                                            "quantity_article" => "$quantity_article",
                                            "image_article" => "$path_image",
                                            "update_article" => "$update_article"
                                        ]);
                
                                        echo "<p class='alert alert-success text-center'>Article modifié avec success! <a class='btn btn-success' href='liste_articles.php'>Liste des articles</a></p>";
    
                                    }else{
    
                                        echo "<p class='alert alert-danger text-center'>Désoler! Veulliez importer une image avec les extensions : .jpg, .jpeg, .png ou .gif !</p>";
    
                                    }
    
                                }else{
    
                                    echo "<p class='alert alert-danger text-center'>Désoler! la taille de votre fichier doit être inférieure ou égale à 1Mo.</p>";
    
                                }
    

                            }

                        }else if(empty($image_article)){

                            include('connect_bd.php');

                            $id_article = $_GET["id"];
                            $update_article = date("Y/m/d h:i:s");
                            
                            $req_update = "UPDATE articles SET name_article = :name_article, price_article = :price_article, quantity_article = :quantity_article, update_article = :update_article WHERE id = :id ";
                            $request = $bdd -> prepare($req_update);

                            $request -> execute([
                                "id" => "$id_article",
                                "name_article" => "$name_article",
                                "price_article" => "$price_article",
                                "quantity_article" => "$quantity_article",
                                "update_article" => "$update_article"
                            ]);
    
                            echo "<p class='alert alert-success text-center'>Article modifié avec succès! <a class='btn btn-success' href='liste_articles.php'>Liste des articles</a></p>";
                           
                        }

                    }else{

                        echo "<p class='alert alert-danger text-center'>Veulliez renseigner tous les champs!</p>";

                    }


                }

            ?>

        </form>
    </main>

    <footer>
        <?php
            include('footer.php');
        ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>