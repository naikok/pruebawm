<?php
namespace App\BusinessService;
use App\PersistenceService\PersonService;
use Symfony\Component\HttpFoundation\Response;
use App\Service\PrinterService;

class PersonBusinessService
{
    protected $personService;
    protected $printerService;

    /**
     * Class constructor
     *
     * @return void
     */

    public function __construct(PersonService $personService, PrinterService $printerService)
    {
        $this->personService = $personService;
        $this->printerService = $printerService;
    }

    /**
     *
     * Private Function that is the responsible for obtaining the output,
     * @param array $data the result containing []Person
     * @return string $query the term used by the user to searcb-h
     *
     */

    private function printQueryFindBySearchQuery(array $data, string $query) : string
    {
        return $this->printerService->printOutput($data, $query);
    }

    /**
     *
     * Function that returns the output when the user introduces the term or query to search
     * @param string $query
     * @return string
     *
     */

    public function findBySearchQuery(?string $query) : string
    {
        if ((strlen($query) == 0) || (is_null($query))) {
            throw new \Exception("Invalid query was introduced", Response::HTTP_BAD_REQUEST);
        }

        $result = $this->personService->findBySearchQuery($query);
        return $this->printQueryFindBySearchQuery($result, $query);
    }

}
