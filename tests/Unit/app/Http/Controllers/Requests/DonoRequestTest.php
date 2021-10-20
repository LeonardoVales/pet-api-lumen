<?php

use App\Http\Controllers\Requests\DonoRequest;
use App\Http\Controllers\Requests\FormRequest;
use Illuminate\Http\Request;

class DonoRequestTest extends TestCase
{
    private array $dataRequest;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dataRequest = [
            'nome' => 'Leonardo Vales',
            'telefone' => '31986623642'
        ];

        $this->request = new Request($this->dataRequest);

    }

    public function test_e_uma_instancia_de_solicitacao_da_requisicao_dono()
    {
        $donoRequest = new DonoRequest($this->request);

        $this->assertInstanceOf(FormRequest::class, $donoRequest);
    }

    public function test_get_objeto_solicitacao()
    {
        $donoRequest = new DonoRequest($this->request);

        $this->assertInstanceOf(Request::class, $donoRequest->getParams());
        $this->assertSame(
            $this->dataRequest['nome'], 
            $donoRequest->getParams()->input('nome')
        );
        $this->assertSame(
            $this->dataRequest['telefone'], 
            $donoRequest->getParams()->input('telefone')
        );
    }

    public function test_deve_lancar_uma_excecao_se_a_requisicao_for_vazia()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        new DonoRequest(new Request());
    }
}