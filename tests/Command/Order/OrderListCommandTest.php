<?php

class OrderListCommandTest extends TestCase {

    public function test() {
        $command = \Mockery::mock('WarehouseCLI\Command\Order\OrderListCommand[sendRequest,printGrid]');
        $orders = [
            [
                'id' => 'value',
                'name' => 'value'
            ]
        ];
        $command->shouldReceive('sendRequest')
            ->once()
            ->andReturn($orders);
        $command->shouldReceive('printGrid')->once()->with($orders);
    }
}