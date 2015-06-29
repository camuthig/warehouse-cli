<?php

use WarehouseCLI\Command\Common\BasicCreateCommand;

class BasicCreateTesterCommand extends BasicCreateCommand {
    public function createHelper($uri, $data) {
        $this->create($uri, $data);
    }
}

class BasicCreateCommandTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->command = Mockery::mock(
            'BasicCreateTesterCommand[sendRequest,printServiceErrors]',
            [new WarehouseCLI\WarehouseApplication]);
        $this->command->logger->getFormatter()->preferRawOutput();
    }

    // Helper to let me test the protected method directly
    protected static function getMethod($name) {
      $class = new ReflectionClass('MyClass');
      $method = $class->getMethod($name);
      $method->setAccessible(true);
      return $method;
    }

    public function testCreateWithServiceError() {
        $input = ['key' => 'value'];
        $output = ['errorMessage' => 'error stuff'];
        $this->command->shouldReceive('sendRequest')
            ->with('uri', $input, "POST")
            ->andReturn($output);
        $this->command->shouldReceive('printServiceErrors')
            ->with($output)
            ->andReturn(true);

        $this->command->createHelper('uri', $input);
        // We shouldn't have output since we mocked the printServiceErrors
        // and should not be printing success
        $this->assertNoOutput();
    }

    public function testCreateSuccess() {
        $input = ['key' => 'value'];
        $output = [];
        $this->command->shouldReceive('sendRequest')
            ->with('uri', $input, "POST")
            ->andReturn($output);
        $this->command->shouldReceive('printServiceErrors')
            ->with($output)
            ->andReturn(false);

        $this->command->createHelper('uri', $input);
        // We shouldn't have output since we mocked the printServiceErrors
        // and should not be printing success
        $this->assertOutput($this->command->formatter->format('Success!', 'green') . "\n");
    }
}