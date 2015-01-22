<?php

namespace Viirre\UrlChecker;


class Status {

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
     * @var
     */
    protected $isResponding;

    /**
     * @var
     */
    protected $unresolvableHost;

    public function __construct($url, $statusCode, $isResponding, $unresolvableHost, $reason = null)
    {
        $this->statusCode = $statusCode;
        $this->url = $url;
        $this->reason = $reason;
        $this->isResponding = $isResponding;
        $this->unresolvableHost = $unresolvableHost;
    }

    /**
     * Return if the URL is responding with a 200 status
     */
    public function isRespondingOk()
    {
        return $this->isResponding and $this->statusCode == 200;
    }


    /**
     * Return if the URL is responding at all
     */
    public function isResponding()
    {
        return $this->isResponding;
    }

    /**
     * Return if the URL's host is unresolvable
     */
    public function hostIsUnresolvable()
    {
        return $this->unresolvableHost;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }


} 