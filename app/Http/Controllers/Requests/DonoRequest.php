<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonoRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'nome' => 'required'
            ],
        );

        parent::__construct($request);
    }
}