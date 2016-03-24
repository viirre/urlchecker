<?php

namespace Viirre\UrlChecker;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

class Checker
{
    /**
     * @var Client
     */
    protected $guzzle;

    /**
     * Create a new Instance.
     */
    public function __construct()
    {
        $this->guzzle = new Client();
    }

    /**
     * Perform the check of a URL.
     *
     * @param string $url     URL to check
     * @param int    $timeout timeout for the request. Defaults to 5 seconds
     *
     * @return Status
     */
    public function check($url, $timeout = 5)
    {
        $this->validateUrl($url);

        $response = null;
        $statusCode = null;
        $reason = null;
        $unresolved = false;
        $timeStart = microtime(true);

        try {
            $response = $this->guzzle->get($url, [
                'timeout' => $timeout,
            ]);

            $statusCode = $response->getStatusCode();
        } catch (ClientException $e) {

            // When not a 200 status but still responding
            $statusCode = $e->getCode();
            $reason = $e->getMessage();
        } catch (ConnectException $e) {

            // Unresolvable host etc
            $reason = $e->getMessage();
            $unresolved = true;
        } catch (\Exception $e) {

            // Other errors
            $reason = $e->getMessage();
            $unresolved = true;
        }

        $timeEnd = microtime(true);
        $time = ($timeEnd - $timeStart); // seconds

        return new UrlStatus($url, $statusCode, $time, $unresolved, $response, $reason);
    }

    /**
     * Validate that a url is a valid url.
     *
     * @param string $url
     *
     * @throws UrlMalformedException
     */
    private function validateUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new UrlMalformedException("The provided url: $url is malformed");
        }
    }
}
