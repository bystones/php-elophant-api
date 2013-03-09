<?php

use Elophant\Adapter\Curl;

class CurlTest extends PHPUnit_Framework_TestCase {

    protected function getAccessibleMethod($class, $method) {
        $class = new ReflectionClass($class);
        $method = $class->getMethod($method);
        $method->setAccessible(true);

        return $method;
    }

    public function testGetResourceUrlSimple() {
        $method = $this->getAccessibleMethod('Elophant\Adapter\Curl', 'getResourceUrl');

        $url = $method->invokeArgs(new Curl(), array(
            'testkey', 'items'
        ));

        $this->assertEquals('http://api.elophant.com/v2/items?key=testkey', $url);
    }

    public function testGetResourceUrlComplex() {
        $method = $this->getAccessibleMethod('Elophant\Adapter\Curl', 'getResourceUrl');

        $url = $method->invokeArgs(new Curl(), array(
            'testkey',
            'summoner',
            array(
                'hotshotgg'
            ),
            'na'
        ));

        $this->assertEquals('http://api.elophant.com/v2/na/summoner/hotshotgg?key=testkey', $url);
    }

}