<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css"/>
    <title>Connexion admin</title>
</head>
<body>
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <form class="p-5 shadow p-3 bg-body-light rounded" method="POST" action="">
            <h4 class="text-center">Authentification</h4>
            <input class="form-control mt-3" type="text" name="login" placeholder="Entrez le login">
            <input class="form-control mt-3" type="password" name="password" placeholder="Entrez le mot de passe">
            <div class="py-3">
            <?php

                if(isset($_POST['submit'])){

                    $login = $_POST["login"];
                    $password = $_POST["password"];                         
    
                    if($login && $password){

                        include('connect_bd.php');

                        $req_select = "SELECT * FROM admin WHERE login = :login AND password = :password";
        
                        $request = $bdd -> prepare($req_select);
        
                        $request -> execute([
        
                            "login" => "$login",
                            "password" => "$password"
        
                        ]);
        
                        if($request -> rowCount() == 1){

                            $_SESSION['password'] = $password;
                            header("Location: home.php");
        
                        }else{

                            echo "<p class='alert alert-success text-danger'>Echec de connexion!</p>";

                        }
                            

                    }else{

                        echo "<p class='alert alert-success text-danger'>Renseigner tous les champs svp!</p>";

                    }

                }


            ?>
            </div>
            <div class="py-5">
                <button type="submit" name="submit" class="btn btn-primary">Connexion <i class="fa-solid fa-right-to-bracket"></i></button>
                <button type="reset" name="reset" class="btn btn-success">Annuler <i class="fa-solid fa-rotate-left"></i></button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>