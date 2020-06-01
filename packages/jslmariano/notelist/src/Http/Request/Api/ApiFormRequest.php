<?php

namespace Jslmariano\Notelist\Http\Requests\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;

/**
 * This class describes an api form request abstract from Illuminate\Foundation\Http\FormRequest abstract for api endpoint purposes
 */
abstract class ApiFormRequest extends LaravelFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Handle a failed validation attempt.
     *
     * We hope this to not get deprecatedn to other version of laravel :) -
     * Josel Mariano
     *
     * @param      \Illuminate\Contracts\Validation\Validator  $validator
     * @return     void
     *
     * @throws     \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    /**
     * Handle a failed authorization attempt.
     *
     * We hope this to not get deprecatedn to other version of laravel :) -
     * Josel Mariano
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        // HTTP_UNAUTHORIZED
        throw new HttpResponseException(
            response()->json(['errors' => 'This action is unauthorized.'], JsonResponse::HTTP_UNAUTHORIZED)
        );
        // throw new AuthorizationException('This action is unauthorized.');
    }
}