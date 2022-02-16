<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPlanRequest extends FormRequest
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
                        'cardNumber' => 'required',
                        'cvc' => 'required',
                        'month' => 'required',
                        'year' => 'required',
                        'price_id' => 'required|exists:price_plans,id',
                    ];
                }
            // case 'PUT': {
            //         return [
            //         ];
            //     }
            // case 'GET':
            // case 'DELETE': {
            //         return [
            //         ];
            //     }
            // default:
            //     break;
        }
    }
}
