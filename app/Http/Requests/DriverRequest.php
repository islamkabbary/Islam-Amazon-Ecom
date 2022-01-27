<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name' => 'required|max:25',
                        'email' => 'required|email|unique:drivers,email|unique:users,email|unique:stores,email',
                        'password' => 'required',
                        'confirm_password' => 'required|same:password',
                    ];
                }
            case 'PUT': {
                    return [
                        'name' => 'nullable|max:25',
                        'email' => 'nullable|email|unique:drivers,email|unique:users,email|unique:stores,email',
                        'password' => 'required',
                        'confirm_password' => 'required|same:password',
                    ];
                }
            case 'GET':
            case 'DELETE':{
                return [
                    'driver' => 'nullable|exists:driver,id'
                ];
            }
            default:
                break;
        }
    }
}
