<?php

namespace App\Exceptions;

use Fig\Http\Message\StatusCodeInterface;

class ServicoNotFoundException extends \DomainException
{
    public function __construct()
    {
        parent::__construct(
            'O tipo de serviço não foi encontrado',
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }
}