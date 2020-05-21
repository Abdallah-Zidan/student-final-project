<?php

namespace App\Http\Requests;

use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255',
            'password' => ['required', new StrongPassword()],
            'address' => 'required|max:255',
            'mobile' => 'required|unique:users|digits:11',
            'type' => ['required', Rule::in(['0', '1'])],
            'avatar' => 'mimes:jpeg,bmp,png|file|size:2048',
            'device_name' => 'required'

        ] + ($this->type == 1 ? // if company
            [
                'fax' => 'required|unique:App\CompanyProfile|digits:11',
                'description' => 'required|max:255',
                'website' => 'required|unique:App\CompanyProfile|max:255|url',
                'email' => 'required|email|unique:users|max:255'

            ] : ($this->type == 0 ? //if student
                [
                    'birthdate' => 'required|date_format:d-m-Y|before:today',
                    'year' => 'required|lte:7|gt:0',
                    'email' => 'required|unique:users|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.+-]+\.edu\.eg$/' // example: xxx@xxxx.edu.eg

                ] : []));
    }

    public function messages()
    {
        return [
            'email.regex' => 'invalid email format must be like this xxx@xxx.edu.eg',
        ];
    }
}
