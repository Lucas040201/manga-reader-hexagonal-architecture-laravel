<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
abstract class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $errors = str_replace("\n", ". \n", implode("\n" , array_map(function ($arr) {
            return implode("\n" , $arr);
        }, $errors)));
        throw new HttpResponseException(
            response()->json(['Success' => false, 'message' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
