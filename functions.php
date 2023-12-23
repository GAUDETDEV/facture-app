<?php

    function compteurArticles(){

        include('connect_bd.php');

        $req_select = "SELECT count(*) as 'nbr_articles' FROM articles";

        $request = $bdd -> prepare($req_select);

        $request -> execute();

        $result = $request -> fetchAll();

        foreach($result as $results){

            $nbr_article = $results['nbr_articles'];

        }

        echo $nbr_article;

    }

    function supprimerArticle(){

        



    }


?>