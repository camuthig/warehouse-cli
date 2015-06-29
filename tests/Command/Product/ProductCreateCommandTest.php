<?php

class ProductCreateCommandTest extends TestCase {

    public function test() {
        $command = \Mockery::mock('WarehouseCLI\Command\Product\ProductCreateCommand[create]')
            ->shouldAllowMockingProtectedMethods();

        $argInfos = $command->getArgumentsInfo();
        $this->assertNotEmpty($argInfos);
        $this->assertCount(3, $argInfos);
        $this->assertEquals('name', $argInfos['0']->name);
        $this->assertEquals('dimensions', $argInfos['1']->name);
        $this->assertEquals('weight', $argInfos['2']->name);

        // Try the command
        // Verify that it calls the internal create command with the correct input
        $command->shouldReceive('create')
            ->once()
            ->with('products', ['name' => 'prod', 'dimensions' => '1x1x1', 'weight' => '1g']);
        $command->execute('prod', '1x1x1', '1g');
    }
}