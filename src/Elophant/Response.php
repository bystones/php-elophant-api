<?php

namespace Elophant;

class Response {

    /**
     * The time needed to get the response
     * @var float 
     */
    protected $responseTime = null;

    /**
     * The headers sent with the response
     * @var array 
     */
    protected $headers = array();

    /**
     * The response body
     * @var string 
     */
    protected $body = null;

    /**
     * Cache if the API call was a success
     * @var boolean 
     */
    private $success = null;

    /**
     * Cache of the error message
     * @var string 
     */
    private $errorMessage = null;

    /**
     * 
     * @param float $responseTime
     * @param array $headers
     * @param string $body
     */
    public function __construct($responseTime, array $headers, $body) {
        $this->responseTime = $responseTime;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * Returns the response time
     * @return float
     */
    public function getResponseTime() {
        return $this->responseTime;
    }

    /**
     * Returns the developer limit
     * @return integer
     */
    public function getDeveloperLimit() {
        return $this->getHeader('Developer-Limit');
    }

    /**
     * Returns the developer reset
     * @return integer
     */
    public function getDeveloperReset() {
        return $this->getHeader('Developer-Reset');
    }

    /**
     * Returns the developer remaining
     * @return integer
     */
    public function getDeveloperRemaining() {
        return $this->getHeader('Developer-Remaining');
    }

    /**
     * Returns the header array
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * Returns the value of a given header or the fallback
     * @param string $name
     * @param mixed $fallback
     * @return string
     */
    public function getHeader($name, $fallback = null) {
        return isset($this->headers[$name]) ? $this->headers[$name] : $fallback;
    }

    /**
     * Returns the response body
     * @return string
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * Returns the response body
     * @return string
     */
    public function __toString() {
        return (string) $this->body;
    }

    /**
     * Returns true if the request was successfull
     * @return boolean
     */
    public function wasSuccess() {
        //If the success is not set get it it from the body
        if (null === $this->success) {
            $response = json_decode($this->body);

            $this->success = $response->success;

            if (isset($response->error)) {
                $this->errorMessage = $response->error;
            }
        }

        return $this->success;
    }

    /**
     * Returns the error message or null if no error occured
     * @return string
     */
    public function getErrorMessage() {
        //If the success was not checked yet: check it
        if (null === $this->success) {
            $this->wasSuccess();
        }

        return $this->errorMessage;
    }

}
