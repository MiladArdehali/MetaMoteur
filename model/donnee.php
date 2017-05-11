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
        <title>Moteur de recherche Perso</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" 
              integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" 
              crossorigin="anonymous">
    <body>
        <div class="container">
            <br>
            <center>
                <img src='logo/search_hat.png' height="150px" class='img-responsive' alt="rechercher">
                <h2><b>Réfèrencement d'infos</b></h2>
            </center>
            <br>
            <form action="donnee.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2" for="stitle"> Titre du l'article</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="stitle" name="s_title" placeholder="Entrer votre titre ici" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2" for="slink"> Lien vers un site </label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="slink" name="slink" placeholder="Entrer votre lien vers le site" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2" for="skey"> Mot cle pour l'article </label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="skey" name="skey" placeholder="Entrer ici le mot cle permettant de retrouver l'article" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2" for="s_des"> Description de l'article </label>

                        <div class="col-sm-10">
                            <textarea  class="form-control" id="s_des" name="s_des" placeholder="Entrer la description de l'article ici" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2" for="simg"> Image à joindre à l'article </label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="simg" >
                        </div>
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-sm-12">
                        <br>
                        <center>
                            <input type="submit" class="btn btn-outline-success" name="submit" value="Ajouter l'article">
                            <input type="reset" class="btn btn-outline-danger" name="cancel" value="Vider le formulaire">
                            <a href="index.php"><input type="button" class="btn btn-outline-primary" name="search_engine" value="Acceder au moteur de recherche"></a>
                        </center>
                    </div>    

                </div>
            </form>

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

<?php
$bdd = new PDO("mysql:host=$serveur;dbname=$database;charset=utf8", $loginBDD, $password);

if (isset($_POST["submit"])) {
    $s_title = addslashes($_POST["s_title"]);
    $s_link = addslashes($_POST["slink"]);
    $s_key = addslashes($_POST["skey"]);
    $s_des = addslashes($_POST["s_des"]);
    $_simg = addslashes($_FILES["simg"] ["name"]);

    move_uploaded_file($_FILES["simg"] ["tmp_name"], "img/" . $_FILES["simg"]["name"]);

    $sql = "insert into website(site_title, site_link, site_key, site_des, site_img) values ('$s_title','$s_link','$s_key','$s_des','$_simg')";
    $rs = $bdd->query($sql);

    if ($rs) {
        echo "<script> alert('site charger dans la base de donnée avec succes')</script>";
    } else {
        echo "<script> alert('erreur lors de l'enregistrement dans la base de donnée)</script>";
    }
}
?>