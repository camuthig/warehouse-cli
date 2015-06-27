<?php namespace WarehouseCLI\Command;

use CLIFramework\Command;

abstract class WarehouseCLICommand extends Command {

    /**
     * Print a grid of inforation with the specified headers mapping to keys on
     * each array in the input array.
     * @param  array $headers An indexed array of headers to populate on the grid
     * @param  array $input   An array of arrays, each containing keys matching the values of headers
     */
    public function printGrid($headers, $input) {
        $columns = [];
        // Add the headers to the columns
        foreach ($headers as $index => $header) {
            $columns[$index][] = ucwords($header);
        }

        // Add the header specified data from each object to the correct
        // column of the output
        foreach ($input as $objectIndex => $object) {
            foreach ($headers as $headerIndex => $header) {
                $columns[$headerIndex][] = $object[$header];
            }
        }

        // Determine the correct length for each column of the output, this
        // should be based off of the length of the longest entry
        $columnWidths = [];
        foreach ($columns as $column) {
            $columnWidths[] = max(array_map('strlen', $column));
        }

        // Print each row of data
        foreach ($columns[0] as $rowIndex => $id) {
            foreach ($columns as $columnIndex => $column) {
                $this->logger->write(sprintf('%-' . ($columnWidths[$columnIndex]+2) . 's', $column[$rowIndex]));
            }
            $this->logger->newLine();
        }
    }
}