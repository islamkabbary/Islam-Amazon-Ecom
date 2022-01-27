<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
                    'product_id' => 'required|exists:products,id',
                    'qty' => 'required|integer',
                    'note' => 'nullable',
                    'coupon_id' => 'nullable|exists:coupons,id',
                    'code' => 'nullable|exists:coupons,code',
                ];
            }
            case 'PUT':{
                return [
                    
                ];
            }
            case 'GET':
            case 'DELETE':{
                return [
                ];
            }
            default:
                break;
        }
    }
}
