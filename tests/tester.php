<?php
require_once '../vendor/autoload.php';

$url = 'http://www.googlaee.com/ughhh.htm';
$checker = new \Viirre\UrlChecker\Checker();
$status = $checker->check($url);

if ($status->isRespondingOk()) {
    echo "Url {$url} is responding ok, woho!";
} elseif ($status->isResponding()) {
    echo "Url {$url} is responding, but with status code: " . $status->getStatusCode();
} else {
    echo "Url {$url} is NOT responding ok, reason: " . $status->getReason();
}
