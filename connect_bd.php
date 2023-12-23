<?php
    try{

        $bdd = new PDO("mysql:host=localhost;dbname=facturation","root","");

    }catch(Exception $e){

        die("Erreur:".$e->getMessage());

    }
?>