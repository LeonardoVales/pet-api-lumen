<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\DonoRequest;
use App\Services\DonoService;
use Exception;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Fig\Http\Message\StatusCodeInterface;

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
        return response()->json($donoCreated->jsonSerialize(), StatusCodeInterface::STATUS_CREATED);
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }

    public function update(DonoRequest $request, $id): JsonResponse
    {
        try {
            $this->donoService->update($request->getParams(), $id);
            return response()->json([], StatusCodeInterface::STATUS_NO_CONTENT); 
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }

    public function delete(string $id): JsonResponse
    {
        try {
            $this->donoService->delete($id);

            return response()->json([], StatusCodeInterface::STATUS_NO_CONTENT); 
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }

    public function index(): JsonResponse
    {
        try {
            $donoList = $this->donoService->all();
            
            return response()->json($donoList, StatusCodeInterface::STATUS_OK); 
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], StatusCodeInterface::STATUS_BAD_REQUEST);
        }
    }
}