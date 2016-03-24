<?php

require_once __DIR__.'/../vendor/autoload.php';

$checker = new \Viirre\UrlChecker\Checker();

$urls = [
    'http://www.adaptivemedia.se',
    'http://www.adaptivemedia.se/hejajagfinnsinte.html',
    'http://www.aeraekrhearbaebraenbrnaber.com/',
];

foreach ($urls as $url) {
    $status = $checker->check($url);

    if ($status->isRespondingOk()) {
        echo "Url {$url} is responding ok, woho! It took ".$status->getTimeInMilliSeconds().' ms to complete';
    } elseif ($status->isResponding()) {
        echo "Url {$url} is responding, but with status code: ".$status->getStatusCode().' and reason for not a 200: '.$status->getReason();
    } else {
        echo "Url {$url} is NOT responding ok, fail reason: ".$status->getReason();
    }

    echo isCommandLineInterface() ? PHP_EOL : '<br><hr><br>';
}

function isCommandLineInterface()
{
    return (php_sapi_name() === 'cli');
}
