<?php namespace WarehouseCLI\Command\Product;

use WarehouseCLI\Command\Common\BasicCreateCommand;

class ProductCreateCommand extends BasicCreateCommand {

    public function arguments($args) {

        $args->add('name')
            ->desc('Product name');

        $args->add('dimensions')
            ->desc('Product dimensions (LxWxH)');

        $args->add('weight')
            ->desc('Product weight');
    }

    function execute($name, $dimensions, $weight) {
        $jsonData = [
            'name'    => $name,
            'dimensions' => $dimensions,
            'weight' => $weight
        ];
        $this->create('products', $jsonData);
    }
}