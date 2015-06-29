<?php

use WarehouseCLI\Command\WarehouseCLICommand;
use WarehouseCLI\Command\Product\ProductListCommand;

class WarehouseCLICommandTest extends TestCase {

    public function setUp() {
        $this->command = new ProductListCommand( new WarehouseCLI\WarehouseApplication );
        $this->command->logger->getFormatter()->preferRawOutput();
    }

    /**
     * @expectedException Exception
     */
    public function testPrintGridBadColumns() {
        $columns = ['id', 'name', 'address'];

        $entries = [
            [
                'id' => 'value',
                'name' => 'value'
            ]
        ];

        $this->command->printGrid($columns, $entries);
    }

    public function testPrintGridSuccess() {
        $columns = ['id', 'name'];

        $entries = [
            [
                'id' => 'value',
                'name' => 'value'
            ]
        ];

        $this->command->printGrid($columns, $entries);

        // Tests
        $this->assertOutput('Id       Name     ' . "\n" . 'value    value    ' . "\n");
    }

    public function testPrintGridErrorMessage() {
        $columns = ['id', 'name'];
        $input = ['errorMessage' => 'Some error'];

        $this->command->printGrid($columns, $input);

        // Tests
        $this->assertOutput('Some error'. "\n");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSendRequestInvalidVerb() {
        $this->command->sendRequest('some/uri', [], 'PATCH');
    }

    public function testSendRequest() {
        if (!$this->isServerAvailable()) {
            $this->markTestSkipped('Server is not available to test request');
        }

        $response = $this->command->sendRequest('products');

        $this->assertTrue(isset($response), 'Response is not set');
        $this->assertTrue(is_array($response), 'Response was not a decoded array');
    }

    public function testPrintSerivceErrorsWithErrorFields() {
        $json = [
            'errorFields' => [
                'name'  => ['First error.', 'Seccond error.'],
                'id'    => ['First error.']
            ]
        ];

        $hasErrors = $this->command->printServiceErrors($json);

        // Tests
        $this->assertTrue($hasErrors, 'Message was not found to have errors');
        $this->assertOutput('name: First error. Seccond error.' . "\n" . 'id: First error.' . "\n");
    }

    public function testPrintSerivceErrorsWithErrorMessage() {
        $json = [
            'errorMessage' => 'This is the error.'
        ];

        $hasErrors = $this->command->printServiceErrors($json);

        // Tests
        $this->assertTrue($hasErrors, 'Message was not found to have errors');
        $this->assertOutput('This is the error.' . "\n");
    }

    public function testPrintSerivceErrorsWithoutErrors() {
        $json = [
            'id' => 1234,
            'name' => 'This is not an error.'
        ];

        $hasErrors = $this->command->printServiceErrors($json);

        // Tests
        $this->assertFalse($hasErrors, 'Message was found to have errors');
        $this->assertNoOutput();
    }

}