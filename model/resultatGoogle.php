<?php

$uri = "https://www.googleapis.com/customsearch/v1?q=$query&cr=$country&cx=$cx&key=$api_key&lr=$language&num=$num&start=$startIndex";
echo "<br>";

$contents = file_get_contents($uri);
$products = json_decode($contents, true);

//var_dump($content);
$size = sizeof($products['items']);
for ($i = 0; $i < $size; $i++) {
    echo $products["items"][$i]["title"];
    echo "<br>";
}

echo "<br><hr><br>";
var_dump($products);
