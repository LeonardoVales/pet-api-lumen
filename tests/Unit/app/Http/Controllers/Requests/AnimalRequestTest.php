<?php

use App\Http\Controllers\Requests\AnimalRequest;
use App\Http\Controllers\Requests\FormRequest;
use App\Models\Animal;
use App\Models\Dono;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AnimalRequestTest extends TestCase
{
    private Request $request;
    private Animal $animalModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->animalModel = Animal::factory()->make();
        
        $this->request = new Request($this->animalModel->toArray());

    }

    public function test_e_uma_instancia_de_solicitacao_da_requisicao_animal()
    {        
        $animalRequest = new AnimalRequest($this->request);

        $this->assertInstanceOf(FormRequest::class, $animalRequest);
    }

    public function test_get_objeto_solicitacao()
    {
        $animalRequest = new AnimalRequest($this->request);

        $this->assertInstanceOf(Request::class, $animalRequest->getParams());
        
        $this->assertSame(
            $this->animalModel->nome,
            $animalRequest->getParams()->input('nome')
        );

        $this->assertSame(
            $this->animalModel->idade,
            $animalRequest->getParams()->input('idade')
        );

        $this->assertSame(
            $this->animalModel->especie,
            $animalRequest->getParams()->input('especie')
        );

        $this->assertSame(
            $this->animalModel->raca,
            $animalRequest->getParams()->input('raca')
        );

        $this->assertSame(
            $this->animalModel->id_dono,
            $animalRequest->getParams()->input('id_dono')
        );
    }
}