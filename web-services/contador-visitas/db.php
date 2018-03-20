<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php

use Symfony\Component\HttpFoundation\Request;

// Connect to CloudSQL from App Engine
$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
if (!isset($dsn, $user) || false === $password) {
    throw new Exception('Set MYSQL_DSN, MYSQL_USER, and MYSQL_PASSWORD environment variables');
}

try {
    $db = new PDO($dsn, $user, $password);
    echo "Connected<br>";
} catch (Exception $e) {
    echo "Unable to connect: " . $e->getMessage() . "<br>";
}


// Show existing entries
$results = $db->query('SELECT * FROM counters;');

/* echo $dsn . "\n<br>" . $user . "\n<br>" . $password; */

foreach($results as $row) {
    echo "$row[0] | $row[1] | $row[2] | $row[3] | $row[4] <br>\n";
}
$my_counter = 0;

/* echo "\n<br>"; */
/* echo $results->errorCode; */
/* echo "\n<br>"; */
/* echo $results->errorInfo; */
/* echo "\n<br>"; */
/* echo $results->fetchAll; */
/* echo "\n<br>"; */
/* echo $results->columnCount; */

$my_counter = $results[0][1];

echo "counter: " . $my_counter;
echo "\n<br>";
echo $results;
?>
</body>
</html>
