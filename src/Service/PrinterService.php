<?php
namespace App\Service;


class PrinterService
{
    public function __construct()
    {

    }

    /**
     * Check if the variable is not null and it's not an empty string. Returns either true or false
     * @param string|null $property the string to check
     * @return bool
     *
     */

    private function isPropertyNotEmptyAndNotNull(?string $property) : bool
    {
        return (!is_null($property) && strlen($property) > 0) ? true : false;
    }

    /**
     * Functions that checks if a string contains another string inside of it.
     * @param string $mystring the string required where we will be looking if it contains some specific term within it.
     * @param string $term the word that is used by the user to search
     * @return bool
     *
     */

    private function checkIfContainsSearchTerm(string $mystring, string $term) : bool
    {
        return (strpos($mystring, $term) !== false) ? true : false;
    }

    /**
     * Prints in a properly way the result obtained from database.
     * @param array $result is an array of Persons[] obtained from database
     * @param string $term is the term or keyword used by the user to search.
     * @return string
     *
     */

    public function printOutput(array $result, string $term) : string
    {
        $output = "";
        if (!empty($result) && is_array($result)) {
            foreach ($result as $item) {
                $output.= $item->getName()."\n";
                if ($this->isPropertyNotEmptyAndNotNull($item->getColorEyes()) && $this->checkIfContainsSearchTerm($item->getColorEyes(), $term)) {
                    $output.= "color de los ojos: " . $item->getColorEyes() . "\n";
                }

                if ($this->isPropertyNotEmptyAndNotNull($item->getColorCar()) && $this->checkIfContainsSearchTerm($item->getColorCar(), $term)) {
                    $output.= "color del coche: " . $item->getColorCar() . "\n";
                }

                if ($this->isPropertyNotEmptyAndNotNull($item->getColorHouse()) && $this->checkIfContainsSearchTerm($item->getColorEyes(), $term)) {
                    $output.= "color de la casa: " . $item->getColorHouse()."\n";
                }
            }
        }

        return $output;
    }
}
