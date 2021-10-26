<?php

namespace App\Exceptions;

use Fig\Http\Message\StatusCodeInterface;

class AnimalNotFoundException extends \DomainException
{
    public function __construct()
    {        
        parent::__construct(
            'O animal não foi encontrado', 
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }
}