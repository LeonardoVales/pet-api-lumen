<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Requests\FormRequest;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController implements FormRequest
{
    protected $params;
    public $request;

    public function __construct(Request $request)
    {
        $this->params = $request->all();
        $this->request = $request;
    }

    public function getParams(): Request
    {
        return $this->request->replace($this->params);
    }
}
