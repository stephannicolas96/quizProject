<?php
session_start();
include_once 'classes/path.php';
include_once path::getControllersPath() . 'duelController.php';
include_once path::getControllersPath() . 'langageController.php'
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <title>TODO: FIND A TITLE FOR THIS PAGE</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <style type="text/css" media="screen">
            #editor { 
                position: relative;
                width: 100%;
                height: 300px;
            }
        </style>
        <link rel="stylesheet" href="assets/js/import/codeMirror/lib/codemirror.css" />
        <link rel="stylesheet" href="assets/js/import/codeMirror/theme/monokai.css" />
    </head>
    <body>        
        <?php include path::getLayoutPath() . 'navbar.php'; ?>
        <div>
            <p>Énoncé
                Vous avez mis en place un site de recommandations de restaurants. A partir des opinons laissées par les visiteurs, vous avez pu construire pour chaque restaurant 3 notes sur 20 :- Qualité de la nourriture<br/>
                - Qualité de la salle<br/>
                - Qualité du service<br/>
                Pour classer les restaurants, vous calculez un score qui correspond à la moyenne de ces 3 notes.<br/>
                <br/>
                Format des données<br/>
                <br/>
                Entrée<br/>
                Ligne 1 : un entier N compris entre 5 et 500 représentant le nombre de restaurants dans votre base.<br/>
                Lignes 2 à N+1 : trois entiers compris entre 0 et 20 et séparés par des espaces représentant respectivement les notes que vous avez calculées à partir des opinions des visiteurs pour la nourriture, la salle et le service pour un restaurant donné.<br/>
                <br/>
                Sortie<br/>
                Un entier représentant le score du meilleur restaurant de votre base arrondi à l\'entier supérieur.</p>
        </div>
        <button id="php">php</button>
        <button id="cpp">cpp</button>
        <button id="c">c</button>

        <div id="editor"></div>
        <div id="error"></div>
        <button id="action">Lancer la requête AJAX</button> 

        <script src="assets/js/import/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script src="assets/js/materializeInitializer.js"></script>
        <script src="assets/js/valueChecker.js"></script>

        <script src="assets/js/import/ace/ace.js"></script>
        <script src="assets/js/duel.js"></script>
    </body>
</html>

