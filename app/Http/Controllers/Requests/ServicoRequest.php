<?php

namespace App\Http\Controllers\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicoRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'nome' => 'required'
            ]
        );

        parent::__construct($request);
    }
}