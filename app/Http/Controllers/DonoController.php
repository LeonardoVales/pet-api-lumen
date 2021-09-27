<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\DonoRequest;
use App\Services\DonoService;
use Exception;
use Illuminate\Http\JsonResponse;

class DonoController extends Controller
{
    private $donoService;

    public function __construct(DonoService $donoService)
    {
        $this->donoService = $donoService;
    }

    public function create(DonoRequest $request): JsonResponse
    {
        try {
            $this->donoService->create(
                $request->getParams()->all()
            );
        return response()->json([], 201);            
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}