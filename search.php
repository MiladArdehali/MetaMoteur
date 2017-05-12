<?php

$query = $_GET["query"];
$num = $_GET["maxResult"];
$source = "web";
$algorithm = "lingo";
$format = $_GET["fts"];

require_once('/model/Carrot2.php');

$processor = new Carrot2Processor();
$job = new Carrot2Job();
$job->setSource($source);
$job->setQuery($query);
$job->setAlgorithm($algorithm);
$job->setAttribute("results", $num);

try {
    $result = $processor->cluster($job);
} catch (Carrot2Exception $e) {
    echo 'An error occurred during processing: ' . $e->getMessage();
    exit(10);
}

switch ($format) {
    case "xml":
        echo "fichier xml : <br>";
        displayRawXml($result->getXml());
        break;
    case "json":
        echo "fichier JSON : <br>";
        $xml = simplexml_load_string($result->getXml());

        //$json = json_encode($xml);
       //$array = json_decode($json, true);
        echo json_encode($xml, JSON_FORCE_OBJECT);
        break;
    default:

        break;
}

function displayRawXml($xml) {
    echo "<pre class='xml'>";
    echo htmlspecialchars($xml);
    echo "</pre>";
}
