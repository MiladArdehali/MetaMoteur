<?php
session_start();
$serveur = $_SESSION['serveur'];
$loginBDD = $_SESSION['loginBDD'];
$password = $_SESSION['password'];
$database = $_SESSION['database'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resultat de votre recherche</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" 
              integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" 
              crossorigin="anonymous">

    </head>
    <body>
        <script>
            function CloseWindows() {
                var obj_window = window.open('', '_self');
                obj_window.opener = window;
                obj_window.focus();
                opener = self;
                self.close();
            }
        </script>

        <div class="container-fluid">
            <?php
            //header('Content-Type:image/png');
            $search = $_GET["id"];

            $bdd = new PDO("mysql:host=$serveur;dbname=$database", $loginBDD, $password);

            $sql = "select site_img, site_link from website where site_key like '%$search%'";
            $resultat = $bdd->query($sql);
            $list = $resultat->fetchAll();

            echo "<center><a href='index.php'><img src='logo/search_hat.png' height='150px' class='img-responsive'></a></center>";
            echo "<div class='col-sm-12'>
            <center><h3 style='color:#ff751a; margin-top:10px'><b>Liste des images en lien avec votre recherche</b></h3></center>";
            foreach ($list as $value) {
                if ($value[0]) {
                    echo "<a href='img/$value[0]' download><img src='img/$value[0]' height='100px'  class='img-responsive' style='margin-top:10px; margin-left:5px; margin-left:5px'></a>";
                }
            }
            ?>
            <div class="col-sm-12">
                <center><input type="button" class="btn btn-outline-primary" name="fermer_page" value="Fermer cette page" onclick="CloseWindows();"/></center>
            </div>

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