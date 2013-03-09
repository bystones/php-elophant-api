<?php

use Elophant\Response;

class ResponseTest extends PHPUnit_Framework_TestCase {

    public function testGetRespnseTime() {
        $response = new Response(0.5, array(), '');

        $this->assertEquals(0.5, $response->getResponseTime());
    }

    public function testGetDeveloperLimit() {
        $response = new Response(0.5, array(
            'Developer-Limit' => 250
                ), '');

        $this->assertEquals(250, $response->getDeveloperLimit());
    }

    public function testGetDeveloperRemaianing() {
        $response = new Response(0.5, array(
            'Developer-Remaining' => 250
                ), '');

        $this->assertEquals(250, $response->getDeveloperRemaining());
    }

    public function testGetDeveloperReset() {
        $response = new Response(0.5, array(
            'Developer-Reset' => 250
                ), '');

        $this->assertEquals(250, $response->getDeveloperReset());
    }
    
    public function testSuccess() {
        $json = json_encode(array(
            'success' => false,
            'error' => 'No success'
        ));
        $response = new Response(0.5, array(), $json);
        
        $this->assertEquals(false, $response->wasSuccess());
    }
    
    public function testErrorMessage() {
        $json = json_encode(array(
            'success' => false,
            'error' => 'This is a error message.'
        ));
        $response = new Response(0.5, array(), $json);
        
        $this->assertEquals('This is a error message.', $response->getErrorMessage());
    }
    
    public function testNoErrorMessage() {
        $json = json_encode(array(
            'success' => true
        ));
        $response = new Response(0.5, array(), $json);
        
        $this->assertEquals(null, $response->getErrorMessage());
    }

}
