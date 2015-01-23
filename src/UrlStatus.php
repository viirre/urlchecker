<?php

namespace Viirre\UrlChecker;

class UrlStatus {

    /**
     * Url to check
     *
     * @var string
     */
    protected $url;

    /**
     * Status code returned, if URL is responding
     *
     * @var int|null
     */
    protected $statusCode;

    /**
     * Reason for when URL is not responding with 200 status code
     *
     * @var string|null
     */
    protected $reason;

    /**
     * If the url's host is unresolvable
     *
     * @var bool
     */
    protected $unresolvableHost;

    /**
     * The Guzzle response object (if successful connection)
     *
     * @var GuzzleHttp\Message\Response|null
     */
    protected $response;

    /**
     * Time it took for the request in seconds
     *
     * @var double
     */
    protected $time;

    /**
     * Create an instance of an UrlStatus
     *
     * @param string $url
     * @param int|null $statusCode
     * @param double $time in seconds
     * @param bool $unresolvableHost
     * @param GuzzleHttp\Message\Response|null $response
     * @param string|null $reason
     */
    public function __construct($url, $statusCode, $time, $unresolvableHost, $response = null, $reason = null)
    {
        $this->statusCode = $statusCode;
        $this->url = $url;
        $this->reason = $reason;
        $this->unresolvableHost = $unresolvableHost;
        $this->response = $response;
        $this->time = $time;
    }

    /**
     * Return if the URL is responding with a 200 status
     *
     * @return bool
     */
    public function isRespondingOk()
    {
        return $this->statusCode == 200;
    }


    /**
     * Return if the URL is responding at all
     *
     * @return bool
     */
    public function isResponding()
    {
        return ! $this->unresolvableHost;
    }

    /**
     * Return if the URL's host is unresolvable
     *
     * @return bool
     */
    public function hostIsUnresolvable()
    {
        return $this->unresolvableHost;
    }

    /**
     * Get the status code returned (if successful connection)
     *
     * @return int|null
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Get the URL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the reason if connection was unsuccessful
     *
     * @return string|null
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Get the time it took for the request to complete (in seconds)
     *
     * @return double
     */
    public function getTimeInSeconds()
    {
        return $this->time;
    }


    /**
     * Get the time it took for the request to complete (in milliseconds)
     *
     * @return double
     */
    public function getTimeInMilliSeconds()
    {
        return round($this->time * 100);
    }

    /**
     * Get the Guzzle response object (if successful connection)
     *
     * @return null|GuzzleHttp\Message\Response
     */
    public function getResponse()
    {
        return $this->response;
    }


} 