<?php

namespace App\Controller;

use App\Service\PrinterService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\BusinessService\PersonBusinessService;

class TestController
{
    // Test for checking routing, not in use
    public function index(PrinterService $personBusinessService)
    {
        try {
            $query = "naranja claro";
            $result = $personBusinessService->findBySearchQuery($query);
            return new JsonResponse(["status"=>Response::HTTP_OK, "message"=>"test"]);
        } catch(\Exception $e) {
            return new Response($e->getMessage());
        }
    }
}