<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <form action="ejemplo.php" method="get">
        <label for="rango">Rango</label>
        <input type="range" min="3" max="10" step="1" name="rango" value="5">
        <input type="submit" value="Magic Square!">
    </form>

    <table style="text-align: center; border: solid 1px">
        <?php
        // Required by Google App Engine
        libxml_disable_entity_loader(false);
	ini_set('soap.wsdl_cache_enabled',0);
	ini_set('soap.wsdl_cache_ttl',0);

        // Load Magic Square service
        $wsdl = "http://www.cs.fsu.edu/~engelen/magic.wsdl";

        $client = new SoapClient($wsdl);

        $rango = $_GET["rango"];

        echo "<p>Rango = ".$rango."</p>";
        $elementos = $client->magic($rango);

        for ($i=0; $i < $rango; $i++) {
            echo "<tr>";
            for ($j=0; $j < $rango; $j++) {
                echo '<td style="padding: 5px">';
                print($elementos[$i][$j]);
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
