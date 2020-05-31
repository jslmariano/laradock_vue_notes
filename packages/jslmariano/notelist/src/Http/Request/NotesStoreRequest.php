<?php

namespace Jslmariano\Notelist\Http\Requests;

use Jslmariano\Notelist\Http\Requests\Api\ApiFormRequest;

class NotesStoreRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:250',
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Title is required!',
            'content.required' => 'Content is required!',
        ];
    }
}