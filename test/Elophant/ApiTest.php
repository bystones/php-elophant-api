<?php

use Elophant\Api;
use Elophant\Response;

class ApiTest extends PHPUnit_Framework_TestCase {

    public function testGetResponseBody() {
        $responseBody = file_get_contents(__DIR__ . '/../ResponseBody/items.json');
        $response = new Response(1, array(), $responseBody);

        $mockAdapter = $this->getMock('Elophant\Adapter\AdapterInterface', array('getResource'));
        $mockAdapter->expects($this->any())
                ->method('getResource')
                ->with('apiKey', 'items')
                ->will($this->returnValue($response));

        $api = new Api($mockAdapter, 'apiKey');

        $this->assertEquals($responseBody, $api->getItems()->getBody());
    }

}