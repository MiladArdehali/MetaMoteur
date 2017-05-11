<?php

        require_once('Carrot2.php');

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

        $documents = $result->getDocuments();
        $clusters = $result->getClusters();


        echo "<div class='result'><table><tr>";
        echo "<font size='+1' color='#1a1aff'>Classements des données pour le recherche : " . $query . "</font>";


        if (count($clusters) > 0) {
            echo "<ul>";
            foreach ($clusters as $cluster) {
                displayCluster($cluster);
            }
            echo "</ul>";

            $cluster = $clusters[0];
            $count = 3;
            echo "<hr><h3><font color='#e68a00' style='margin-left:10px'>" . $count . " premiers resultats du classement " . $cluster->getLabel() . "</font></h3>";
            foreach ($cluster->getAllDocumentIds() as $documentId) {

                displayDocument($documents[$documentId]);
                if (--$count === 0) {
                    break;
                }
            }
        }
        echo "</div>";

        echo "<hr><h3><font color='#e68a00' style='margin-left:10px'>Tous les autres resultats</font></h3>";
        foreach ($documents as $document) {
            displayDocument($document);
        }
        echo "<br><br></tr></table></div>";

        function displayCluster(Carrot2Cluster $cluster) {
            echo '<li>' . $cluster->getLabel() . ' (' . $cluster->size() . ')';
            if (count($cluster->getSubclusters()) > 0) {
                echo '<ul>';
                foreach ($cluster->getSubclusters() as $subcluster) {
                    displayCluster($subcluster);
                }
                echo '</ul>';
            }
            echo '</li>';
        }


        function displayDocument(Carrot2Document $document) {
            echo '<p>';

            $thumbnailUrl = $document->getField('thumbnail-url');
            echo '<strong><font color=\'#0000cc\'>' . $document->getTitle() . '</font></strong><br />';
            if ($thumbnailUrl) {
                echo '<img src="' . htmlspecialchars($thumbnailUrl) . '" alt="' . $document->getTitle() . '" />';
            }
            echo '<a href="' . htmlspecialchars($document->getUrl()) . '" target=_blank>' . htmlspecialchars($document->getUrl()) . '</a><br />';
            echo $document->getContent();
            echo '</p>';
        }

        function displayRawXml($xml) {
            echo "<pre class='xml'>";
            echo htmlspecialchars($xml);
            echo "</pre>";
        }
        ?>