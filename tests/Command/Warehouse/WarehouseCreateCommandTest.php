<?php

class WarehouseCreateCommandTest extends TestCase {

    public function test() {
        $command = \Mockery::mock('WarehouseCLI\Command\Warehouse\WarehouseCreateCommand[create]')
            ->shouldAllowMockingProtectedMethods();

        $argInfos = $command->getArgumentsInfo();
        $this->assertNotEmpty($argInfos);
        $this->assertCount(2, $argInfos);
        $this->assertEquals('name', $argInfos['0']->name);
        $this->assertEquals('address', $argInfos['1']->name);

        // Try the command
        // Verify that it calls the internal create command with the correct input
        $command->shouldReceive('create')
            ->once()
            ->with('warehouses', ['name' => 'warehouse', 'address' => 'some address']);
        $command->execute('warehouse', 'some address');
    }
}