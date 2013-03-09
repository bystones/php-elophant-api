<?php

namespace Elophant\Adapter;

use Elophant\Adapter\AdapterInterface;
use Elophant\Response;

class Curl implements AdapterInterface {

    /**
     * Time until cUrl timeouts in seconds
     * @var integer
     */
    protected $curlTimeout = 4;

    /**
     * The time until cUrl timeouts
     * @return integer
     */
    public function getCurlTimeout() {
        return $this->curlTimeout;
    }

    /**
     * Sets the curl timout time in seconds
     * @param integer $curlTimeout
     */
    public function setCurlTimeout($curlTimeout) {
        $this->curlTimeout = $curlTimeout;
    }

    /**
     * Creates the elophant.com API url
     * @param string $apiKey
     * @param string $resource
     * @param array $params
     * @param string $region
     * @return string
     */
    protected function getResourceUrl($apiKey, $resource, array $params = array(), $region = null) {
        $baseUrl = 'http://api.elophant.com/v2/';

        if (null !== $region) {
            $baseUrl .= $region . '/';
        }

        $url = $baseUrl . $resource;

        if (count($params) > 0) {
            $url .= '/' . implode('/', $params);
        }

        return $url . '?key=' . $apiKey;
    }

    /**
     * Fetches the data from elophant.com and returns the response
     * @param string $apiKey
     * @param string $resource
     * @param array $params
     * @param string $region
     * @return \Elophant\Response
     * @throws \Exception
     */
    public function getResource($apiKey, $resource, array $params = array(), $region = null) {
        $url = $this->getResourceUrl($apiKey, $resource, $params, $region);

        $start = microtime(true);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->curlTimeout);
        $result = curl_exec($ch);
        curl_close($ch);

        if (false === $result) {
            throw new \Exception('Unable to perfom cUrl');
        }

        $responseTime = microtime(true) - $start;

        list($header, $body) = explode("\r\n\r\n", $result, 2);

        $headers = $this->http_parse_headers($header);

        $response = new Response($responseTime, $headers, $body);

        return $response;
    }

    /**
     * Splits the HTTP header
     * @link http://www.php.net/manual/en/function.http-parse-headers.php#111226
     * @param string $header
     * @return array
     */
    protected function http_parse_headers($header) {
        $retVal = array();
        $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header));
        foreach ($fields as $field) {
            if (preg_match('/([^:]+): (.+)/m', $field, $match)) {
                $match[1] = preg_replace('/(?<=^|[\x09\x20\x2D])./e', 'strtoupper("\0")', strtolower(trim($match[1])));
                if (isset($retVal[$match[1]])) {
                    if (!is_array($retVal[$match[1]])) {
                        $retVal[$match[1]] = array($retVal[$match[1]]);
                    }
                    $retVal[$match[1]][] = $match[2];
                } else {
                    $retVal[$match[1]] = trim($match[2]);
                }
            }
        }
        return $retVal;
    }

}