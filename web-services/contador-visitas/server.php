<?php #My Visit Counter web-service
# (c) Cristian G Guerrero 2018

/**
 * DATABASE
 */

use Symfony\Component\HttpFoundation\Request;

// Connect to CloudSQL from App Engine
$connected  = false;
$exception  = "";
$dsn        = getenv('MYSQL_DSN');
$user       = getenv('MYSQL_USER');
$password   = getenv('MYSQL_PASSWORD');

if (!isset($dsn, $user) || false === $password) {
    $exception = 'MYSQL_DSN, MYSQL_USER or MYSQL_PASSWORD environment variables not set';
} else {
    try {
        $db = new PDO($dsn, $user, $password);
        $connected = true;
    } catch (Exception $e) {
        $connected = false;
        $exception = $e;
    }
}


/**
 * FUNCTIONS
 */

// Web-service functions
function CrearContador($userID) {
    global $db, $connected, $exception;
    if (!connected) throw new SoapFault("Server", "Unable to connect to database. $exception");
    if (empty($userID)) throw new SoapFault("Client", '$userID required');

    try {
        $db->query('INSERT INTO counters (userID, value) values("'.$userID.'", 0);');
    } catch (Exception $e) {
        throw new SoapFault("Server", $e->getMessage());
    }
    return 0;
}

function LeerContador($counterID) {
    global $db, $connected, $exception;
    if (!connected) throw new SoapFault("Server", "Unable to connect to database. $exception");
    if (empty($counterID)) throw new SoapFault("Client", '$counterID required');

    try {
        $results = $db->query('SELECT value FROM counters WHERE counterID='.$counterID.';');
        if ($results->rowCount() == 0) throw new SoapFault("Client", "Counter not found!");
        if ($results->rowCount() > 1) throw new SoapFault("Server", "Database is not consistent...");

        foreach($results as $row) {
            $retval = $row[0];
        }
    } catch (Exception $e) {
        throw new SoapFault("Server", $e->getMessage());
    }
    return $retval;
}

function AsignarContador($counterID, $value) {
    global $db, $connected, $exception;
    if (!connected) throw new SoapFault("Server", "Unable to connect to database. $exception");
    if (empty($counterID)) throw new SoapFault("Client", '$counterID required');

    try {
        $db->query('UPDATE counters SET value = '.$value.', lastUpdate = '.date("Y-m-d H:i:s").' WHERE counterID="myUserID";');
    } catch (Exception $e) {
        throw new SoapFault("Server", $e->getMessage());
    }
    return 0;
}

function IncrementarContador($counterID) {
    global $db, $connected, $exception;
    AsignarContador($counterID, LeerContador($counterID)+1);
    return 0;
}

function ResetearContador($counterID) {
    global $db, $connected, $exception;
    AsignarContador($counterID, 0);
}

function EliminarContador($counterID) {
    global $db, $connected, $exception;
    if (!connected) throw new SoapFault("Server", "Unable to connect to database. $exception");
    if (empty($counterID)) throw new SoapFault("Client", '$counterID required');

    try {
        $db->query('DELETE FROM counters WHERE counterID = '.$counterID.';');
    } catch (Exception $e) {
        throw new SoapFault("Server", $e->getMessage());
    }
    return 0;
}

function ListarContadores($userID) {
    global $db, $connected, $exception;
    if (!connected) throw new SoapFault("Server", "Unable to connect to database. $exception");
    if (empty($userID)) throw new SoapFault("Client", '$userID required');

    $retval = "";

    try {
        $results = $db->query('SELECT counterID FROM counters WHERE userID="'.$userID.'";');

        foreach($results as $row) {
            $retval = $retval .','.$row[0];
            // TODO maybe use a list, whichever is easier to parse
        }

    } catch (Exception $e) {
        throw new SoapFault("Server", $e->getMessage());
    }
    return $retval;
}


/**
 * SOAP
 */

// Required by Google App Engine
libxml_disable_entity_loader(false);

ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 0);

// Initialize the web-service
try {
    $server = new SoapServer (null, array('uri' => "http://localhost/"));
    $server->addFunction("CrearContador");
    $server->addFunction("LeerContador");
    $server->addFunction("IncrementarContador");
    $server->addFunction("AsignarContador");
    $server->addFunction("ResetearContador");
    $server->addFunction("EliminarContador");
    $server->addFunction("ListarContadores");
    $server->handle();
} catch (SOAPFault $f) {
    print $f->faultstring;
}

?>
