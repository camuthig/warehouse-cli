<?php

class StockListCommandTest extends TestCase {

    public function test() {
        $command = \Mockery::mock('WarehouseCLI\Command\Stock\StockListCommand[sendRequest,printGrid]');
        $stock = [
            [
                'id' => 'value',
                'name' => 'value'
            ]
        ];
        $command->shouldReceive('sendRequest')
            ->once()
            ->andReturn($stock);
        $command->shouldReceive('printGrid')->once()->with($stock);
    }
}