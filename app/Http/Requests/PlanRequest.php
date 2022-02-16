<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
                        'name' => 'required|unique:plans,name',
                        'features' => 'required',
                        'prices' => 'required',
                        'prices.*.price' => 'required|min:1|between:0,999.99',
                        'prices.*.duration' => 'required|in:day,month,year'
                    ];
                }
            case 'PUT': {
                    return [
                        'name' => 'unique:plans,name,'. request()->segment(3) . ',id',
                        'features' => 'nullable',
                        'prices' => 'required',
                        'prices.*.price' => 'required|min:1|between:0,999.99',
                        'prices.*.duration' => 'required|in:day,month,year'
                    ];
                }
            // case 'GET':
            // case 'DELETE': {
            //         return [
            //             'order' => "exists:orders,id",
            //         ];
            //     }
            // default:
            //     break;
        }
    }
}
