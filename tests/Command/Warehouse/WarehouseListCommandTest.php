<?php

class WarehouseListCommandTest extends TestCase {

    public function test() {
        $command = \Mockery::mock('WarehouseCLI\Command\Warehouse\WarehouseListCommand[sendRequest,printGrid]');
        $warehouses = [
            [
                'id' => 'value',
                'name' => 'value'
            ]
        ];
        $command->shouldReceive('sendRequest')
            ->once()
            ->andReturn($warehouses);
        $command->shouldReceive('printGrid')->once()->with($warehouses);
    }
}