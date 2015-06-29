<?php

class ProductListCommandTest extends TestCase {

    public function test() {
        $command = \Mockery::mock('WarehouseCLI\Command\Product\ProductListCommand[sendRequest,printGrid]');
        $products = [
            [
                'id' => 'value',
                'name' => 'value'
            ]
        ];
        $command->shouldReceive('sendRequest')
            ->once()
            ->andReturn($products);
        $command->shouldReceive('printGrid')->once()->with($products);
    }
}