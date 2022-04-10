
<?php

require __DIR__ . '/../SourceQuery/bootstrap.php';

use xPaw\SourceQuery\SourceQuery;

define('SQ_TIMEOUT',     1);
define('SQ_ENGINE',      SourceQuery::SOURCE);

$array = [];

function serverQuery($hostname, $port){

    $Query = new SourceQuery();

    try {
        
        $Query->Connect($hostname, $port, SQ_TIMEOUT, SQ_ENGINE);

        //define the queries
        $info =  $Query->GetInfo();
        $rules = $Query->GetRules();

        //break the info() down
        foreach ($info as $infoKey => $infoValue) {
            //get our current map
            if ($infoKey == 'Map') {
                $array[0] = $infoValue;
            }
            //get current player count
            if ($infoKey == 'Players') {
                $array[2] = $infoValue;
            }
            //get max players (for MVM)
            if ($infoKey == 'MaxPlayers') {
                $array[3] = $infoValue;
            }
        }

        //break the rules() down
        foreach ($rules as $rulesKey => $rulesValue) {
            if ($rulesKey == 'sm_nextmap') {
                $array[1] = $rulesValue;
            }
        }

        return $array;
    } catch (Exception $e) {
        //what to return if source query doesn't get anything
        $array[0] = "Server Offline";
        $array[1] = "";
        $array[2] = "";
        $array[3] = "";
        return $array;
    } finally {
        //remember to disconnect the query
        $Query->Disconnect();
    }
}

?>