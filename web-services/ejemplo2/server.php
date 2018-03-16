<?php
function multiplica_por_2($numero) {
	return 2*$numero;
}
function hola() {
	return "hola";
}

// Required by Google App Engine
libxml_disable_entity_loader(false);

ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 0);
ini_set('default_socket_timeout', 5);

try {
	$server = new SoapServer (null, array('uri' => "http://test-uri/"));
	$server->addFunction("multiplica_por_2");
	$server->addFunction("hola");
	$server->handle();
} catch (SOAPFault $f) {
	print $f->faultstring;
}
?>
