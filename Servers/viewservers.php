<?php
require_once 'servers.php';
?>

<!DOCTYPE html>
<html>

<?php



$serverAddress = array(
    array(
        'name' => 'US Map Test',
        'host' => 'us.tf2maps.net',
        'port' => 27015
    ),
    array(
        'name' => 'EU Map Test',
        'host' => 'eu.tf2maps.net',
        'port' => 27015
    ),
    array(
        'name' => 'US MVM',
        'host' => 'us.tf2maps.net',
        'port' => 27016
    ),
    array(
        'name' => 'EU MVM',
        'host' => 'eu.tf2maps.net',
        'port' => 27016
    ),

);

$hostName = $port = "";
foreach ($serverAddress as $key => $value) {
    $hostName = $value['host'];
    $port = $value['port'];

    //check if other servers are offline
    if (serverQuery($hostName, $port)[0] != "Server Offline") {
        echo ($hostName . ":" . $port . "<br>");
        echo ("Current Map: " . serverQuery($hostName, $port)[0] . "<br>");
        echo ("Next Map: " . serverQuery($hostName, $port)[1] . "<br>");
        echo ("Current Players: " . serverQuery($hostName, $port)[2] . "<br>");
        echo ("Max Players: " . serverQuery($hostName, $port)[3] . "<br>");
        echo ("<br>");
    }
}



?>

</html>