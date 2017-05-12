<div class="result">
    <table>
        <tr>

            <?php
            $bdd = new PDO("mysql:host=$serveur;dbname=$database;charset=utf8", $loginBDD, $password);

            if (isset($_GET['search_button'])) {
                $search = $_GET['query'];

                if ($search == "") {
                    echo "<center><b>Veuillez saisir une recherche</b></center>";
                    exit();
                }
                $sql_image = "select * from website where site_key like '%$search%' limit 6";
                $rs = $bdd->query($sql_image);
                $row = $rs->fetchAll();
                if (!$row) {
                    echo "<center><h4><b> Ooops!!! Il n'y a aucun élèment correspondant à votre recherche</b></h4></center>";
                    exit();
                }

                echo "<font size='+1' color='#1a1aff'>Image pour la recherche : " . $search . "</font>";


                echo "<br>";

                foreach ($row as $key) {
                    if ($key[5]) {
                        echo "<td>
                                    <table style='margin-top:10px'>
                                        <tr>
                                            <td>
                                                <a target='_blank' href='images.php?id=$search'>
                                                <img src='../img/$key[5]' height='90px' >
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>";
                    }
                }
            }
            ?>


        </tr>

    </table>

    <?php
    echo "<a target='_blank' href='images.php?id=$search'><font size='+1' color='#1a1aff'> Plus d'image pour: " . $search . "</font></a>";

    $sql_text = "select * from website where site_key like'%$search%'";

    $rs_text = $bdd->query($sql_text);

    $row_text = $rs_text->fetchAll();
    
    

    echo "<hr><h3><font color='#e68a00' style='margin-left:10px'>Tous les autres resultats</font></h3>";
    
    foreach ($row_text as $value) {

        if ($value[1]) {
            echo "<a href='resultatInterne.php?id=$value[0]' target='_blank'><font size='4' color='#0000cc'><b>$value[1]</b></font></a><br>";
        }

        if ($value[2]) {
            echo "<font size='3' color='#006400'><a href='http://$value[2]' target='_blank'>$value[2]</a></font><br>";
        }

        if (strlen($value[4]) > 20) {
            $value[4] = substr($value[4], 0, 20) . "<a href='resultatInterne.php?id=$value[0]' target='_blank'> ...lire la suite </a>";
        }
        echo "<font size='3' color='#666666'>$value[4]</font><br><br>";
    }
    
    echo "<br><br></tr></table></div>";
    
    ?>
</div>