<?php

namespace Elophant\Adapter;

interface AdapterInterface {

    /**
     * Fetches the resource
     * @param string $apiKey
     * @param string $resource
     * @param array $params
     * @param string $region
     * @return \Elophant\Response
     */
    public function getResource($apiKey, $resource, array $params = array(), $region = null);
}
