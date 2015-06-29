<?php

class StockCreateCommandTest extends TestCase {

    public function test() {
        $command = \Mockery::mock('WarehouseCLI\Command\Stock\StockCreateCommand[create]')
            ->shouldAllowMockingProtectedMethods();

        $argInfos = $command->getArgumentsInfo();
        $this->assertNotEmpty($argInfos);
        $this->assertCount(3, $argInfos);
        $this->assertEquals('product', $argInfos['0']->name);
        $this->assertEquals('warehouse', $argInfos['1']->name);
        $this->assertEquals('count', $argInfos['2']->name);

        // Try the command
        // Verify that it calls the internal create command with the correct input
        $command->shouldReceive('create')
            ->once()
            ->with('stock', ['product' => '1', 'warehouse' => '2', 'count' => 30]);
        $command->execute('1', '2', 30);
    }
}