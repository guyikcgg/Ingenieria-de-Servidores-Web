<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tabla periódica con web services</title>
    <style media="screen">
        html {
            height: 100%;
        }
        body {
            min-height: 100%;
            margin: 0;
            background: linear-gradient(lightblue, lightyellow);
            font-family: sans-serif;
        }
        .consultaElemento {
            border: 2px solid cornflowerblue;
            background: lightblue;
            margin: auto;
            margin-bottom: 5%;
            padding: 10px;
            text-align: center;
            width: 50%;
        }
        #submitElement {
            display: none;
        }
        .error {
            border: 2px solid chocolate;
            background: lightsalmon;
            margin: auto;
            padding: 10px;
            text-align: left;
            width: 70%;
        }
        .elementInfo {
            border: 2px solid khaki;
            background: lightyellow;
            margin: auto;
            padding: 10px;
            text-align: left;
            width: 70%;
        }
        .contenedor {
            padding: 7%;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <?php
        // Required by Google App Engine
        libxml_disable_entity_loader(false);

        // Load Periodic Table service
        $wsdl = "http://www.webservicex.net/periodictable.asmx?WSDL";
        $client = new SoapClient($wsdl);

        // Classes from this web service
        class GetAtomicNumber {
            public $ElementName;

            function __construct($ElementName) {
                $this->ElementName = $ElementName;
            }
        }

        class ElementInfo {
            function __construct($GetAtomicNumberResponse) {
                $xml = new SimpleXMLElement($GetAtomicNumberResponse->GetAtomicNumberResult);
                foreach($xml->Table[0] as $key=>$val)
                $this->$key = $val;
            }

            public $AtomicNumber;
            public $ElementName;
            public $Symbol;
            public $AtomicWeight;
            public $BoilingPoint;
            public $IonisationPotential;
            public $EletroNegativity;
            public $AtomicRadius;
            public $MeltingPoint;
            public $Density;
        }

        class ElementList {
            function __construct($GetAtomsResponse) {
                $xml = new SimpleXMLElement($GetAtomsResponse->GetAtomsResult);
                $Element = array();
                for ($i=0; $i < count($xml->Table); $i++) {
                    $this->Element[] = $xml->Table[$i]->ElementName;
                }
            }

            public $Element;
        }
        ?>

        <form class="consultaElemento" action="tabla_periodica.php" method="get">
            <label for="elementName">Seleccione un elemento:</label>
            <select class="" name="elementName" onchange="document.getElementById('submitElement').click()">
                <?php
                $response = $client->GetAtoms();
                $EList = new ElementList($response);

                foreach ($EList->Element as $key => $value) {
                echo '
                        <option value="'.$value.'">'.$value.'</option>
                    ';
                }
                ?>
            </select>
            <input id="submitElement" type="submit" value="Consultar elemento">
        </form>

        <?php
        $elementName = $_GET["elementName"];

        if (empty($elementName)) {
            // echo    '<p class="error">
            // Error: no se seleccionó ningún elemento!
            // </p>';
        } else {
            // echo    '<p>
            // Elemento solicitado: '.$elementName.'
            // </p>';

            // Get the info
            $response = $client->GetAtomicNumber(new GetAtomicNumber($elementName));

            $elementInfo = new ElementInfo($response);

            if (empty($elementInfo->AtomicNumber)) {
                echo '<p class="error">
                Error: elemento no encontrado: \''.$elementName.'\'
                </p>';
            } else {
                // Print the info

                echo '<table class="elementInfo">';
                echo '<tr><th>Propiedad</th><th>Valor</th></tr>';
                foreach($elementInfo as $key=>$val)
                    echo '<tr><td>'.$key.'</td><td>'.$val.'</tr>';
                echo '</table>';
            }
        }

        ?>
    </div>
</body>
</html>
