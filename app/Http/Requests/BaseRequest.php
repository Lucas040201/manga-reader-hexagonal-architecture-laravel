<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $errors = str_replace("\n", ". \n", implode("\n" , array_map(function ($arr) {
            return implode("\n" , $arr);
        }, $errors)));
        throw new HttpResponseException(
            response()->json(['Success' => false, 'message' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
