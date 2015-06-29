<?php namespace WarehouseCLI\Command;

use CLIFramework\Command;
use CLIFramework\Formatter;
use Exception;
use InvalidArgumentException;

abstract class WarehouseCLICommand extends Command {

    /**
     * The base url requests are sent to
     * @var string
     */
    private $serviceUrl;

    /**
     * A formatter for creating formatted messages on the CLI
     * @var CLIFramework\Formatter
     */
    private $formatter;

    public function __construct($parent = null) {
        parent::__construct($parent);
        $this->serviceUrl = 'http://localhost:8000/api/';
        $this->formatter = new Formatter();
    }

    public function printGridErrorHandler($errno,$errstr) {
        /* handle the issue */
        throw new Exception("Error Processing Request", 1);
    }


    /**
     * Print a grid of inforation with the specified headers mapping to keys on
     * each array in the input array.
     * @param  array $headers An indexed array of headers to populate on the grid
     * @param  array $input   An array of arrays, each containing keys matching the values of headers
     */
    public function printGrid($headers, $input) {
        // Handle errors first
        if ($this->printServiceErrors($input)) {
            return;
        }

        // Get down to the good stuff
        $columns = [];
        // Add the headers to the columns
        foreach ($headers as $index => $header) {
            $columns[$index][] = ucwords($header);
        }

        // Add the header specified data from each object to the correct
        // column of the output
        set_error_handler(array($this, 'printGridErrorHandler'));
        try {
            foreach ($input as $objectIndex => $object) {
                foreach ($headers as $headerIndex => $header) {
                    $columns[$headerIndex][] = $object[$header];
                }
            }
        } catch (Exception $e) {
            throw new InvalidArgumentException('Invalid column headers provided.');
        }
        restore_error_handler();

        // Determine the correct length for each column of the output, this
        // should be based off of the length of the longest entry
        $columnWidths = [];
        foreach ($columns as $column) {
            $columnWidths[] = max(array_map('strlen', $column));
        }

        // Print each row of data
        foreach ($columns[0] as $rowIndex => $id) {
            foreach ($columns as $columnIndex => $column) {
                $this->logger->write(sprintf('%-' . ($columnWidths[$columnIndex]+4) . 's', $column[$rowIndex]));
            }
            $this->logger->newLine();
        }
    }

    /**
     * Determine if the service response included errors and print the necessary
     * messages to the console.
     * @param  array $serviceBody   The array of json_decode'd message body from the service
     * @return bool                 True if errors were found and written to console.
     */
    public function printServiceErrors($serviceBody) {
        if (!empty($serviceBody['errorMessage'])) {
            // Error message
            $this->logger->error($serviceBody['errorMessage']);
        } elseif (!empty($serviceBody['errorFields'])) {
            // Specific fields were incorrect
            foreach ($serviceBody['errorFields'] as $field => $errors) {
                $this->logger->error($field . ': ' . implode(' ', $errors));
            }
        } else {
            return false;
        }

        // This means we didn't help our "return false" else statement, and we
        // definitely found errors from the service.
        return true;
    }

    /**
     * Validate that the request verb is allowed
     * @param  string $verb The HTTP request verb
     */
    private function validateVerb($verb) {
        $allowedVerbs = [
            'POST',
            'GET',
            'PUT',
            'DELETE'];
        if (!in_array($verb, $allowedVerbs)) {
            throw new InvalidArgumentException('Invalid verb of: ' . $verb);
        }
    }

    /**
     * Send a request to the warehouse service
     * @param  string     $uri  The URI to send the request to
     * @param  array|null $data The data to send to the request on POST/PUT
     * @param  string     $verb The HTTP verb to use on the request
     * @return array            An array representation of the response
     * @throws InvalidArgumentException If the verb supplied is not POST, GET, PUT or DELETE
     */
    public function sendRequest($uri, array $data=null, $verb='GET') {
        $this->validateVerb($verb);
        $data_string = json_encode($data);

        //  Use curl to get the warehouse data

        $ch = curl_init($this->serviceUrl . $uri);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (in_array($verb, ['POST', 'PUT'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)]
            );
        }

        // Debug statements
        $this->logger->debug("\n" . '*******************************************************');
        $this->logger->debug('Sending curl request to: ' . $this->serviceUrl . $uri);
        $this->logger->debug('Curl data: ' . $data_string);
        $this->logger->debug('Curl verb: ' . $verb);
        $this->logger->debug('*******************************************************' . "\n");

        $result=curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        $this->logger->debug("\n" . '*******************************************************');
        $this->logger->debug('Curl response data: ' . print_r($result,true));
        $this->logger->debug("\n" . '*******************************************************');

        return $result;
    }
}