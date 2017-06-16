<?php
    $uri = 'http://api.football-data.org/v1/competitions/354/fixtures/?matchday=22';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 793dd2bfc6ac48949272fd6c73514599';
    $stream_context = stream_context_create($reqPrefs);
    $response = file_get_contents($uri, false, $stream_context);
    $fixtures = json_decode($response);

   echo $fixtures;
?>