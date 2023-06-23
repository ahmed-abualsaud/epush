<?php

namespace Epush\Shared\Infra\Validator;

use Epush\Shared\Infra\Exception\ExceptionContract;

use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException as BaseValidationException;

class ValidationException extends BaseValidationException implements ExceptionContract
{
    public function __construct(Validator $validator)
    {
        parent::__construct($validator, 422);
        $this->message = "Validation faileds: ";

        foreach($validator->errors()->messages() as $field => $messages ){
            $this->message .= $field.": ".implode(", ", $messages).";   ";
        }
    }
}
