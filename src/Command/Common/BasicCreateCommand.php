<?php namespace WarehouseCLI\Command\Common;

use WarehouseCLI\Command\WarehouseCLICommand;

abstract class BasicCreateCommand extends WarehouseCLICommand {

    /**
     * A very basic way to send a create request and handle the output. On success,
     * just a simple message will be written.
     * @param  string $uri      The end of the URI to send the request to
     * @param  array $jsonData  The array representing the JSON post data
     * @return void
     */
    protected function create($uri, $jsonData) {
        $response = $this->sendRequest($uri, $jsonData, 'POST');

        // Print the output
        if (!$this->printServiceErrors($response)) {
            $this->logger->println($this->formatter->format('Success!', 'green'));
        }
    }
}