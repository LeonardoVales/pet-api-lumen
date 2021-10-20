<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\AnimalRequest;
use App\Services\AnimalService;
use InvalidArgumentException;
use Illuminate\Http\JsonResponse;

class AnimalController extends Controller
{
    private $animalService;

    public function __construct(AnimalService $service)
    {        
        $this->animalService = $service;
    }

    public function create(AnimalRequest $request)
    {        
        try {
            $animalCreated = $this->animalService->create(
                $request->getParams()->all()
            );            
            return response()->json($animalCreated->jsonSerialize(), 201); 
        } catch(InvalidArgumentException $e) {            
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(AnimalRequest $request, $id)
    {
        try {
            $this->animalService->update(
                $request->getParams()->all(),
                $id
            );
            return response()->json([], 204); 
        } catch(InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function delete(string $id): JsonResponse
    {
        try {
            $this->animalService->delete($id);
            
            return response()->json([], 204); 
        } catch(InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function index(): JsonResponse
    {        
        try {
            return response()->json($this->animalService->all(), 200); 
        } catch(InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function find(string $id): JsonResponse
    {
        try {
            $animalEntity = $this->animalService->findById($id);
            
            return response()->json($animalEntity->jsonSerialize(), 200); 
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}