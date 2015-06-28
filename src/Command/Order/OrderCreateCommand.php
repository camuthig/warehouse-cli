<?php namespace WarehouseCLI\Command\Order;

use WarehouseCLI\Command\WarehouseCLICommand;

class OrderCreateCommand extends WarehouseCLICommand {

    public function arguments($args) {

        $args->add('product')
            ->desc('The product name or id');

        $args->add('address')
            ->desc('The destination address for the order');
    }

    function execute($product, $address) {
        $jsonData = [
            'product'    => $product,
            'address'    => $address
        ];
        $response = $this->sendRequest('orders', $jsonData, 'POST');

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