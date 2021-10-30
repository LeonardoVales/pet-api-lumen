<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\ServicoRequest;
use App\Services\ServicoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Fig\Http\Message\StatusCodeInterface;

class ServicoController extends Controller
{
    private $servicoService;

    public function __construct(ServicoService $service)
    {
        $this->servicoService = $service;
    }

    public function index(): JsonResponse
    {
        try {
            $servicos = $this->servicoService->all();
            return response()->json($servicos, StatusCodeInterface::STATUS_OK); 
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function findById(string $id): JsonResponse
    {
        try {
            $servico = $this->servicoService->findByid($id);
            return response()->json($servico->jsonSerialize(), StatusCodeInterface::STATUS_OK); 
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function create(ServicoRequest $request): JsonResponse
    {
        try {
            $servico = $this->servicoService->create(
                $request->getParams()
            );
            return response()->json($servico->jsonSerialize(), StatusCodeInterface::STATUS_CREATED); 
        } catch(Exception $e) {            
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function update(ServicoRequest $request, string $id): JsonResponse
    {
        try {
            $servico = $this->servicoService->update(
                $request->getParams(),
                $id
            );

            return response()->json($servico->jsonSerialize(), StatusCodeInterface::STATUS_NO_CONTENT); 
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function delete(string $id): JsonResponse
    {
        try {
            $this->servicoService->delete($id);
            return response()->json([], StatusCodeInterface::STATUS_NO_CONTENT); 
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}