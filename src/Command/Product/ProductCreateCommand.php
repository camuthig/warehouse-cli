<?php namespace WarehouseCLI\Command\Product;

use WarehouseCLI\Command\WarehouseCLICommand;

class ProductCreateCommand extends WarehouseCLICommand {

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
        $response = $this->sendRequest('products', $jsonData, 'POST');

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