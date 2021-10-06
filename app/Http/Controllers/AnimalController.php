<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\AnimalRequest;
use App\Services\AnimalService;

class AnimalController extends Controller
{
    private $service;

    public function __construct(AnimalService $animalService)
    {        
        $this->service = $animalService;
    }

    public function create(AnimalRequest $request)
    {        
        try {
            $animalCreated = $this->service->create(
                $request->getParams()->all()
            );
            
            return response()->json($animalCreated->jsonSerialize(), 201); 
        } catch(\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}