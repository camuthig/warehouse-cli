<?php

class TestCase extends PHPUnit_Framework_TestCase {

    public function setUp() {
        parent::setUp();
        require_once __DIR__.'/../vendor/autoload.php';
    }

    public function tearDown() {
        parent::tearDown();

        // Clean up the test log
        if (file_exists($this->getTestLog())) {
            unlink($this->getTestLog());
        }
    }

    public function isServerAvailable() {
        $curlInit = curl_init('http://localhost:8000/api/products');
        curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curlInit,CURLOPT_HEADER,true);
        curl_setopt($curlInit,CURLOPT_NOBODY,true);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

        //get answer
        $response = curl_exec($curlInit);

        curl_close($curlInit);

        if ($response) return true;

        return false;
    }

    public function getTestLog() {
        return __DIR__ . '/test.log';
    }

    // This method works in conjunction with the TestFileWriter that is set
    // as the container's writer
    public function assertOutput($expectedString) {
        $actualOutput = file_get_contents($this->getTestLog());
        $this->assertEquals($expectedString, $actualOutput, 'Output string was incorrect');
    }

    // This method works in conjunction with the TestFileWriter that is set
    // as the container's writer and our tearDown.
    // We assume that if the test log does not exist, then nothing was written, because
    // we delete the file after each test.
    public function assertNoOutput() {
        $this->assertTrue(!file_exists($this->getTestLog()), 'Output was written');
    }

}