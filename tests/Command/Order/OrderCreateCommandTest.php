<?php

class OrderCreateCommandTest extends TestCase {

    public function test() {
        $command = \Mockery::mock('WarehouseCLI\Command\Order\OrderCreateCommand[create]')
            ->shouldAllowMockingProtectedMethods();

        $argInfos = $command->getArgumentsInfo();
        $this->assertNotEmpty($argInfos);
        $this->assertCount(2, $argInfos);
        $this->assertEquals('product', $argInfos['0']->name);
        $this->assertEquals('address', $argInfos['1']->name);

        // Try the command
        // Verify that it calls the internal create command with the correct input
        $command->shouldReceive('create')
            ->once()
            ->with('orders', ['product' => 'prod', 'address' => 'some address']);
        $command->execute('prod', 'some address');
    }
}