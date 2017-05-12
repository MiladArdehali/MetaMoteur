<?php

$uri = "https://www.googleapis.com/customsearch/v1?q=$query&cr=$country&cx=$cx&key=$api_key&lr=$language&num=$num&start=$startIndex";

$query = file_get_contents($uri);
$products = json_decode($contents, true);

$size = sizeof($products['items']);

echo "<div class='result'><table><tr>";
echo "<br><h3><font color='#e68a00' style='margin-left:10px'>Tous les autres resultats pour la recherche : ". $query ."</font></h3><br>";

for ($i = 0; $i < $size; $i++) {
    echo "<p>";
    echo "<h5><b><font color=\'#0000cc\'>".$products["items"][$i]["title"]."</font></b></h5>";
    echo "<a href='".$products["items"][$i]["link"]."' target=_blank>".$products["items"][$i]["link"]."</a><br>";
    echo $products["items"][$i]["snippet"];
    echo "</p>";
    
}
echo "</tr></table></div>";
echo "<br>";

?>
