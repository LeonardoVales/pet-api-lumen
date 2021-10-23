<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\AnimalRequest;
use App\Services\AnimalService;
use InvalidArgumentException;
use Illuminate\Http\JsonResponse;
use Fig\Http\Message\StatusCodeInterface;

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
            return response()->json($animalCreated->jsonSerialize(), StatusCodeInterface::STATUS_CREATED); 
        } catch(InvalidArgumentException $e) {            
            return response()->json(['error' => $e->getMessage()], StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }

    public function update(AnimalRequest $request, $id)
    {
        try {
            $this->animalService->update(
                $request->getParams()->all(),
                $id
            );
            return response()->json([], StatusCodeInterface::STATUS_NO_CONTENT); 
        } catch(InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }

    public function delete(string $id): JsonResponse
    {
        try {
            $this->animalService->delete($id);
            
            return response()->json([], StatusCodeInterface::STATUS_NO_CONTENT); 
        } catch(InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function index(): JsonResponse
    {        
        try {
            return response()->json($this->animalService->all(), StatusCodeInterface::STATUS_OK); 
        } catch(InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }

    public function find(string $id): JsonResponse
    {
        try {
            $animalEntity = $this->animalService->findById($id);
            
            return response()->json($animalEntity->jsonSerialize(), StatusCodeInterface::STATUS_OK); 
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }
}