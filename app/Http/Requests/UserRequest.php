<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use App\Models\User;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()

    {

        return [

            'email' => 'required|max:255|min:9|regex:/(.+)@(.+)\.(com)/i',

            'username' => 'required|min:5|max:40',

        ];

    }



    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'      => $validator->errors()

        ]));

    }



    public function messages()

    {

        return [

            'email.required' => 'Thiếu email',
            'email.regex'=>'Email không hợp lệ',
            'email.min'=>'Email không hợp lệ',
            'username.required' => 'Thiếu Username',
            'username.min'=>'Username quá ngắn',
            'username.max'=>'Username quá daif',

        ];

    }

}
