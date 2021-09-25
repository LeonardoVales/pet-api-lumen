<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\DonoRequest;

class DonoController extends Controller
{
    public function create(DonoRequest $request)
    {
        dd($request->getParams()->all());
    }
}