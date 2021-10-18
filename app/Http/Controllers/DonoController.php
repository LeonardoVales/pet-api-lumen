<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\AnimalRequest;
use App\Http\Controllers\Requests\DonoRequest;
use App\Services\DonoService;
use Exception;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

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
            $donoCreated = $this->donoService->create(
                $request->getParams()->all()
            );    
        
        return response()->json($donoCreated->jsonSerialize(), 201);            
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(DonoRequest $request, $id)
    {
        try {
            $this->donoService->update(
                $request->getParams()->all(),
                $id
            );
            return response()->json([], 204); 
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function index(): JsonResponse
    {
        try {
            $donoList = $this->donoService->all();
            
            return response()->json($donoList, 200); 
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}