<?php
session_start();
$serveur = $_SESSION['serveur'];
$loginBDD = $_SESSION['loginBDD'];
$password = $_SESSION['password'];
$database = $_SESSION['database'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Resultat de la recherche</title>
        <style type="text/css">
            /* body { font-family: Tahoma, sans-serif; font-size: 11px; }
             img { float: left; margin: 0.5ex 1ex 2ex 0; }
             p { clear: both; margin-bottom: 2ex; width: 40em }
             h1 { margin-top: 2ex; border-bottom: 1px solid #a0a0a0; width: 50%}
             .xml { height: 15em; width: 80em; overflow-x: hidden; overflow-y: auto; border: 1px solid #ddd; padding: 2px 5px; }*/
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" 
              integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" 
              crossorigin="anonymous">
            <style>
                .result{
                    margin-left: 10%;
                    margin-right: 10%;
                    margin-top: 12px;
                }
            </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row" style="background: #F2F2F2;">

                    <div class="col-sm-12">
                        <center><a href="../index.php"><img src="../logo/search_hat.png" height="60px"></a></center>
                    </div>
            </div>
        </div>
        <?php
        require '../model/variable.php';

        if ($_GET["moteur"] == "Recherche google") {
            require '../model/resultatGoogle.php';
        } elseif ($_GET["moteur"] == "Recherche MetaMoteur") {
            require '../model/resultatMeta.php';
        } elseif ($_GET["moteur"] == "Recherche interne") {
            require '../model/resultatIntra.php';
        }
        ?>

        <div class="col-sm-12">
            <center><a href="../index.php" ><input type="button" class="btn btn-primary" name="retour" value="retour au moteur de recherche" style="margin-top: 50px; margin-bottom: 20px"/></a></center>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" 
                integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" 
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" 
                integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" 
        crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" 
                integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" 
        crossorigin="anonymous"></script>
    </body>
</html>