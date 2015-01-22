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
     * Create a new Instance
     */
    public function __construct()
    {
        $this->guzzle = new Client();
    }

    /**
     * Perform the check of a URL
     *
     * @param string $url URL to check
     * @param int $timeout timeout for the request. Defaults to 3 seconds
     * @return Status
     */
    public function check($url, $timeout = 3)
    {
        $this->validateUrl($url);

        try {

            $response = $this->guzzle->get($url, [
                'timeout' => $timeout
            ]);


            $code = $response->getStatusCode();

            return new Status($url, $code, true, false);

        } catch (ClientException $e) {

            // When not a 200 status
            return new Status($url, $e->getCode(), true, false, $e->getMessage());

        } catch (ConnectException $e) {

            // Unresolvable host etc
            return new Status($url, null, false, true, $e->getMessage());

        } catch (\Exception $e) {

            return new Status($url, null, false, true, $e->getMessage());

        }
    }

    /**
     * Validate that a url is a valid url
     *
     * @param string $url
     * @throws UrlMalformedException
     */
    private function validateUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new UrlMalformedException("The provided url: $url is malformed");
        }
    }
}
