<?php namespace WarehouseCLI\Command\Stock;

use WarehouseCLI\Command\WarehouseCLICommand;

class StockCreateCommand extends WarehouseCLICommand {

    public function arguments($args) {

        $args->add('product')
            ->desc('The product name or id');

        $args->add('warehouse')
            ->desc('The warehouse name or id');

        $args->add('count')
            ->desc('The amount of the product at the warehouse');
    }

    function execute($product, $warehouse, $count) {
        $jsonData = [
            'product'    => $product,
            'warehouse' => $warehouse,
            'count' => $count
        ];
        $response = $this->sendRequest('stock', $jsonData, 'POST');

        // Print the output
        if (!empty($response['errorMessage'])) {
            $this->logger->error($response['errorMessage']);
        } elseif (!empty($response['errorFields'])) {
            foreach ($response['errorFields'] as $field => $errors) {
                $this->logger->error($field . ': ' . implode(' ', $errors));
            }
        } else {
            $this->logger->println($this->formatter->format('Success!', 'green'));
        }
    }
}