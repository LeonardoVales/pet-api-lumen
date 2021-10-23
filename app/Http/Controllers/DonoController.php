<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\AnimalRequest;
use App\Http\Controllers\Requests\DonoRequest;
use App\Services\DonoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
                $request->getParams()
            );    
        
        return response()->json($donoCreated->jsonSerialize(), 201);            
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(DonoRequest $request, $id): JsonResponse
    {
        try {
            $this->donoService->update($request->getParams(), $id);
            return response()->json([], 204); 
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function delete(string $id): JsonResponse
    {
        try {
            $this->donoService->delete($id);

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