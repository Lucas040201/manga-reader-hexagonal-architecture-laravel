<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class InsertUserRequest extends BaseRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|max:16',
            'profilePicture' => 'nullable|File|mime:jpeg,jpg,png|max:2000',
            'phoneNumber' => 'nullable|max:14|min:11'
        ];
    }

}
