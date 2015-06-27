<?php namespace WarehouseCLI\Command\Warehouse;

use WarehouseCLI\Command\WarehouseCLICommand;

class WarehouseCreateCommand extends WarehouseCLICommand {

    public function arguments($args) {

        $args->add('name')
            ->desc('Warehouse name');

        $args->add('address')
            ->desc('Warehouse address');
    }

    function execute($name, $address) {
        $jsonData = [
            'name'    => $name,
            'address' => $address
        ];
        $response = $this->sendRequest('warehouses', $jsonData, 'POST');

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