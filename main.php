
<form class="container d-flex justify-content-center min-vh-100 mt-5 " action="" method="POST" enctype="multipart/form-data">
    <div class="shadow p-5 mb-5 bg-body-light rounded w-100 bg-info">

        <label class="py-3" for="name_article">Nom de l'article</label>
        <input class="form-control" type="text" id="name_article" name="name_article">

        <label class="py-3" for="price_article">Prix de l'article</label>
        <input class="form-control" type="number" id="price_article" name="price_article" placeholder="En Franc CFA">

        <label class="py-3" for="quantity_article">Quantité</label>
        <input class="form-control" type="number" id="quantity_article" name="quantity_article">

        <label class="py-3" for="image_article">Importez une image</label>
        <input class="form-control" type="file" id="image_article" name="image_article">

        <div class="py-3">
            <button type="submit" name="submit" class="btn btn-primary">Enregistrer <i class="fa-solid fa-upload"></i></button>
            <button type="reset" name="reset" class="btn btn-success">Annuler <i class="fa-solid fa-rotate-left"></i></button>
        </div>
        <div class="py-3">
        <?php
//article registration
                if(isset($_POST['submit'])){

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

                                        $create_article = date("Y/m/d h:i:s");
                                        $update_article = date("Y/m/d h:i:s");
    
                                        $path_image = 'images/'.basename($_FILES['image_article']['name']);   
                                        $_SESSION['path_image'] = $path_image;
                                        move_uploaded_file($_FILES['image_article']['tmp_name'], $path_image);
    
                                        include('connect_bd.php');
                                        
                                        $req_insert = "INSERT INTO articles(name_article, price_article, quantity_article, image_article, create_article, update_article) VALUE (:name_article, :price_article, :quantity_article, :image_article, :create_article, :update_article) ";
                                        $request = $bdd -> prepare($req_insert);
                                        $request -> execute([
                                            "name_article" => "$name_article",
                                            "price_article" => "$price_article",
                                            "quantity_article" => "$quantity_article",
                                            "image_article" => "$path_image",
                                            "create_article" => "$create_article",
                                            "update_article" => "$update_article"
                                        ]);
                
                                        echo "<p class='alert alert-success text-center'>Article enregistrer avec success! <a class='btn btn-success' href='liste_articles.php'>Liste des articles</a></p>";
    
                                    }else{
    
                                        echo "<p class='alert alert-danger text-center'>Désoler! Veulliez importer une image avec les extensions : .jpg, .jpeg, .png ou .gif !</p>";
    
                                    }
    
                                }else{
    
                                    echo "<p class='alert alert-danger text-center'>Désoler! la taille de votre fichier doit être inférieure ou égale à 1Mo.</p>";
    
                                }
    

                            }

                        }else if(empty($image_article)){

                            include('connect_bd.php');

                            $create_article = date("Y/m/d h:i:s");
                            $update_article = date("Y/m/d h:i:s");
                            $image_default = "https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg";
                            
                            $req_insert = "INSERT INTO articles(name_article, price_article, quantity_article, image_article, create_article, update_article) VALUE (:name_article, :price_article, :quantity_article, :image_article, :create_article, :update_article) ";
                            $request = $bdd -> prepare($req_insert);

                            $request -> execute([
                                "name_article" => "$name_article",
                                "price_article" => "$price_article",
                                "quantity_article" => "$quantity_article",
                                "image_article" => "$image_default",
                                "create_article" => "$create_article",
                                "update_article" => "$update_article"
                            ]);
    
                            echo "<p class='alert alert-success text-center'>Article ajouté à la facture! <a class='btn btn-success' href='liste_articles.php'>Voir la facture</a></p>";
                           
                        }

                    }else{

                        echo "<p class='alert alert-danger text-center'>Veulliez renseigner tous les champs!</p>";

                    }


                }

            ?>
        </div>
    </div>
</form>