<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            case 'POST':{
                return [
                    'product' => 'required|exists:products,id',
                    'cardNumber' => 'required',
                    'cvc' => 'required',
                    'month' => 'required',
                    'year' => 'required',
                ];
            }
            case 'PUT':{
                return [
                    
                ];
            }
            case 'GET':
            case 'DELETE':{
                return [
                    'order' => "exists:orders,id",
                ];
            }
            default:
                break;
        }
    }
}
